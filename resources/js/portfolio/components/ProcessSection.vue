<script setup lang="ts">
import type { ProcessItem } from "../types/portfolio";

defineProps<{
  items: ProcessItem[];
}>();
</script>

<template>
  <section class="section" id="process">
    <div class="container process-grid">
      <div data-reveal style="--reveal-delay: 0ms">
        <div class="terminal-row">
          <span class="line"></span>
          <span>SYSTEM ARCHITECTURE</span>
        </div>
        <h2 class="section-title">Layered delivery for production-ready backend systems.</h2>
        <p class="section-copy">
          Each project moves through a predictable backend workflow: discovery, data modeling,
          APIs, integrations, and long-tail maintenance.
        </p>
      </div>

      <div class="process-timeline panel interactive-surface" data-reveal style="--reveal-delay: 120ms">
        <article
          v-for="(item, index) in items"
          :key="item.phase"
          class="process-step"
          data-reveal
          :style="{ '--reveal-delay': `${180 + index * 85}ms` }"
        >
          <div class="process-phase">PHASE {{ item.phase }}</div>
          <div class="process-dot"></div>
          <div class="process-copy">
            <h3>{{ item.title }}</h3>
            <p>{{ item.description }}</p>
          </div>
        </article>
      </div>
    </div>
  </section>
</template>
