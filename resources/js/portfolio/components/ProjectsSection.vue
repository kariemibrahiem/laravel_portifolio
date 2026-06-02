<script setup lang="ts">
import type { ProjectItem } from "../types/portfolio";

defineProps<{
  featuredProjects: ProjectItem[];
  projects: ProjectItem[];
}>();
</script>

<template>
  <section class="section" id="projects">
    <div class="container">
      <div class="section-heading" data-reveal style="--reveal-delay: 0ms">
        <div class="terminal-row">
          <span class="line"></span>
          <span>CASE STUDIES</span>
        </div>
        <h2 class="section-title">Projects shaped around real business constraints.</h2>
        <p class="section-copy">
          Laravel systems for operations, education, legal workflows, real estate, commerce,
          and platform management.
        </p>
      </div>

      <div v-if="featuredProjects.length" class="featured-projects">
        <article
          v-for="(project, index) in featuredProjects"
          :key="project.id"
          class="project-card project-card-featured panel interactive-surface"
          data-reveal
          :style="{ '--reveal-delay': `${120 + index * 90}ms` }"
        >
          <div class="project-media">
            <img
              v-if="project.imageUrl"
              :src="project.imageUrl"
              :alt="project.title"
              class="project-image"
              loading="lazy"
              decoding="async"
            />
            <div v-else class="project-image-fallback"></div>
          </div>
          <div class="project-content">
            <div class="project-badges">
              <span v-for="badge in project.badges" :key="badge" class="tech-pill">{{ badge }}</span>
            </div>
            <h3>{{ project.title }}</h3>
            <p>{{ project.shortDescription }}</p>
            <div class="project-meta">
              <span v-if="project.partner">Partner: {{ project.partner.name }}</span>
              <span v-if="project.collaborators.length">
                Team: {{ project.collaborators.map((item) => item.name).join(", ") }}
              </span>
            </div>
            <div
              v-if="project.websiteUrl || project.googlePlayUrl || project.appStoreUrl"
              class="project-actions"
            >
              <a
                v-if="project.websiteUrl"
                class="btn btn-ghost"
                :href="project.websiteUrl"
                target="_blank"
                rel="noopener noreferrer"
              >
                Visit Website
              </a>
              <a
                v-if="project.googlePlayUrl"
                class="btn btn-ghost"
                :href="project.googlePlayUrl"
                target="_blank"
                rel="noopener noreferrer"
              >
                Google Play
              </a>
              <a
                v-if="project.appStoreUrl"
                class="btn btn-ghost"
                :href="project.appStoreUrl"
                target="_blank"
                rel="noopener noreferrer"
              >
                App Store
              </a>
            </div>
          </div>
        </article>
      </div>

      <div v-if="projects.length" class="project-grid">
        <article
          v-for="(project, index) in projects"
          :key="project.id"
          class="project-card panel interactive-surface"
          data-reveal
          :style="{ '--reveal-delay': `${180 + index * 65}ms` }"
        >
          <div class="project-media compact">
            <img
              v-if="project.imageUrl"
              :src="project.imageUrl"
              :alt="project.title"
              class="project-image"
              loading="lazy"
              decoding="async"
            />
            <div v-else class="project-image-fallback"></div>
          </div>
          <div class="project-content">
            <div class="project-badges">
              <span v-for="badge in project.badges" :key="badge" class="tech-pill">{{ badge }}</span>
            </div>
            <h3>{{ project.title }}</h3>
            <p>{{ project.shortDescription }}</p>
            <div
              v-if="project.websiteUrl || project.googlePlayUrl || project.appStoreUrl"
              class="project-actions compact"
            >
              <a
                v-if="project.websiteUrl"
                class="project-link"
                :href="project.websiteUrl"
                target="_blank"
                rel="noopener noreferrer"
              >
                Website
              </a>
              <a
                v-if="project.googlePlayUrl"
                class="project-link"
                :href="project.googlePlayUrl"
                target="_blank"
                rel="noopener noreferrer"
              >
                Google Play
              </a>
              <a
                v-if="project.appStoreUrl"
                class="project-link"
                :href="project.appStoreUrl"
                target="_blank"
                rel="noopener noreferrer"
              >
                App Store
              </a>
            </div>
          </div>
        </article>
      </div>

      <div
        v-if="!featuredProjects.length && !projects.length"
        class="empty-state panel interactive-surface"
        data-reveal
      >
        No project records are available yet.
      </div>
    </div>
  </section>
</template>
