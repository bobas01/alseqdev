<script setup>
import { onMounted, reactive, ref } from "vue";
import { useI18n } from "vue-i18n";
import { openGuide } from "../chat";
import { whatsappUrl } from "../whatsapp";
import SiteButton from "./SiteButton.vue";

const { t, locale } = useI18n();
const form = reactive({
  name: "",
  email: "",
  message: "",
  faxNumber: "",
});
const status = ref("idle");
const token = ref("");
const issued = ref(0);
const proof = ref("");

onMounted(async () => {
  try {
    const response = await fetch("/api/contact/token", { credentials: "same-origin" });
    if (!response.ok) {
      return;
    }
    const data = await response.json();
    token.value = typeof data.token === "string" ? data.token : "";
    issued.value = Number.isInteger(data.issued) ? data.issued : 0;
    proof.value = typeof data.proof === "string" ? data.proof : "";
  } catch {
    token.value = "";
  }
});

async function submitContact() {
  if (status.value === "sending" || token.value === "" || proof.value === "") {
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
        issued: issued.value,
        proof: proof.value,
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

<template>
  <section class="band band-paper" id="contact">
    <div class="wrap contact">
      <h2>{{ t("contact.title") }}</h2>
      <p class="intro">{{ t("contact.intro") }}</p>
      <div class="contact-grid">
        <div class="who">
          <p class="who-name">ALSEQ DEV</p>
          <ul class="who-list">
            <li>
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path
                  fill="currentColor"
                  d="M12 2.5c-3.6 0-6.5 2.8-6.5 6.3 0 4.7 6.5 12.7 6.5 12.7s6.5-8 6.5-12.7c0-3.5-2.9-6.3-6.5-6.3zm0 8.6a2.3 2.3 0 1 1 0-4.6 2.3 2.3 0 0 1 0 4.6z"
                />
              </svg>
              <span>{{ t("location") }}</span>
            </li>
            <li>
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path
                  fill="currentColor"
                  d="M3 5.5h18a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-11a1 1 0 0 1 1-1zm9 7.2 8.2-5.7H3.8L12 12.7z"
                />
              </svg>
              <a href="mailto:alseqdev@gmail.com">alseqdev@gmail.com</a>
            </li>
            <li>
              <svg viewBox="0 0 24 24" aria-hidden="true">
                <path
                  fill="currentColor"
                  d="M8.2 3.5h2.1c.4 0 .8.3.9.7l.8 2.4a1 1 0 0 1-.3 1L10.2 9a12 12 0 0 0 4.8 4.8l1.4-1.5a1 1 0 0 1 1-.3l2.4.8c.4.1.7.5.7.9v2.1c0 .6-.4 1-1 1C11.2 16.8 7.2 12.8 7.2 4.5c0-.6.4-1 1-1z"
                />
              </svg>
              <a :href="whatsappUrl()" target="_blank" rel="noopener noreferrer">+55 62 99152-5466</a>
            </li>
          </ul>
          <SiteButton variant="wa" type="button" @click="openGuide">
            {{ t("contact.direct") }}
          </SiteButton>
        </div>
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
          <SiteButton type="submit" :disabled="status === 'sending' || token === '' || proof === ''">
            {{ status === "sending" ? t("contact.sending") : t("contact.submit") }}
          </SiteButton>
          <p v-if="status !== 'idle' && status !== 'sending'" class="form-status" role="status">
            {{ t(`contact.${status}`) }}
          </p>
          <router-link class="kept" :to="`/${locale}/confidentialite`">{{ t("contact.kept") }}</router-link>
        </form>
      </div>
    </div>
  </section>
</template>
