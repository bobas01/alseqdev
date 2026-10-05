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
    <label class="languages">
      <span class="visually-hidden">{{ t("languages") }}</span>
      <select class="lang-select" :value="locale" @change="onLocale">
        <option v-for="item in locales" :key="item.code" :value="item.code" :lang="item.lang">
          {{ item.label }}
        </option>
      </select>
    </label>
  </header>
</template>

<script setup>
import { computed } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute, useRouter } from "vue-router";
import { blogNav } from "../blog";
import LogoMark from "./LogoMark.vue";

const { t } = useI18n();
const route = useRoute();
const router = useRouter();
const locale = computed(() => route.params.locale ?? "pt-br");

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
