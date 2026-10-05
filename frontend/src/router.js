import { createRouter, createWebHistory } from "vue-router";
import { htmlLanguage, i18n, LOCALES } from "./i18n";
import AdminView from "./views/AdminView.vue";
import ArticleView from "./views/ArticleView.vue";
import BlogView from "./views/BlogView.vue";
import HomeView from "./views/HomeView.vue";
import LegalView from "./views/LegalView.vue";

const localePattern = LOCALES.join("|");

export const router = createRouter({
  history: createWebHistory(),
  scrollBehavior(to) {
    if (to.hash) {
      return { el: to.hash, top: 88, behavior: "smooth" };
    }
    return { top: 0 };
  },
  routes: [
    { path: "/", redirect: "/pt-br" },
    { path: "/admin", name: "admin", component: AdminView },
    {
      path: `/:locale(${localePattern})/confidentialite`,
      name: "privacy",
      component: LegalView,
      meta: { page: "privacy" },
    },
    {
      path: `/:locale(${localePattern})/mentions`,
      name: "notice",
      component: LegalView,
      meta: { page: "notice" },
    },
    {
      path: `/:locale(${localePattern})/journal/:slug`,
      redirect: (to) => `/${to.params.locale}/blog/${to.params.slug}`,
    },
    {
      path: `/:locale(${localePattern})/journal`,
      redirect: (to) => ({ name: "blog", params: { locale: to.params.locale } }),
    },
    {
      path: `/:locale(${localePattern})/blog/:slug`,
      name: "article",
      component: ArticleView,
    },
    {
      path: `/:locale(${localePattern})/blog`,
      name: "blog",
      component: BlogView,
      meta: { page: "blog" },
    },
    {
      path: `/:locale(${localePattern})`,
      name: "home",
      component: HomeView,
    },
    { path: "/:pathMatch(.*)*", redirect: "/pt-br" },
  ],
});

router.beforeEach((to) => {
  if (to.name === "admin") {
    document.documentElement.lang = "fr";
    document.title = "Messages — ALSEQ DEV";
    setRobots("noindex, nofollow");
    return;
  }

  setRobots("");
  const locale = to.params.locale;
  if (typeof locale === "string" && LOCALES.includes(locale)) {
    i18n.global.locale.value = locale;
    document.documentElement.lang = htmlLanguage(locale);
    if (to.name === "article") {
      document.title = i18n.global.t("metaTitle");
    } else {
      const page = typeof to.meta.page === "string" ? to.meta.page : "";
      document.title = page
        ? `${i18n.global.t(`${page}.title`)} — ALSEQ DEV`
        : i18n.global.t("metaTitle");
    }
    const meta = document.querySelector('meta[name="description"]');
    if (meta) {
      meta.setAttribute("content", i18n.global.t("metaDescription"));
    }
  }
});

function setRobots(content) {
  let meta = document.querySelector('meta[name="robots"]');
  if (!content) {
    meta?.remove();
    return;
  }
  if (!meta) {
    meta = document.createElement("meta");
    meta.setAttribute("name", "robots");
    document.head.appendChild(meta);
  }
  meta.setAttribute("content", content);
}
