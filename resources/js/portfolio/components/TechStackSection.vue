<script setup lang="ts">
import type { TechItem } from "../types/portfolio";

defineProps<{
  items: TechItem[];
}>();
</script>

<template>
  <section class="section" id="tech">
    <div class="container">
      <div class="section-heading" data-reveal style="--reveal-delay: 0ms">
        <div class="terminal-row">
          <span class="line"></span>
          <span>BACKEND CAPABILITIES</span>
        </div>
        <h2 class="section-title">Operational depth across the stack.</h2>
      </div>

      <div v-if="items.length" class="tech-grid">
        <article
          v-for="(item, index) in items"
          :key="item.id"
          class="tech-card panel interactive-surface"
          data-reveal
          :style="{ '--reveal-delay': `${80 + index * 60}ms` }"
        >
          <div class="tech-index">L{{ item.sortOrder }}</div>
          <h3>{{ item.title }}</h3>
          <p>{{ item.description || "Capability tracked in the current portfolio stack." }}</p>
        </article>
      </div>

      <div v-else class="empty-state panel interactive-surface" data-reveal>
        No capabilities are available yet.
      </div>
    </div>
  </section>
</template>
