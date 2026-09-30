<template>
  <div class="app">
    <SiteHeader />
    <main id="contenu">
      <router-view />
    </main>
    <SiteFooter />
  </div>
</template>

<script setup>
import SiteFooter from "./components/SiteFooter.vue";
import SiteHeader from "./components/SiteHeader.vue";
</script>
