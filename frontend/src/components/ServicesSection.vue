<script setup>
import { computed, nextTick, onMounted, onUnmounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";

const { t, tm, locale } = useI18n();
const services = computed(() => tm("services.items"));
const list = ref(null);
let observer;

function watchMotion() {
  observer?.disconnect();
  const cards = list.value;
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (reduce) {
    cards?.classList.add("is-in");
    return;
  }

  observer = new IntersectionObserver(
    (entries) => {
      for (const entry of entries) {
        if (!entry.isIntersecting) {
          continue;
        }
        entry.target.classList.add("is-in");
        observer.unobserve(entry.target);
      }
    },
    { threshold: 0, rootMargin: "0px 0px 80px 0px" },
  );

  if (cards && !cards.classList.contains("is-in")) {
    observer.observe(cards);
  }
}

onMounted(watchMotion);

watch(locale, async () => {
  await nextTick();
  watchMotion();
});

onUnmounted(() => observer?.disconnect());
</script>

<template>
  <section class="band band-ink" id="services">
    <div class="wrap">
      <h2>{{ t("services.title") }}</h2>
      <p class="intro">{{ t("services.intro") }}</p>
      <ul ref="list" class="cards seq">
        <li v-for="item in services" :key="item.title">
          <p class="card-kicker">{{ item.kicker }}</p>
          <h3>{{ item.title }}</h3>
          <ul class="card-points">
            <li v-for="point in item.points" :key="point">{{ point }}</li>
          </ul>
        </li>
      </ul>
    </div>
  </section>
</template>
