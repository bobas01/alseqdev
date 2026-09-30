<template>
  <p class="mark" :class="theme">
    <span class="name">
      <svg class="chevron" viewBox="4 4 112 92" preserveAspectRatio="none" aria-hidden="true">
        <path fill="#C6A15A" d="M60 4 L116 96 L88 96 L60 46 L32 96 L4 96 Z" />
      </svg>
      <span>LSEQ</span>
    </span>
    <span class="rule" aria-hidden="true"></span>
    <span class="dev">DEV</span>
  </p>
</template>

<script setup>
defineProps({
  theme: {
    type: String,
    default: "light",
  },
});
</script>
