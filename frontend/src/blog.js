import { reactive } from "vue";

export const BLOG_CATEGORIES = ["developpement", "devops", "cybersecurite", "ia"];

export const blogNav = reactive({
  translations: {},
});

export function parseBlocks(body) {
  if (!body) {
    return [];
  }
  const normalized = body.replace(/\r\n/g, "\n").replace(/\r/g, "\n");
  return normalized.split(/\n{2,}/).map((chunk) => {
    const lines = chunk.split("\n").filter((line) => line.length > 0);
    if (lines.length > 0 && lines.every((line) => line.startsWith("- "))) {
      return { type: "list", items: lines.map((line) => line.slice(2)) };
    }
    if (lines[0]?.startsWith("## ")) {
      return { type: "heading", text: lines[0].slice(3).trim() };
    }
    return { type: "paragraph", text: lines.join(" ") };
  });
}
