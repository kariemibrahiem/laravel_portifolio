import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/css/web.css",
        "resources/js/web.jsx",
        "resources/css/portfolio.css",
        "resources/js/portfolio/app.ts",
      ],
      refresh: true,
    }),
    react(),
    vue(),
  ],
});
