<template>
  <header class="site-header">
    <router-link class="brand" :to="`/${locale}`" aria-label="ALSEQ DEV">
      <LogoMark theme="light" />
    </router-link>
    <nav class="languages" :aria-label="t('languages')">
      <router-link
        v-for="item in locales"
        :key="item.code"
        :to="`/${item.code}`"
        :class="{ active: item.code === locale }"
        :hreflang="item.lang"
        :lang="item.lang"
      >
        {{ item.label }}
      </router-link>
    </nav>
  </header>
</template>

<script setup>
import { computed } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import LogoMark from "./LogoMark.vue";

const { t } = useI18n();
const route = useRoute();
const locale = computed(() => route.params.locale ?? "pt-br");

const locales = [
  { code: "pt-br", label: "PT", lang: "pt-BR" },
  { code: "fr", label: "FR", lang: "fr" },
  { code: "en", label: "EN", lang: "en" },
  { code: "es", label: "ES", lang: "es" },
];
</script>
