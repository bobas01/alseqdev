<template>
  <footer class="site-footer">
    <LogoMark theme="dark" />
    <p>{{ t("location") }}</p>
    <a
      class="whatsapp"
      href="https://wa.me/5562991525466"
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

const { t } = useI18n();
const year = new Date().getFullYear();
</script>
