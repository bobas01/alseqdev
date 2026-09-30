<template>
  <div class="app">
    <SiteHeader />
    <main id="contenu">
      <router-view />
    </main>
    <SiteFooter />
    <WhatsAppFloat />
  </div>
</template>

<script setup>
import SiteFooter from "./components/SiteFooter.vue";
import SiteHeader from "./components/SiteHeader.vue";
import WhatsAppFloat from "./components/WhatsAppFloat.vue";
</script>
