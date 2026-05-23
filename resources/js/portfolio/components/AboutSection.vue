<script setup lang="ts">
import type { About } from "../types/portfolio";

defineProps<{
  about: About;
}>();
</script>

<template>
  <section class="section" id="about">
    <div class="container about-grid">
      <div data-reveal style="--reveal-delay: 0ms">
        <div class="terminal-row">
          <span class="line"></span>
          <span>{{ about.eyebrow }}</span>
        </div>
        <h2 class="section-title">{{ about.title }}</h2>
      </div>

      <div class="about-card panel interactive-surface" data-reveal style="--reveal-delay: 120ms">
        <p class="section-copy">{{ about.description }}</p>
        <div class="about-highlight-grid">
          <div
            v-for="(item, index) in about.highlights"
            :key="item"
            class="about-highlight"
            data-reveal
            :style="{ '--reveal-delay': `${180 + index * 60}ms` }"
          >
            <span class="highlight-marker"></span>
            <span>{{ item }}</span>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
