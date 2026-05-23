import { createApp } from "vue";
import App from "./App.vue";
import type { PortfolioPagePayload } from "./types/portfolio";

const element = document.getElementById("portfolio-app");
const payloadElement = document.getElementById("portfolio-page-data");

if (element && payloadElement) {
  const raw = payloadElement.textContent?.trim() ?? "{}";
  const page = JSON.parse(raw) as PortfolioPagePayload;

  createApp(App, { page }).mount(element);
}
