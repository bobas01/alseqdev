<template>
  <header class="site-header">
    <router-link class="brand" :to="`/${locale}`" aria-label="ALSEQ DEV">
      <LogoMark theme="light" />
    </router-link>
    <nav class="site-nav" :aria-label="t('nav.label')">
      <a :href="`/${locale}#services`">{{ t("nav.services") }}</a>
      <a :href="`/${locale}#methode`">{{ t("nav.method") }}</a>
      <router-link
        :to="`/${locale}/blog`"
        :aria-current="route.name === 'blog' || route.name === 'article' ? 'page' : undefined"
      >
        {{ t("nav.blog") }}
      </router-link>
      <a :href="`/${locale}#contact`">{{ t("nav.contact") }}</a>
    </nav>
    <div class="header-tools">
      <button
        class="theme-toggle"
        type="button"
        :aria-pressed="theme === 'dark'"
        :aria-label="t(theme === 'dark' ? 'theme.toLight' : 'theme.toDark')"
        @click="onTheme"
      >
        <svg v-if="theme === 'dark'" viewBox="0 0 24 24" aria-hidden="true">
          <circle cx="12" cy="12" r="4" fill="none" stroke="currentColor" stroke-width="1.8" />
          <path
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linecap="round"
            d="M12 3v2M12 19v2M3 12h2M19 12h2M5.6 5.6l1.4 1.4M17 17l1.4 1.4M18.4 5.6 17 7M7 17l-1.4 1.4"
          />
        </svg>
        <svg v-else viewBox="0 0 24 24" aria-hidden="true">
          <path
            fill="none"
            stroke="currentColor"
            stroke-width="1.8"
            stroke-linejoin="round"
            d="M15 3.5A8 8 0 1 0 20.5 14 6.5 6.5 0 0 1 15 3.5z"
          />
        </svg>
      </button>
      <label class="languages">
        <span class="visually-hidden">{{ t("languages") }}</span>
        <select class="lang-select" :value="locale" @change="onLocale">
          <option v-for="item in locales" :key="item.code" :value="item.code" :lang="item.lang">
            {{ item.label }}
          </option>
        </select>
      </label>
    </div>
  </header>
</template>

<script setup>
import { computed, ref } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute, useRouter } from "vue-router";
import { blogNav } from "../blog";
import LogoMark from "./LogoMark.vue";

const { t } = useI18n();
const route = useRoute();
const router = useRouter();
const locale = computed(() => route.params.locale ?? "pt-br");
const theme = ref(document.documentElement.dataset.theme === "dark" ? "dark" : "light");

function onTheme() {
  theme.value = theme.value === "dark" ? "light" : "dark";
  document.documentElement.dataset.theme = theme.value;
  try {
    localStorage.setItem("alseq-theme", theme.value);
  } catch {
    /* the choice still applies for this visit */
  }
}

function localeTo(code) {
  if (route.name === "privacy" || route.name === "notice" || route.name === "blog") {
    return { name: route.name, params: { locale: code } };
  }
  if (route.name === "article") {
    const slug = blogNav.translations[code];
    if (slug) {
      return { name: "article", params: { locale: code, slug } };
    }
    return { name: "blog", params: { locale: code } };
  }
  return `/${code}`;
}

function onLocale(event) {
  const code = event.target.value;
  if (code === locale.value) {
    return;
  }
  router.push(localeTo(code));
}

const locales = [
  { code: "pt-br", label: "Português", lang: "pt-BR" },
  { code: "fr", label: "Français", lang: "fr" },
  { code: "en", label: "English", lang: "en" },
  { code: "es", label: "Español", lang: "es" },
];
</script>
