<template>
  <section class="band band-paper">
    <div class="wrap blog">
      <h1>{{ t("blog.title") }}</h1>
      <div class="blog-cats" role="group" :aria-label="t('blog.categoriesLabel')">
        <button type="button" :aria-pressed="category === ''" @click="setCategory('')">{{ t("blog.all") }}</button>
        <button
          v-for="item in categories"
          :key="item"
          type="button"
          :aria-pressed="category === item"
          @click="setCategory(item)"
        >
          {{ t(`blog.categories.${item}`) }}
        </button>
      </div>
      <p v-if="articles.length === 0" class="blog-empty">{{ t("blog.empty") }}</p>
      <ol v-else class="blog-list">
        <li v-for="article in articles" :key="article.slug">
          <router-link :to="`/${locale}/blog/${article.slug}`">
            <img v-if="article.cover" class="blog-cover" :src="article.cover" alt="" />
            <span class="blog-kicker">{{ t(`blog.categories.${article.category}`) }}</span>
            <time v-if="article.date" :datetime="article.date">{{ formatDate(article.date) }}</time>
            <h2>{{ article.title }}</h2>
            <p v-if="article.summary">{{ article.summary }}</p>
          </router-link>
        </li>
      </ol>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute, useRouter } from "vue-router";
import { BLOG_CATEGORIES, blogNav } from "../blog";
import { htmlLanguage } from "../i18n";

const { t } = useI18n();
const route = useRoute();
const router = useRouter();
const categories = BLOG_CATEGORIES;
const locale = computed(() => String(route.params.locale ?? "pt-br"));
const category = computed(() => (typeof route.query.category === "string" ? route.query.category : ""));
const articles = ref([]);

onMounted(() => {
  blogNav.translations = {};
});

watch([locale, category], load, { immediate: true });

function setCategory(value) {
  router.replace({
    name: "blog",
    params: { locale: locale.value },
    query: value ? { category: value } : {},
  });
}

async function load() {
  const params = new URLSearchParams({ locale: locale.value });
  if (categories.includes(category.value)) {
    params.set("category", category.value);
  }
  try {
    const response = await fetch(`/api/blog?${params}`);
    articles.value = response.ok ? await response.json() : [];
  } catch {
    articles.value = [];
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
