<template>
  <div>
    <section class="band band-paper hero-band" id="accueil">
      <div class="hero-glow" aria-hidden="true"></div>
      <div class="wrap hero">
        <h1 class="shine">
          <span class="tagline-line">{{ t("taglineLine1") }}</span>
          <span class="tagline-line">{{ t("taglineLine2") }}</span>
        </h1>
        <span class="hero-rule" aria-hidden="true"></span>
        <p class="lead">{{ t("hero.lead") }}</p>
        <p class="hero-more">{{ t("hero.more") }}</p>
        <div class="actions">
          <SiteButton href="#contact">{{ t("hero.project") }}</SiteButton>
          <SiteButton variant="wa" type="button" @click="openGuide">
            {{ t("hero.whatsapp") }}
          </SiteButton>
        </div>
      </div>
    </section>

    <section class="band band-ink" id="services">
      <div class="wrap">
        <h2>{{ t("services.title") }}</h2>
        <p class="intro">{{ t("services.intro") }}</p>
        <ul class="cards seq">
          <li v-for="item in services" :key="item.title">
            <p class="card-kicker">{{ item.kicker }}</p>
            <h3>{{ item.title }}</h3>
            <ul class="card-points">
              <li v-for="point in item.points" :key="point">{{ point }}</li>
            </ul>
          </li>
        </ul>
      </div>
    </section>

    <section class="band band-white" id="methode">
      <div class="wrap">
        <h2>{{ t("method.title") }}</h2>
        <ol class="steps">
          <li v-for="(item, index) in method" :key="index" class="reveal">
            <span class="step-index">{{ index + 1 }}</span>
            <div class="step-body">
              <p class="step-kicker">{{ t("method.step") }} {{ index + 1 }}</p>
              <h3>{{ item.title }}</h3>
              <p>{{ item.text }}</p>
            </div>
          </li>
        </ol>
      </div>
    </section>

    <section class="band band-ink presence-band" id="presence">
      <img class="presence-map" src="/presence-brazil.svg" alt="" aria-hidden="true" />
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
          <SiteButton type="submit" :disabled="status === 'sending' || token === ''">
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
  </div>
</template>

<script setup>
import { computed, nextTick, onMounted, onUnmounted, reactive, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { openGuide } from "../chat";
import SiteButton from "../components/SiteButton.vue";
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

let cardObserver;
let stepObserver;

function watchMotion() {
  cardObserver?.disconnect();
  stepObserver?.disconnect();

  const cards = document.querySelector(".cards.seq");
  const steps = document.querySelectorAll(".reveal");
  const reduce = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  if (reduce) {
    cards?.classList.add("is-in");
    steps.forEach((node) => node.classList.add("is-in"));
    return;
  }

  cardObserver = new IntersectionObserver(
    (entries) => {
      for (const entry of entries) {
        if (!entry.isIntersecting) {
          continue;
        }
        entry.target.classList.add("is-in");
        cardObserver.unobserve(entry.target);
      }
    },
    { threshold: 0, rootMargin: "0px 0px 80px 0px" },
  );
  stepObserver = new IntersectionObserver(
    (entries) => {
      for (const entry of entries) {
        if (!entry.isIntersecting) {
          continue;
        }
        entry.target.classList.add("is-in");
        stepObserver.unobserve(entry.target);
      }
    },
    { threshold: 0.2 },
  );

  if (cards && !cards.classList.contains("is-in")) {
    cardObserver.observe(cards);
  }
  steps.forEach((node) => {
    if (!node.classList.contains("is-in")) {
      stepObserver.observe(node);
    }
  });
}

onMounted(async () => {
  if (!window.location.hash) {
    window.scrollTo(0, 0);
  }

  watchMotion();

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

watch(locale, async () => {
  await nextTick();
  watchMotion();
});

onUnmounted(() => {
  cardObserver?.disconnect();
  stepObserver?.disconnect();
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
