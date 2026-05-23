<script setup lang="ts">
import { computed, ref } from "vue";
import type { Branding, HeroCta } from "../types/portfolio";

const props = defineProps<{
  branding: Branding;
  heroCta: HeroCta;
  activeSection: string;
  scrolled: boolean;
}>();

const isOpen = ref(false);
const links = computed(() => [
  { label: "Work", href: "#projects", section: "projects" },
  { label: "Skills", href: "#skills", section: "skills" },
  { label: "Experience", href: "#experience", section: "experience" },
  { label: "Contact", href: "#contact", section: "contact" },
]);
</script>

<template>
  <header class="nav-shell" :class="{ 'is-scrolled': scrolled, 'menu-open': isOpen }">
    <div class="container nav-inner">
      <a href="#top" class="brand">
        <span class="brand-mark">{{ branding.mark }}</span>
        <span class="brand-name">{{ branding.siteName }}</span>
      </a>

      <nav class="nav-links" aria-label="Primary">
        <a
          v-for="link in links"
          :key="link.href"
          :href="link.href"
          :class="{ active: activeSection === link.section }"
          :aria-current="activeSection === link.section ? 'page' : undefined"
        >
          {{ link.label }}
        </a>
      </nav>

      <a class="btn btn-ghost nav-cta" :href="heroCta.href">{{ heroCta.label }}</a>

      <button
        class="nav-toggle"
        type="button"
        :aria-expanded="isOpen ? 'true' : 'false'"
        aria-label="Toggle menu"
        @click="isOpen = !isOpen"
      >
        <span></span>
        <span></span>
      </button>
    </div>

    <transition name="nav-sheet">
      <div v-if="isOpen" class="nav-mobile">
        <a
          v-for="link in links"
          :key="link.href"
          :href="link.href"
          :class="{ active: activeSection === link.section }"
          @click="isOpen = false"
        >
          {{ link.label }}
        </a>
        <a class="btn btn-primary nav-mobile-cta" :href="heroCta.href" @click="isOpen = false">
          {{ heroCta.label }}
        </a>
      </div>
    </transition>
  </header>
</template>
