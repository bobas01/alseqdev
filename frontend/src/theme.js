const KEY = "alseq-theme";

export function readTheme() {
  try {
    const saved = localStorage.getItem(KEY);
    if (saved === "dark" || saved === "light") {
      return saved;
    }
  } catch {
    /* private browsing keeps the choice for this visit */
  }

  const current = document.documentElement.dataset.theme;
  if (current === "dark" || current === "light") {
    return current;
  }

  return window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
}

export function applyStoredTheme() {
  const theme = readTheme();
  document.documentElement.dataset.theme = theme;
  return theme;
}

export function toggleTheme() {
  const next = document.documentElement.dataset.theme === "dark" ? "light" : "dark";
  document.documentElement.dataset.theme = next;
  try {
    localStorage.setItem(KEY, next);
  } catch {
    /* the choice still applies for this visit */
  }
  return next;
}
