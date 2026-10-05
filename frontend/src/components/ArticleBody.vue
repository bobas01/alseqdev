<script setup>
defineProps({
  blocks: { type: Array, required: true },
  heading: { type: String, default: "h2" },
});
</script>

<template>
  <template v-for="(block, index) in blocks" :key="index">
    <component :is="heading" v-if="block.type === 'heading'">{{ block.text }}</component>
    <ul v-else-if="block.type === 'list'">
      <li v-for="item in block.items" :key="item">{{ item }}</li>
    </ul>
    <p v-else>{{ block.text }}</p>
  </template>
</template>
