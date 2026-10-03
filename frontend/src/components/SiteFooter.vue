<template>
  <footer class="site-footer">
    <LogoMark theme="dark" />
    <p>{{ t("location") }}</p>
    <button class="whatsapp" type="button" @click="openGuide">
      {{ t("whatsapp") }}
    </button>
    <nav class="legal-links" :aria-label="t('footer.legal')">
      <router-link :to="`/${locale}/confidentialite`">{{ t("footer.privacy") }}</router-link>
      <router-link :to="`/${locale}/mentions`">{{ t("footer.notice") }}</router-link>
    </nav>
    <p class="rights">© {{ year }} ALSEQ DEV. {{ t("rights") }}</p>
  </footer>
</template>

<script setup>
import { computed } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import { openGuide } from "../chat";
import LogoMark from "./LogoMark.vue";

const { t } = useI18n();
const route = useRoute();
const locale = computed(() => route.params.locale ?? "pt-br");
const year = new Date().getFullYear();
</script>
