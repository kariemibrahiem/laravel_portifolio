<script setup lang="ts">
import { ref } from "vue";
import Navbar from "./components/Navbar.vue";
import HeroSection from "./components/HeroSection.vue";
import StatsSection from "./components/StatsSection.vue";
import AboutSection from "./components/AboutSection.vue";
import ProcessSection from "./components/ProcessSection.vue";
import ExperienceTimeline from "./components/ExperienceTimeline.vue";
import ProjectsSection from "./components/ProjectsSection.vue";
import SkillsSection from "./components/SkillsSection.vue";
import TechStackSection from "./components/TechStackSection.vue";
import ContactSection from "./components/ContactSection.vue";
import FooterSection from "./components/FooterSection.vue";
import { usePortfolioData } from "./composables/usePortfolioData";
import { usePortfolioExperience } from "./composables/usePortfolioExperience";
import type { PortfolioPagePayload } from "./types/portfolio";

const props = defineProps<{
  page: PortfolioPagePayload;
}>();

const shellRef = ref<HTMLElement | null>(null);
const { page, featuredProjects, standardProjects } = usePortfolioData(props);
const { activeSection, isReady, isScrolled } = usePortfolioExperience(shellRef);
</script>

<template>
  <div
    ref="shellRef"
    class="portfolio-shell"
    :class="{ 'app-is-ready': isReady, 'is-scrolled': isScrolled }"
  >
    <div class="portfolio-noise"></div>
    <div class="portfolio-ambient aurora-left"></div>
    <div class="portfolio-ambient aurora-right"></div>
    <div class="portfolio-ambient aurora-bottom"></div>

    <Navbar
      :branding="page.branding"
      :hero-cta="page.hero.primaryCta"
      :active-section="activeSection"
      :scrolled="isScrolled"
    />

    <main class="portfolio-main">
      <HeroSection
        :branding="page.branding"
        :profile="page.profile"
        :hero="page.hero"
        :stats="page.stats"
      />
      <StatsSection :stats="page.stats" />
      <AboutSection :about="page.about" />
      <ProcessSection :items="page.process" />
      <ExperienceTimeline :items="page.experiences" />
      <ProjectsSection
        :featured-projects="featuredProjects"
        :projects="standardProjects"
      />
      <SkillsSection :items="page.skills" />
      <TechStackSection :items="page.techs" />
      <ContactSection
        :contact="page.contact"
        :socials="page.socials"
        :profile="page.profile"
      />
    </main>

    <FooterSection
      :branding="page.branding"
      :socials="page.socials"
      :contact="page.contact"
    />
  </div>
</template>
