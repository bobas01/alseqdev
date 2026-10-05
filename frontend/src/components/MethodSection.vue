<script setup>
import { computed, nextTick, onMounted, onUnmounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";

const { t, tm, locale } = useI18n();
const method = computed(() => tm("method.items"));
const list = ref(null);
let observer;

function watchMotion() {
  observer?.disconnect();
  const steps = list.value?.querySelectorAll(".reveal") ?? [];
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (reduce) {
    steps.forEach((node) => node.classList.add("is-in"));
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
    { threshold: 0.2 },
  );

  steps.forEach((node) => {
    if (!node.classList.contains("is-in")) {
      observer.observe(node);
    }
  });
}

onMounted(watchMotion);

watch(locale, async () => {
  await nextTick();
  watchMotion();
});

onUnmounted(() => observer?.disconnect());
</script>

<template>
  <section class="band band-white" id="methode">
    <div class="wrap">
      <h2>{{ t("method.title") }}</h2>
      <ol ref="list" class="steps">
        <li v-for="(item, index) in method" :key="index" class="reveal">
          <span class="step-index">{{ index + 1 }}</span>
          <div class="step-body">
            <p class="step-kicker">{{ t("method.step") }} {{ index + 1 }}</p>
            <h3>{{ item.title }}</h3>
            <p>{{ item.text }}</p>
          </div>
        </li>
      </ol>
    </div>
  </section>
</template>
