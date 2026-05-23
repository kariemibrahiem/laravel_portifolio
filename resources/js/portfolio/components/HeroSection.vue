<script setup lang="ts">
import { computed } from "vue";
import HeroSystemVisual from "./HeroSystemVisual.vue";
import type { Branding, Hero, Profile, StatItem } from "../types/portfolio";

const props = defineProps<{
  branding: Branding;
  profile: Profile;
  hero: Hero;
  stats: StatItem[];
}>();

const heroNameLines = computed(() => {
  const words = props.profile.name.trim().split(/\s+/).filter(Boolean);

  if (words.length <= 1) {
    return [props.profile.name];
  }

  if (words.length === 2) {
    return words;
  }

  const splitIndex = Math.ceil(words.length / 2);

  return [
    words.slice(0, splitIndex).join(" "),
    words.slice(splitIndex).join(" "),
  ];
});
</script>

<template>
  <section id="top" class="hero-section section">
    <div class="hero-grid container">
      <div class="hero-copy" data-reveal style="--reveal-delay: 20ms">
        <div class="section-label hero-eyebrow">
          <span class="status-dot"></span>
          {{ hero.eyebrow }}
        </div>

        <div class="terminal-row">
          <span class="line"></span>
          <span>{{ profile.role }}</span>
        </div>

        <h1 class="hero-title">
          <span v-for="line in heroNameLines" :key="line" class="hero-title-line">{{ line }}</span>
        </h1>
        <h2 class="hero-subtitle">{{ hero.title }}</h2>
        <p class="hero-description">{{ hero.subtitle }}</p>
        <p class="hero-support">{{ hero.description }}</p>
        <p class="hero-tagline">{{ profile.tagline }}</p>

        <div class="hero-actions">
          <a class="btn btn-primary" :href="hero.primaryCta.href">{{ hero.primaryCta.label }}</a>
          <a class="btn btn-ghost" :href="hero.secondaryCta.href">{{ hero.secondaryCta.label }}</a>
        </div>

        <div class="hero-pill-row">
          <span v-for="label in hero.terminalLabels" :key="label" class="tech-pill">{{ label }}</span>
        </div>
      </div>

      <div class="hero-visual-column">
        <HeroSystemVisual :branding="branding" :profile="profile" />
      </div>
    </div>
  </section>
</template>
