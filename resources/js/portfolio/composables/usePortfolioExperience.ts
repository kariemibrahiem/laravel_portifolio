import { nextTick, onBeforeUnmount, onMounted, ref, type Ref } from "vue";

export function usePortfolioExperience(root: Ref<HTMLElement | null>) {
  const activeSection = ref("top");
  const isReady = ref(false);
  const isScrolled = ref(false);

  const cleanups: Array<() => void> = [];

  const prefersReducedMotion =
    typeof window !== "undefined" &&
    window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  onMounted(async () => {
    await nextTick();

    const host = root.value;
    if (!host) return;

    const revealTargets = Array.from(
      host.querySelectorAll<HTMLElement>("[data-reveal]")
    );

    if (prefersReducedMotion) {
      revealTargets.forEach((element) => element.classList.add("is-visible"));
    } else {
      const revealObserver = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              entry.target.classList.add("is-visible");
              revealObserver.unobserve(entry.target);
            }
          });
        },
        {
          threshold: 0.16,
          rootMargin: "0px 0px -8% 0px",
        }
      );

      revealTargets.forEach((element, index) => {
        if (!element.style.getPropertyValue("--reveal-delay")) {
          element.style.setProperty(
            "--reveal-delay",
            `${Math.min(index * 35, 240)}ms`
          );
        }
        revealObserver.observe(element);
      });

      cleanups.push(() => revealObserver.disconnect());
    }

    const counterTargets = Array.from(
      host.querySelectorAll<HTMLElement>("[data-counter]")
    );

    const animateCounter = (element: HTMLElement) => {
      if (element.dataset.counted === "true") return;

      const target = Number(element.dataset.counter ?? 0);
      if (!Number.isFinite(target)) return;

      element.dataset.counted = "true";

      if (prefersReducedMotion) {
        element.textContent = `${target}`;
        return;
      }

      const startedAt = performance.now();
      const duration = 1200;

      const step = (now: number) => {
        const progress = Math.min((now - startedAt) / duration, 1);
        const eased = 1 - Math.pow(1 - progress, 3);
        element.textContent = `${Math.round(target * eased)}`;

        if (progress < 1) {
          requestAnimationFrame(step);
        }
      };

      requestAnimationFrame(step);
    };

    if (prefersReducedMotion) {
      counterTargets.forEach(animateCounter);
    } else {
      const counterObserver = new IntersectionObserver(
        (entries) => {
          entries.forEach((entry) => {
            if (entry.isIntersecting) {
              animateCounter(entry.target as HTMLElement);
              counterObserver.unobserve(entry.target);
            }
          });
        },
        {
          threshold: 0.55,
        }
      );

      counterTargets.forEach((element) => counterObserver.observe(element));
      cleanups.push(() => counterObserver.disconnect());
    }

    const sections = Array.from(
      host.querySelectorAll<HTMLElement>("section[id]")
    );

    const sectionObserver = new IntersectionObserver(
      (entries) => {
        const visible = entries
          .filter((entry) => entry.isIntersecting)
          .sort((a, b) => b.intersectionRatio - a.intersectionRatio);

        if (visible[0]?.target?.id) {
          activeSection.value = visible[0].target.id;
        }
      },
      {
        threshold: [0.2, 0.4, 0.6, 0.8],
        rootMargin: "-18% 0px -52% 0px",
      }
    );

    sections.forEach((section) => sectionObserver.observe(section));
    cleanups.push(() => sectionObserver.disconnect());

    const updateScrolled = () => {
      isScrolled.value = window.scrollY > 18;
      if (window.scrollY < 100) {
        activeSection.value = "top";
      }
    };

    updateScrolled();
    window.addEventListener("scroll", updateScrolled, { passive: true });
    cleanups.push(() => window.removeEventListener("scroll", updateScrolled));

    const interactiveSurfaces = Array.from(
      host.querySelectorAll<HTMLElement>(".interactive-surface")
    );

    interactiveSurfaces.forEach((surface) => {
      const onMove = (event: PointerEvent) => {
        const rect = surface.getBoundingClientRect();
        const x = event.clientX - rect.left;
        const y = event.clientY - rect.top;
        const px = x / rect.width;
        const py = y / rect.height;

        surface.style.setProperty("--pointer-x", `${x}px`);
        surface.style.setProperty("--pointer-y", `${y}px`);
        surface.style.setProperty("--pointer-xp", `${px}`);
        surface.style.setProperty("--pointer-yp", `${py}`);
        surface.classList.add("is-engaged");
      };

      const onLeave = () => {
        surface.classList.remove("is-engaged");
      };

      surface.addEventListener("pointermove", onMove);
      surface.addEventListener("pointerleave", onLeave);

      cleanups.push(() => {
        surface.removeEventListener("pointermove", onMove);
        surface.removeEventListener("pointerleave", onLeave);
      });
    });

    requestAnimationFrame(() => {
      isReady.value = true;
    });
  });

  onBeforeUnmount(() => {
    cleanups.splice(0).forEach((cleanup) => cleanup());
  });

  return {
    activeSection,
    isReady,
    isScrolled,
    prefersReducedMotion,
  };
}
