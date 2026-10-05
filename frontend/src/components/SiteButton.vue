<script setup>
import { computed } from "vue";

const props = defineProps({
  to: { type: String, default: "" },
  href: { type: String, default: "" },
  type: { type: String, default: "button" },
  variant: { type: String, default: "ink" },
  disabled: { type: Boolean, default: false },
});

const is = computed(() => (props.to ? "router-link" : props.href ? "a" : "button"));

const bindings = computed(() => {
  if (props.to) {
    return { to: props.to };
  }
  if (props.href) {
    return { href: props.href };
  }
  return { type: props.type, disabled: props.disabled };
});
</script>

<template>
  <component :is="is" class="btn" :class="`btn-${variant}`" v-bind="bindings">
    <slot />
  </component>
</template>
