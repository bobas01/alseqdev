<template>
  <section class="band band-paper">
    <div class="wrap legal">
      <h1>{{ t(`${page}.title`) }}</h1>
      <p v-for="(paragraph, index) in paragraphs" :key="index">{{ paragraph }}</p>
    </div>
  </section>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";
import { useI18n } from "vue-i18n";

const route = useRoute();
const { t, tm } = useI18n();
const page = computed(() => route.meta.page);
const paragraphs = computed(() => tm(`${page.value}.paragraphs`));
</script>
