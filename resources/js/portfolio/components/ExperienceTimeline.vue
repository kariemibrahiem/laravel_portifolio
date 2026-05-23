<script setup lang="ts">
import type { ExperienceItem } from "../types/portfolio";

defineProps<{
  items: ExperienceItem[];
}>();
</script>

<template>
  <section class="section" id="experience">
    <div class="container">
      <div class="section-heading" data-reveal style="--reveal-delay: 0ms">
        <div class="terminal-row">
          <span class="line"></span>
          <span>EXPERIENCE LOG</span>
        </div>
        <h2 class="section-title">Experience under real delivery pressure.</h2>
      </div>

      <div v-if="items.length" class="experience-list">
        <article
          v-for="(item, index) in items"
          :key="item.id"
          class="experience-item panel interactive-surface"
          data-reveal
          :style="{ '--reveal-delay': `${80 + index * 80}ms` }"
        >
          <div class="experience-rail">
            <div class="experience-badge" :style="{ borderColor: item.borderColor || '' }">
              {{ item.sortOrder.toString().padStart(2, '0') }}
            </div>
            <div class="experience-line"></div>
          </div>

          <div class="experience-content">
            <div class="experience-meta">
              <span>{{ item.company }}</span>
              <span>{{ item.startDate }} - {{ item.endDate }}</span>
            </div>
            <h3>{{ item.title }}</h3>
            <p>{{ item.description }}</p>
          </div>
        </article>
      </div>

      <div v-else class="empty-state panel interactive-surface" data-reveal>
        No experience records are available yet.
      </div>
    </div>
  </section>
</template>
