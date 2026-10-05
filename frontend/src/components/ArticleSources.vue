<script setup>
defineProps({
  sources: { type: Array, default: () => [] },
  title: { type: String, required: true },
  heading: { type: String, default: "h2" },
});
</script>

<template>
  <section v-if="sources.length > 0" class="article-sources">
    <component :is="heading">{{ title }}</component>
    <ul>
      <li v-for="source in sources" :key="source.url">
        <a :href="source.url" target="_blank" rel="noopener noreferrer">{{ source.title }}</a>
      </li>
    </ul>
  </section>
</template>
