<template>
  <div>
    <section class="band band-paper" id="accueil">
      <div class="wrap hero">
        <h1>{{ t("tagline") }}</h1>
        <span class="hero-rule" aria-hidden="true"></span>
        <p class="lead">{{ t("hero.lead") }}</p>
        <div class="actions">
          <a class="btn btn-ink" href="#contact">{{ t("hero.project") }}</a>
          <a class="btn btn-wa" :href="whatsappUrl()" target="_blank" rel="noopener noreferrer">
            {{ t("hero.whatsapp") }}
          </a>
        </div>
      </div>
    </section>

    <section class="band band-ink" id="services">
      <div class="wrap">
        <h2>{{ t("services.title") }}</h2>
        <p class="intro">{{ t("services.intro") }}</p>
        <ul class="cards">
          <li v-for="item in services" :key="item.title">
            <h3>{{ item.title }}</h3>
            <p>{{ item.text }}</p>
          </li>
        </ul>
      </div>
    </section>

    <section class="band band-white" id="methode">
      <div class="wrap">
        <h2>{{ t("method.title") }}</h2>
        <ol class="steps">
          <li v-for="(item, index) in method" :key="item.title">
            <span class="step-index">{{ index + 1 }}</span>
            <div>
              <h3>{{ item.title }}</h3>
              <p>{{ item.text }}</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="band band-ink" id="presence">
      <div class="wrap presence">
        <h2>{{ t("presence.title") }}</h2>
        <p class="place">{{ t("presence.place") }}</p>
        <p class="zone">{{ t("presence.zone") }}</p>
        <p>{{ t("presence.text") }}</p>
      </div>
    </section>

    <section class="band band-paper" id="contact">
      <div class="wrap contact">
        <h2>{{ t("contact.title") }}</h2>
        <p class="intro">{{ t("contact.intro") }}</p>
        <form @submit.prevent="openChat">
          <label>
            {{ t("contact.name") }}
            <input v-model="form.name" name="name" type="text" required autocomplete="name" />
          </label>
          <label>
            {{ t("contact.email") }}
            <input v-model="form.email" name="email" type="email" required autocomplete="email" />
          </label>
          <label>
            {{ t("contact.message") }}
            <textarea v-model="form.message" name="message" required rows="5"></textarea>
          </label>
          <button class="btn btn-ink" type="submit">{{ t("contact.submit") }}</button>
        </form>
        <a class="btn btn-wa" :href="whatsappUrl()" target="_blank" rel="noopener noreferrer">
          {{ t("contact.direct") }}
        </a>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, reactive } from "vue";
import { useI18n } from "vue-i18n";
import { whatsappUrl } from "../whatsapp";

const { t, tm } = useI18n();
const services = computed(() => tm("services.items"));
const method = computed(() => tm("method.items"));
const form = reactive({
  name: "",
  email: "",
  message: "",
});

function openChat() {
  const text = `${form.name}\n${form.email}\n\n${form.message}`;
  window.open(whatsappUrl(text), "_blank", "noopener,noreferrer");
}
</script>
