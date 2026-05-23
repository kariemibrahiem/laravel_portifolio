import { computed, toRef } from "vue";
import type { PortfolioPagePayload } from "../types/portfolio";

export function usePortfolioData(props: { page: PortfolioPagePayload }) {
  const page = toRef(props, "page");

  const featuredProjects = computed(() =>
    page.value.projects.filter((project) => project.featured)
  );

  const standardProjects = computed(() =>
    page.value.projects.filter((project) => !project.featured)
  );

  return {
    page,
    featuredProjects,
    standardProjects,
  };
}
