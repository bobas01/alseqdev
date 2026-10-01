<template>
  <footer class="site-footer">
    <LogoMark theme="dark" />
    <p>{{ t("location") }}</p>
    <a
      class="whatsapp"
      :href="whatsappUrl()"
      rel="noopener noreferrer"
      target="_blank"
    >
      {{ t("whatsapp") }}
    </a>
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
import LogoMark from "./LogoMark.vue";
import { whatsappUrl } from "../whatsapp";

const { t } = useI18n();
const route = useRoute();
const locale = computed(() => route.params.locale ?? "pt-br");
const year = new Date().getFullYear();
</script>
