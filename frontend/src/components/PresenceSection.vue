<script setup>
import { useI18n } from "vue-i18n";

const { t } = useI18n();
</script>

<template>
  <section class="band band-ink presence-band" id="presence">
    <img class="presence-map" src="/presence-brazil.svg" alt="" aria-hidden="true" />
    <div class="wrap presence">
      <h2>{{ t("presence.title") }}</h2>
      <p class="place">{{ t("presence.place") }}</p>
      <p class="zone">{{ t("presence.zone") }}</p>
      <p>{{ t("presence.text") }}</p>
    </div>
  </section>
</template>
