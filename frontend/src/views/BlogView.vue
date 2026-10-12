<template>
  <section class="band band-paper">
    <div class="wrap blog">
      <h1>{{ t("blog.title") }}</h1>
      <label class="blog-search">
        <span class="visually-hidden">{{ t("blog.searchLabel") }}</span>
        <input
          type="search"
          :value="search"
          :placeholder="t('blog.search')"
          @input="setSearch($event.target.value)"
        />
      </label>
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
      <p v-if="state === 'loading'" class="blog-empty">{{ t("blog.loading") }}</p>
      <p v-else-if="state === 'failed'" class="blog-empty">{{ t("blog.unavailable") }}</p>
      <p v-else-if="visible.length === 0" class="blog-empty">{{ search.trim() ? t("blog.noResults") : t("blog.empty") }}</p>
      <ol v-else class="blog-list">
        <li v-for="article in visible" :key="article.slug">
          <router-link :to="`/${locale}/blog/${article.slug}`">
            <ArticleCover :src="article.cover" kind="blog" />
            <span class="blog-kicker">{{ t(`blog.categories.${article.category}`) }}</span>
            <time v-if="article.date" :datetime="article.date">{{ formatDate(article.date, locale) }}</time>
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
import ArticleCover from "../components/ArticleCover.vue";
import { formatDate } from "../formatDate";

const { t } = useI18n();
const route = useRoute();
const router = useRouter();
const categories = BLOG_CATEGORIES;
const locale = computed(() => String(route.params.locale ?? "pt-br"));
const category = computed(() => (typeof route.query.category === "string" ? route.query.category : ""));
const search = ref("");
const articles = ref([]);
const state = ref("loading");
const visible = computed(() => {
  const needle = fold(search.value.trim());
  if (needle === "") {
    return articles.value;
  }
  return articles.value.filter((article) => {
    const haystack = fold(`${article.title ?? ""} ${article.summary ?? ""}`);
    return haystack.includes(needle);
  });
});

onMounted(() => {
  blogNav.translations = {};
});

watch([locale, category], load, { immediate: true });

function fold(value) {
  return value.normalize("NFD").replace(/\p{M}/gu, "").toLowerCase();
}

function setCategory(value) {
  router.replace({
    name: "blog",
    params: { locale: locale.value },
    query: value ? { category: value } : {},
  });
}

function setSearch(value) {
  search.value = value;
}

async function load() {
  const params = new URLSearchParams({ locale: locale.value });
  if (categories.includes(category.value)) {
    params.set("category", category.value);
  }
  state.value = "loading";
  try {
    const response = await fetch(`/api/blog?${params}`);
    if (!response.ok) {
      articles.value = [];
      state.value = "failed";
      return;
    }
    const data = await response.json();
    articles.value = Array.isArray(data) ? data : [];
    state.value = "ready";
  } catch {
    articles.value = [];
    state.value = "failed";
  }
}
</script>
