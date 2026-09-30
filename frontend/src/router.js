import { createRouter, createWebHistory } from "vue-router";
import { htmlLanguage, i18n, LOCALES } from "./i18n";
import HomeView from "./views/HomeView.vue";

const localePattern = LOCALES.join("|");

export const router = createRouter({
  history: createWebHistory(),
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
  }
});
