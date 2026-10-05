<template>
  <section class="band band-paper">
    <div class="wrap article">
      <router-link class="article-back" :to="`/${locale}/blog`">{{ t("blog.back") }}</router-link>
      <p v-if="missing" class="blog-empty">{{ t("blog.missing") }}</p>
      <template v-else-if="article">
        <p class="blog-kicker">{{ t(`blog.categories.${article.category}`) }}</p>
        <time v-if="article.date" :datetime="article.date">{{ formatDate(article.date) }}</time>
        <h1>{{ article.title }}</h1>
        <img v-if="article.cover" class="article-cover" :src="`${article.cover}?v=2`" alt="" />
        <p v-if="article.summary" class="article-summary">{{ article.summary }}</p>
        <template v-for="(block, index) in blocks" :key="index">
          <h2 v-if="block.type === 'heading'">{{ block.text }}</h2>
          <ul v-else-if="block.type === 'list'">
            <li v-for="item in block.items" :key="item">{{ item }}</li>
          </ul>
          <p v-else>{{ block.text }}</p>
        </template>
        <section v-if="article.sources.length > 0" class="article-sources">
          <h2>{{ t("blog.sources") }}</h2>
          <ul>
            <li v-for="source in article.sources" :key="source.url">
              <a :href="source.url" target="_blank" rel="noopener noreferrer">{{ source.title }}</a>
            </li>
          </ul>
        </section>
      </template>
    </div>
  </section>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import { blogNav, parseBlocks } from "../blog";
import { htmlLanguage } from "../i18n";

const { t } = useI18n();
const route = useRoute();
const locale = computed(() => String(route.params.locale ?? "pt-br"));
const slug = computed(() => String(route.params.slug ?? ""));
const article = ref(null);
const missing = ref(false);

const blocks = computed(() => parseBlocks(article.value?.body ?? ""));

watch([locale, slug], load, { immediate: true });

async function load() {
  missing.value = false;
  article.value = null;
  blogNav.translations = {};
  try {
    const response = await fetch(`/api/blog/${locale.value}/${encodeURIComponent(slug.value)}`);
    if (!response.ok) {
      missing.value = true;
      document.title = `${t("blog.missing")} — ALSEQ DEV`;
      return;
    }
    article.value = await response.json();
    blogNav.translations = article.value.translations ?? {};
    document.title = `${article.value.title} — ALSEQ DEV`;
  } catch {
    missing.value = true;
  }
}

function formatDate(value) {
  const date = new Date(`${value}T12:00:00`);
  if (Number.isNaN(date.getTime())) {
    return value;
  }
  return new Intl.DateTimeFormat(htmlLanguage(locale.value), {
    day: "numeric",
    month: "long",
    year: "numeric",
  }).format(date);
}
</script>
