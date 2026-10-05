<template>
  <section class="band band-paper">
    <div class="wrap article">
      <router-link class="article-back" :to="`/${locale}/blog`">{{ t("blog.back") }}</router-link>
      <p v-if="missing" class="blog-empty">{{ t("blog.missing") }}</p>
      <template v-else-if="article">
        <p class="blog-kicker">{{ t(`blog.categories.${article.category}`) }}</p>
        <time v-if="article.date" :datetime="article.date">{{ formatDate(article.date, locale) }}</time>
        <h1>{{ article.title }}</h1>
        <ArticleCover :src="article.cover" />
        <p v-if="article.summary" class="article-summary">{{ article.summary }}</p>
        <ArticleBody :blocks="blocks" />
        <ArticleSources :sources="article.sources" :title="t('blog.sources')" />
      </template>
    </div>
  </section>
</template>

<script setup>
import { computed, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import { blogNav, parseBlocks } from "../blog";
import ArticleBody from "../components/ArticleBody.vue";
import ArticleCover from "../components/ArticleCover.vue";
import ArticleSources from "../components/ArticleSources.vue";
import { formatDate } from "../formatDate";

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

</script>
