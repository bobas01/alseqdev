<script setup>
defineProps({
  src: { type: String, default: "" },
  kind: { type: String, default: "article" },
});
</script>

<template>
  <img v-if="src" :class="`${kind}-cover`" :src="`${src}?v=4`" alt="" />
</template>
