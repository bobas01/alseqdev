import { createRouter, createWebHistory } from "vue-router";
import { htmlLanguage, i18n, LOCALES } from "./i18n";
import HomeView from "./views/HomeView.vue";

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
    {
      path: `/:locale(${localePattern})`,
      name: "home",
      component: HomeView,
    },
    { path: "/:pathMatch(.*)*", redirect: "/pt-br" },
  ],
});

router.beforeEach((to) => {
  const locale = to.params.locale;
  if (typeof locale === "string" && LOCALES.includes(locale)) {
    i18n.global.locale.value = locale;
    document.documentElement.lang = htmlLanguage(locale);
    document.title = i18n.global.t("metaTitle");
    const meta = document.querySelector('meta[name="description"]');
    if (meta) {
      meta.setAttribute("content", i18n.global.t("metaDescription"));
    }
  }
});
