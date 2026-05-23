<script setup lang="ts">
import type { Contact, Profile, SocialItem } from "../types/portfolio";

defineProps<{
  contact: Contact;
  socials: SocialItem[];
  profile: Profile;
}>();
</script>

<template>
  <section class="section" id="contact">
    <div class="container contact-grid">
      <div class="contact-copy" data-reveal style="--reveal-delay: 0ms">
        <div class="terminal-row">
          <span class="line"></span>
          <span>{{ contact.eyebrow }}</span>
        </div>
        <h2 class="contact-title">{{ contact.title }}</h2>
        <p class="section-copy">{{ contact.description }}</p>
        <p class="contact-availability">{{ profile.availability }}</p>
        <a class="btn btn-primary" :href="contact.primaryCta.href">{{ contact.primaryCta.label }}</a>
      </div>

      <div class="contact-panels">
        <a
          v-for="(social, index) in socials"
          :key="social.label"
          :href="social.url"
          class="contact-card panel interactive-surface"
          target="_blank"
          rel="noopener noreferrer"
          data-reveal
          :style="{ '--reveal-delay': `${120 + index * 70}ms` }"
        >
          <span class="contact-card-abbr">{{ social.abbr }}</span>
          <strong>{{ social.label }}</strong>
          <span>{{ social.meta }}</span>
        </a>

        <div
          class="contact-card panel contact-card-details interactive-surface"
          data-reveal
          :style="{ '--reveal-delay': `${120 + socials.length * 70}ms` }"
        >
          <strong>Email</strong>
          <span>{{ contact.email }}</span>
          <strong>Phone</strong>
          <span>{{ contact.phone }}</span>
          <strong>Location</strong>
          <span>{{ contact.location }}</span>
        </div>
      </div>
    </div>
  </section>
</template>
