<script setup lang="ts">
import type { StatItem } from "../types/portfolio";

defineProps<{
  stats: StatItem[];
}>();
</script>

<template>
  <section class="section stats-strip-section">
    <div class="container">
      <div class="stats-strip">
        <article
          v-for="(stat, index) in stats"
          :key="stat.label"
          class="stat-card interactive-surface"
          data-reveal
          :style="{ '--reveal-delay': `${80 + index * 70}ms` }"
        >
          <div class="stat-value">
            <span class="stat-number" :data-counter="stat.value">0</span><span class="stat-suffix">{{ stat.suffix }}</span>
          </div>
          <p>{{ stat.label }}</p>
        </article>
      </div>
    </div>
  </section>
</template>
