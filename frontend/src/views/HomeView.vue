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
        <form @submit.prevent="submitContact">
          <label>
            {{ t("contact.name") }}
            <input v-model="form.name" name="name" type="text" required maxlength="80" autocomplete="name" />
          </label>
          <label>
            {{ t("contact.email") }}
            <input v-model="form.email" name="email" type="email" required maxlength="180" autocomplete="email" />
          </label>
          <label>
            {{ t("contact.message") }}
            <textarea v-model="form.message" name="message" required minlength="5" maxlength="4000" rows="5"></textarea>
          </label>
          <div class="hp" aria-hidden="true">
            <label>
              Fax
              <input v-model="form.faxNumber" name="fax_number" type="text" tabindex="-1" autocomplete="off" />
            </label>
          </div>
          <button class="btn btn-ink" type="submit" :disabled="status === 'sending' || token === ''">
            {{ status === "sending" ? t("contact.sending") : t("contact.submit") }}
          </button>
          <p v-if="status !== 'idle' && status !== 'sending'" class="form-status" role="status">
            {{ t(`contact.${status}`) }}
          </p>
          <router-link class="kept" :to="`/${locale}/confidentialite`">{{ t("contact.kept") }}</router-link>
        </form>
        <a class="btn btn-wa" :href="whatsappUrl()" target="_blank" rel="noopener noreferrer">
          {{ t("contact.direct") }}
        </a>
      </div>
    </section>
  </div>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from "vue";
import { useI18n } from "vue-i18n";
import { whatsappUrl } from "../whatsapp";

const { t, tm, locale } = useI18n();
const services = computed(() => tm("services.items"));
const method = computed(() => tm("method.items"));
const form = reactive({
  name: "",
  email: "",
  message: "",
  faxNumber: "",
});
const status = ref("idle");
const token = ref("");
const openedAt = Date.now();

onMounted(async () => {
  try {
    const response = await fetch("/api/contact/token", { credentials: "same-origin" });
    if (!response.ok) {
      return;
    }
    const data = await response.json();
    token.value = typeof data.token === "string" ? data.token : "";
  } catch {
    token.value = "";
  }
});

async function submitContact() {
  if (status.value === "sending") {
    return;
  }
  status.value = "sending";
  try {
    const response = await fetch("/api/contact", {
      method: "POST",
      credentials: "same-origin",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-Token": token.value,
      },
      body: JSON.stringify({
        name: form.name,
        email: form.email,
        message: form.message,
        locale: locale.value,
        startedAt: openedAt,
        fax_number: form.faxNumber,
      }),
    });
    if (response.status === 201) {
      form.name = "";
      form.email = "";
      form.message = "";
      status.value = "success";
      return;
    }
    const data = await response.json().catch(() => ({}));
    if (response.status === 422 && (data.reason === "soon" || data.reason === "invalid")) {
      status.value = data.reason;
      return;
    }
    if (response.status === 429) {
      status.value = "rate";
      return;
    }
    status.value = "error";
  } catch {
    status.value = "error";
  }
}
</script>
