<script setup>
import { useI18n } from "vue-i18n";
import { openGuide } from "../chat";
import SiteButton from "./SiteButton.vue";

const { t } = useI18n();
</script>

<template>
  <section class="band band-paper hero-band" id="accueil">
    <div class="hero-glow" aria-hidden="true"></div>
    <div class="wrap hero">
      <h1 class="shine">
        <span class="tagline-line">{{ t("taglineLine1") }}</span>
        <span class="tagline-line">{{ t("taglineLine2") }}</span>
      </h1>
      <span class="hero-rule" aria-hidden="true"></span>
      <p class="lead">{{ t("hero.lead") }}</p>
      <p class="hero-more">{{ t("hero.more") }}</p>
      <div class="actions">
        <SiteButton href="#contact">{{ t("hero.project") }}</SiteButton>
        <SiteButton variant="wa" type="button" @click="openGuide">
          {{ t("hero.whatsapp") }}
        </SiteButton>
      </div>
    </div>
  </section>
</template>
