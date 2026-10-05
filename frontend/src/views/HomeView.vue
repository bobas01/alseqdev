<script setup>
import { onMounted } from "vue";
import ContactSection from "../components/ContactSection.vue";
import HeroSection from "../components/HeroSection.vue";
import MethodSection from "../components/MethodSection.vue";
import PresenceSection from "../components/PresenceSection.vue";
import ServicesSection from "../components/ServicesSection.vue";

onMounted(() => {
  if (!window.location.hash) {
    window.scrollTo(0, 0);
  }
});
</script>

<template>
  <div>
    <HeroSection />
    <ServicesSection />
    <MethodSection />
    <PresenceSection />
    <ContactSection />
  </div>
</template>
