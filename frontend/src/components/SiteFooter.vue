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
    <p class="rights">© {{ year }} ALSEQ DEV. {{ t("rights") }}</p>
  </footer>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import LogoMark from "./LogoMark.vue";
import { whatsappUrl } from "../whatsapp";

const { t } = useI18n();
const year = new Date().getFullYear();
</script>
