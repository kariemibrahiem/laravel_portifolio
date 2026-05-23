<script setup lang="ts">
import type { Branding, Contact, SocialItem } from "../types/portfolio";

defineProps<{
  branding: Branding;
  socials: SocialItem[];
  contact: Contact;
}>();
</script>

<template>
  <footer class="footer-shell" data-reveal style="--reveal-delay: 80ms">
    <div class="container footer-grid">
      <div data-reveal style="--reveal-delay: 120ms">
        <a href="#top" class="brand footer-brand">
          <span class="brand-mark">{{ branding.mark }}</span>
          <span class="brand-name">{{ branding.siteName }}</span>
        </a>
        <p class="footer-copy">
          Laravel backend systems, APIs, dashboards, and production maintenance built with care.
        </p>
      </div>

      <div data-reveal style="--reveal-delay: 180ms">
        <h3>Quick Links</h3>
        <div class="footer-links">
          <a href="#projects">Work</a>
          <a href="#skills">Skills</a>
          <a href="#experience">Experience</a>
          <a href="#contact">Contact</a>
        </div>
      </div>

      <div data-reveal style="--reveal-delay: 240ms">
        <h3>Connect</h3>
        <div class="footer-links">
          <a
            v-for="social in socials"
            :key="social.label"
            :href="social.url"
            target="_blank"
            rel="noopener noreferrer"
          >
            {{ social.label }}
          </a>
          <a :href="`mailto:${contact.email}`">{{ contact.email }}</a>
        </div>
      </div>
    </div>

    <div class="container footer-bottom">
      <span>&copy; {{ new Date().getFullYear() }} {{ branding.siteName }}. All rights reserved.</span>
      <span>Public Vue frontend isolated from the admin dashboard.</span>
    </div>
  </footer>
</template>
