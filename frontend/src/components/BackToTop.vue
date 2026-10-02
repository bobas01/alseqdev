<template>
  <button v-show="visible" class="to-top" type="button" :aria-label="t('toTop')" @click="goTop">
    <svg viewBox="0 0 24 24" aria-hidden="true">
      <path fill="currentColor" d="M12 5.2 4.8 12.4l1.4 1.4L11 9v10h2V9l4.8 4.8 1.4-1.4z" />
    </svg>
  </button>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from "vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const visible = ref(false);

function onScroll() {
  visible.value = window.scrollY > 500;
}

function goTop() {
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  window.scrollTo({ top: 0, behavior: reduce ? "auto" : "smooth" });
}

onMounted(() => {
  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });
});

onUnmounted(() => {
  window.removeEventListener("scroll", onScroll);
});
</script>
