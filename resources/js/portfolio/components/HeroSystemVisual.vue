<script setup lang="ts">
import {
  computed,
  onBeforeUnmount,
  onMounted,
  ref,
  type CSSProperties,
} from "vue";
import type { Branding, Profile } from "../types/portfolio";

const props = defineProps<{
  branding: Branding;
  profile: Profile;
}>();

const visualRef = ref<HTMLElement | null>(null);
const canvasRef = ref<HTMLCanvasElement | null>(null);

const particles = Array.from({ length: 14 }, (_, index) => ({
  id: index,
  left: `${8 + ((index * 13) % 76)}%`,
  top: `${10 + ((index * 17) % 70)}%`,
  size: `${4 + (index % 4) * 3}px`,
  duration: `${10 + (index % 5) * 2}s`,
  delay: `${index * -0.8}s`,
}));

const prefersReducedMotion =
  typeof window !== "undefined" &&
  window.matchMedia("(prefers-reduced-motion: reduce)").matches;

const visualStyle = ref<CSSProperties>({
  "--visual-tilt-x": "0deg",
  "--visual-tilt-y": "0deg",
  "--visual-shift-x": "0px",
  "--visual-shift-y": "0px",
});

const pulseLabel = computed(() => props.profile.location || props.branding.siteName);

let rafId = 0;
let resizeObserver: ResizeObserver | null = null;
let cleanupPointer: (() => void) | null = null;

interface GlobePoint {
  theta: number;
  phi: number;
  accent: boolean;
}

const globePoints: GlobePoint[] = [];
const ambientPoints = Array.from({ length: 18 }, (_, index) => ({
  angle: Math.random() * Math.PI * 2,
  radius: 0.15 + Math.random() * 0.4,
  drift: 0.15 + Math.random() * 0.45,
  size: 1 + Math.random() * 3,
  offset: index * 0.53,
}));

for (let latIndex = 0; latIndex < 34; latIndex += 1) {
  const latProgress = latIndex / 33;
  const phi = latProgress * Math.PI;
  const density = Math.max(18, Math.round(Math.sin(phi) * 74));

  for (let lonIndex = 0; lonIndex < density; lonIndex += 1) {
    const theta = (lonIndex / density) * Math.PI * 2;
    const signal =
      Math.sin(theta * 2.2) * 0.42 +
      Math.cos(phi * 3.7) * 0.34 +
      Math.sin((theta + phi) * 4.4) * 0.24;

    globePoints.push({
      theta,
      phi,
      accent: signal > 0.38,
    });
  }
}

const renderScene = (time: number) => {
  const canvas = canvasRef.value;
  const host = visualRef.value;
  if (!canvas || !host) return;

  const rect = host.getBoundingClientRect();
  const dpr = window.devicePixelRatio || 1;
  const width = Math.max(10, Math.round(rect.width));
  const height = Math.max(10, Math.round(rect.height));

  if (canvas.width !== Math.round(width * dpr) || canvas.height !== Math.round(height * dpr)) {
    canvas.width = Math.round(width * dpr);
    canvas.height = Math.round(height * dpr);
    canvas.style.width = `${width}px`;
    canvas.style.height = `${height}px`;
  }

  const ctx = canvas.getContext("2d");
  if (!ctx) return;

  ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  ctx.clearRect(0, 0, width, height);

  const tick = time * 0.001;
  const isCompact = width < 680;
  const centerX = width * (isCompact ? 0.5 : 0.52);
  const centerY = height * (isCompact ? 0.39 : 0.44);
  const radius = Math.min(width, height) * (isCompact ? 0.33 : 0.28);
  const rotationY = prefersReducedMotion ? 0.18 : tick * 0.34;
  const rotationX = prefersReducedMotion ? -0.22 : Math.sin(tick * 0.22) * 0.16 - 0.2;

  const aura = ctx.createRadialGradient(centerX, centerY, radius * 0.16, centerX, centerY, radius * 1.55);
  aura.addColorStop(0, "rgba(197,255,82,0.18)");
  aura.addColorStop(0.55, "rgba(77,141,255,0.12)");
  aura.addColorStop(1, "rgba(7,17,23,0)");
  ctx.fillStyle = aura;
  ctx.fillRect(0, 0, width, height);

  ambientPoints.forEach((particle) => {
    const orbitRadius = radius * (1.18 + particle.radius);
    const orbitAngle = tick * particle.drift + particle.angle + particle.offset;
    const x = centerX + Math.cos(orbitAngle) * orbitRadius;
    const y = centerY + Math.sin(orbitAngle * 1.15) * orbitRadius * 0.56;
    ctx.beginPath();
    ctx.fillStyle =
      particle.size > 2.5 ? "rgba(204,255,23,0.38)" : "rgba(173, 201, 228, 0.22)";
    ctx.arc(x, y, particle.size, 0, Math.PI * 2);
    ctx.fill();
  });

  globePoints.forEach((point) => {
    const baseX = Math.sin(point.phi) * Math.cos(point.theta);
    const baseY = Math.cos(point.phi);
    const baseZ = Math.sin(point.phi) * Math.sin(point.theta);

    const rotatedX = baseX * Math.cos(rotationY) - baseZ * Math.sin(rotationY);
    const rotatedZ = baseX * Math.sin(rotationY) + baseZ * Math.cos(rotationY);
    const rotatedY = baseY * Math.cos(rotationX) - rotatedZ * Math.sin(rotationX);
    const depthZ = baseY * Math.sin(rotationX) + rotatedZ * Math.cos(rotationX);

    const perspective = 1 / (2.5 - depthZ);
    const px = centerX + rotatedX * radius * 1.18 * perspective;
    const py = centerY + rotatedY * radius * 1.18 * perspective;

    if (depthZ < -0.88) return;

    const size = point.accent ? 1.15 + perspective * 1.45 : 0.4 + perspective * 0.8;
    const alpha = point.accent
      ? Math.max(0.08, 0.5 + depthZ * 0.45)
      : Math.max(0.03, 0.16 + depthZ * 0.18);

    ctx.beginPath();
    ctx.fillStyle = point.accent
      ? `rgba(245, 251, 255, ${alpha})`
      : `rgba(96, 141, 186, ${alpha})`;
    ctx.arc(px, py, size, 0, Math.PI * 2);
    ctx.fill();
  });

  const rim = ctx.createRadialGradient(
    centerX - radius * 0.2,
    centerY - radius * 0.25,
    radius * 0.18,
    centerX,
    centerY,
    radius * 1.05
  );
  rim.addColorStop(0, "rgba(255,255,255,0.12)");
  rim.addColorStop(0.55, "rgba(150,255,125,0)");
  rim.addColorStop(1, "rgba(120,255,120,0.28)");

  ctx.beginPath();
  ctx.strokeStyle = rim;
  ctx.lineWidth = 1.5;
  ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
  ctx.stroke();

};

const drawScene = (time: number) => {
  renderScene(time);
  rafId = window.requestAnimationFrame(drawScene);
};

onMounted(() => {
  if (!canvasRef.value || !visualRef.value) return;

  renderScene(0);

  if (!prefersReducedMotion) {
    rafId = window.requestAnimationFrame(drawScene);
  }

  if (!prefersReducedMotion) {
    const onMove = (event: PointerEvent) => {
      const rect = visualRef.value?.getBoundingClientRect();
      if (!rect) return;

      const x = (event.clientX - rect.left) / rect.width - 0.5;
      const y = (event.clientY - rect.top) / rect.height - 0.5;

      visualStyle.value = {
        "--visual-tilt-x": `${(-y * 5).toFixed(2)}deg`,
        "--visual-tilt-y": `${(x * 6).toFixed(2)}deg`,
        "--visual-shift-x": `${(x * 14).toFixed(2)}px`,
        "--visual-shift-y": `${(y * 10).toFixed(2)}px`,
      };
    };

    const onLeave = () => {
      visualStyle.value = {
        "--visual-tilt-x": "0deg",
        "--visual-tilt-y": "0deg",
        "--visual-shift-x": "0px",
        "--visual-shift-y": "0px",
      };
    };

    visualRef.value.addEventListener("pointermove", onMove);
    visualRef.value.addEventListener("pointerleave", onLeave);

    cleanupPointer = () => {
      visualRef.value?.removeEventListener("pointermove", onMove);
      visualRef.value?.removeEventListener("pointerleave", onLeave);
    };
  }

  if ("ResizeObserver" in window && visualRef.value) {
    resizeObserver = new ResizeObserver(() => {
      renderScene(performance.now());
    });
    resizeObserver.observe(visualRef.value);
  }
});

onBeforeUnmount(() => {
  if (rafId) {
    window.cancelAnimationFrame(rafId);
  }

  cleanupPointer?.();
  resizeObserver?.disconnect();
});
</script>

<template>
  <div
    ref="visualRef"
    class="system-visual interactive-surface"
    :style="visualStyle"
    data-reveal
    style="--reveal-delay: 160ms"
  >
    <div class="system-visual-backdrop"></div>
    <div class="system-grid-floor"></div>
    <div class="system-vertical-scan"></div>
    <div class="system-rings">
      <span class="system-ring ring-alpha"></span>
      <span class="system-ring ring-beta"></span>
      <span class="system-ring ring-gamma"></span>
      <span class="system-orbit-path orbit-one"><i></i></span>
      <span class="system-orbit-path orbit-two"><i></i></span>
    </div>

    <canvas ref="canvasRef" class="system-globe-canvas" aria-hidden="true"></canvas>

    <div class="system-micro-card top-card">
      <span class="system-chip">SYSTEM ARCHITECTURE</span>
      <strong>{{ branding.siteName }}</strong>
      <small>{{ pulseLabel }}</small>
    </div>

    <div class="system-overlay-cluster">
      <div class="system-micro-card bottom-card">
        <span class="system-chip">API LAYER</span>
        <strong>Stable routes, services, and integrations.</strong>
        <small>Production-ready delivery</small>
      </div>

      <div class="system-avatar-card">
        <img
          v-if="profile.avatarUrl"
          :src="profile.avatarUrl"
          :alt="profile.name"
          class="system-avatar"
          loading="eager"
          decoding="async"
        />
        <div class="system-avatar-meta">
          <span>{{ profile.location }}</span>
          <span class="online-indicator">SEC / YES</span>
        </div>
      </div>
    </div>

    <div class="system-particle-layer" aria-hidden="true">
      <span
        v-for="particle in particles"
        :key="particle.id"
        class="ambient-particle"
        :style="{
          left: particle.left,
          top: particle.top,
          width: particle.size,
          height: particle.size,
          animationDuration: particle.duration,
          animationDelay: particle.delay,
        }"
      ></span>
    </div>
  </div>
</template>
