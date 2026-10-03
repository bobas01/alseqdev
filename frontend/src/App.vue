<template>
  <div class="app">
    <SiteHeader v-if="!isAdmin" />
    <main id="contenu">
      <router-view />
    </main>
    <SiteFooter v-if="!isAdmin" />
    <GuideChat v-if="!isAdmin" />
    <WhatsAppFloat v-if="!isAdmin" />
    <BackToTop v-if="!isAdmin" />
  </div>
</template>

<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";
import BackToTop from "./components/BackToTop.vue";
import GuideChat from "./components/GuideChat.vue";
import SiteFooter from "./components/SiteFooter.vue";
import SiteHeader from "./components/SiteHeader.vue";
import WhatsAppFloat from "./components/WhatsAppFloat.vue";

const route = useRoute();
const isAdmin = computed(() => route.path.startsWith("/admin"));
</script>
