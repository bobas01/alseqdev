(function () {
  try {
    var saved = localStorage.getItem("alseq-theme");
    var theme =
      saved === "dark" || saved === "light"
        ? saved
        : matchMedia("(prefers-color-scheme: dark)").matches
          ? "dark"
          : "light";
    document.documentElement.dataset.theme = theme;
  } catch (error) {
    /* keep the light page */
  }
})();
