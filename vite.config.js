import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import react from "@vitejs/plugin-react";

export default defineConfig({
  plugins: [
    laravel({
      input: ["resources/css/web.css", "resources/js/web.jsx"],
      refresh: true,
    }),
    react(),
  ],
});
