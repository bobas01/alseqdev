import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

const securityHeaders = {
  "X-Content-Type-Options": "nosniff",
  "X-Frame-Options": "DENY",
  "Referrer-Policy": "strict-origin-when-cross-origin",
  "Permissions-Policy": "camera=(), microphone=(), geolocation=()",
  "X-Permitted-Cross-Domain-Policies": "none",
};

export default defineConfig({
  plugins: [vue()],
  server: {
    port: 5173,
    strictPort: true,
    headers: securityHeaders,
    proxy: {
      "/api": "http://127.0.0.1:8000",
    },
  },
  preview: {
    headers: securityHeaders,
  },
});
