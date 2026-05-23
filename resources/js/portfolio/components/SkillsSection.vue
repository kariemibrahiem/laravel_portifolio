<script setup lang="ts">
import type { SkillItem } from "../types/portfolio";

defineProps<{
  items: SkillItem[];
}>();
</script>

<template>
  <section class="section" id="skills">
    <div class="container">
      <div class="section-heading" data-reveal style="--reveal-delay: 0ms">
        <div class="terminal-row">
          <span class="line"></span>
          <span>STACK ONLINE</span>
        </div>
        <h2 class="section-title">Skills in action, not just on paper.</h2>
      </div>

      <div v-if="items.length" class="skill-grid">
        <article
          v-for="(skill, index) in items"
          :key="skill.id"
          class="skill-card panel interactive-surface"
          data-reveal
          :style="{ '--reveal-delay': `${80 + index * 55}ms` }"
        >
          <div class="skill-icon">
            <img
              v-if="skill.iconType === 'image' && skill.iconUrl"
              :src="skill.iconUrl"
              :alt="skill.name"
              loading="lazy"
              decoding="async"
            />
            <i v-else-if="skill.iconValue" :class="skill.iconValue"></i>
            <span v-else>{{ skill.name.slice(0, 2).toUpperCase() }}</span>
          </div>
          <div>
            <h3>{{ skill.name }}</h3>
            <p>Production-focused backend capability.</p>
          </div>
        </article>
      </div>

      <div v-else class="empty-state panel interactive-surface" data-reveal>
        No skills are available yet.
      </div>
    </div>
  </section>
</template>
