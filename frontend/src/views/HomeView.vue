<template>
  <section class="opening">
    <p>{{ t("tagline") }}</p>
  </section>
</template>

<script setup>
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>
