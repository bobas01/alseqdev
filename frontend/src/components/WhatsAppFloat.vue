<template>
  <a class="wa-float" :href="whatsappUrl(t('contact.prefill'))" target="_blank" rel="noopener noreferrer">
    {{ t("contact.float") }}
  </a>
</template>

<script setup>
import { useI18n } from "vue-i18n";
import { whatsappUrl } from "../whatsapp";

const { t } = useI18n();
</script>
