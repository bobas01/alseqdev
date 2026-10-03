<template>
  <section
    v-if="guide.open"
    ref="panel"
    class="guide"
    role="dialog"
    aria-modal="true"
    :aria-label="t('guide.title')"
    tabindex="-1"
    @keydown.esc="guide.open = false"
  >
    <header class="guide-head">
      <p>{{ t("guide.title") }}</p>
      <button type="button" :aria-label="t('guide.close')" @click="guide.open = false">×</button>
    </header>
    <div ref="log" class="guide-log">
      <p v-for="(message, index) in messages" :key="index" class="guide-bubble" :class="message.from">
        {{ message.text }}
      </p>
    </div>
    <template v-if="choices.length">
      <div class="guide-choices">
        <button
          v-for="choice in choices"
          :key="choice.key"
          type="button"
          :class="{ 'is-on': isMulti && picked.includes(choice.key) }"
          :aria-pressed="isMulti ? picked.includes(choice.key) : undefined"
          @click="choose(choice.key)"
        >
          {{ choice.label }}
        </button>
      </div>
      <button
        v-if="isMulti"
        class="btn btn-ink guide-confirm"
        type="button"
        :disabled="picked.length === 0"
        @click="confirmPicks"
      >
        {{ t("guide.donePicks") }}
      </button>
    </template>
    <form v-else-if="step === 'line'" class="guide-form" @submit.prevent="submitLine">
      <input v-model="line" type="text" maxlength="240" :placeholder="t('guide.placeholder')" required />
      <button class="btn btn-ink" type="submit">{{ t("guide.continue") }}</button>
    </form>
    <div v-else class="guide-done">
      <p class="guide-aside">{{ t("guide.aside") }}</p>
      <button class="btn btn-wa" type="button" @click="send">{{ t("guide.send") }}</button>
      <button class="guide-restart" type="button" @click="boot">{{ t("guide.restart") }}</button>
    </div>
  </section>
</template>

<script setup>
import { computed, nextTick, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { guide } from "../chat";
import { whatsappWebUrl } from "../whatsapp";

const { t } = useI18n();
const panel = ref(null);
const log = ref(null);
const messages = ref([]);
const step = ref("kind");
const line = ref("");
const lineNext = ref("draft");
const picked = ref([]);
const answers = ref({ kind: "", detail: "", line: "", picks: [], pickGroup: "", order: "", receive: "", how: "", who: "", rhythm: "" });

const choiceSets = {
  kind: ["site", "shop", "existing", "clients", "booking", "daily", "payment", "tool", "other"],
  siteMode: ["new", "redesign"],
  existingWork: ["redo", "add", "fix"],
  siteParts: ["who", "offer", "hours", "photos", "write", "prices"],
  shopOrder: ["pay", "later", "write"],
  shopReceive: ["delivery", "pickup", "both"],
  siteFocus: ["clear", "phone", "pages", "broken"],
  toolFocus: ["clear", "missing", "broken", "follow"],
  clientParts: ["docs", "status", "write", "book", "pay"],
  bookHow: ["alone", "confirm"],
  dailyWho: ["me", "team", "clients"],
  payRhythm: ["once", "month", "both"],
};

const multiSteps = ["siteParts", "siteFocus", "toolFocus", "clientParts"];
const isMulti = computed(() => multiSteps.includes(step.value));

const askFor = {
  siteParts: "guide.askSiteParts",
  siteFocus: "guide.askFocus",
  toolFocus: "guide.askFocus",
  clientParts: "guide.askClientParts",
  shopOrder: "guide.askShopOrder",
  shopReceive: "guide.askShopReceive",
  bookHow: "guide.askBookHow",
  dailyWho: "guide.askDailyWho",
  payRhythm: "guide.askPayRhythm",
};

const choices = computed(() => {
  const keys = choiceSets[step.value];
  if (!keys) {
    return [];
  }
  return keys.map((key) => ({
    key,
    label: t(`guide.${step.value}.${key}`),
  }));
});

function pushBot(text) {
  messages.value.push({ from: "bot", text });
}

function pushUser(text) {
  messages.value.push({ from: "user", text });
}

function boot() {
  messages.value = [];
  line.value = "";
  picked.value = [];
  lineNext.value = "draft";
  answers.value = { kind: "", detail: "", line: "", picks: [], pickGroup: "", order: "", receive: "", how: "", who: "", rhythm: "" };
  step.value = "kind";
  pushBot(t("guide.hello"));
  pushBot(t("guide.askKind"));
}

function askLine(question, next) {
  lineNext.value = next;
  step.value = "line";
  pushBot(t(question));
}

function openStep(next) {
  picked.value = [];
  step.value = next;
  pushBot(t(askFor[next]));
}

function finish() {
  step.value = "draft";
  pushBot(t("guide.draftLead"));
  pushBot(draftText());
}

function openOffer(key) {
  answers.value.kind = key;
  if (key === "site") {
    step.value = "siteMode";
    pushBot(t("guide.askSite"));
  } else if (key === "existing" || key === "tool") {
    step.value = "existingWork";
    pushBot(t("guide.askExisting"));
  } else if (key === "clients") {
    openStep("clientParts");
  } else if (key === "shop") {
    askLine("guide.askShop", "shopOrder");
  } else if (key === "booking") {
    askLine("guide.askBooking", "bookHow");
  } else if (key === "daily") {
    askLine("guide.askDaily", "dailyWho");
  } else if (key === "payment") {
    askLine("guide.askPayment", "payRhythm");
  } else {
    askLine("guide.askNeed", "draft");
  }
}

function choose(key) {
  if (isMulti.value) {
    const index = picked.value.indexOf(key);
    if (index === -1) {
      picked.value.push(key);
    } else {
      picked.value.splice(index, 1);
    }
    return;
  }

  if (step.value === "kind") {
    pushUser(t(`guide.kind.${key}`));
    openOffer(key);
    return;
  }

  const current = step.value;
  pushUser(t(`guide.${current}.${key}`));
  if (current === "siteMode") {
    answers.value.detail = key;
    askLine("guide.askActivity", "siteParts");
    return;
  }
  if (current === "existingWork") {
    answers.value.detail = key;
    askLine("guide.askAbout", answers.value.kind === "tool" ? "toolFocus" : "siteFocus");
    return;
  }
  if (current === "shopOrder") {
    answers.value.order = key;
    openStep("shopReceive");
    return;
  }
  if (current === "shopReceive") {
    answers.value.receive = key;
    finish();
    return;
  }
  if (current === "bookHow") {
    answers.value.how = key;
    finish();
    return;
  }
  if (current === "dailyWho") {
    answers.value.who = key;
    finish();
    return;
  }
  if (current === "payRhythm") {
    answers.value.rhythm = key;
    finish();
  }
}

function confirmPicks() {
  if (picked.value.length === 0) {
    return;
  }
  const group = step.value;
  const labels = picked.value.map((key) => t(`guide.${group}.${key}`));
  answers.value.picks = [...picked.value];
  answers.value.pickGroup = group;
  pushUser(labels.join(", "));
  picked.value = [];
  if (group === "clientParts") {
    askLine("guide.askClientActivity", "draft");
    return;
  }
  finish();
}

function submitLine() {
  const text = line.value.trim();
  if (!text) {
    return;
  }
  answers.value.line = text;
  pushUser(text);
  line.value = "";
  const next = lineNext.value;
  if (next === "draft") {
    finish();
    return;
  }
  openStep(next);
}

function draftText() {
  const saved = answers.value;
  const parts = saved.picks.map((key) => t(`guide.${saved.pickGroup}.${key}`)).join(", ");
  const values = {
    line: saved.line.replace(/[.!?…]+$/u, ""),
    parts,
    order: saved.order ? t(`guide.shopOrder.${saved.order}`) : "",
    receive: saved.receive ? t(`guide.shopReceive.${saved.receive}`) : "",
    how: saved.how ? t(`guide.bookHow.${saved.how}`) : "",
    who: saved.who ? t(`guide.dailyWho.${saved.who}`) : "",
    rhythm: saved.rhythm ? t(`guide.payRhythm.${saved.rhythm}`) : "",
  };
  const nested = ["site", "existing", "tool"];
  if (nested.includes(saved.kind)) {
    return t(`guide.draft.${saved.kind}.${saved.detail}`, values);
  }
  return t(`guide.draft.${saved.kind}`, values);
}

function send() {
  const url = whatsappWebUrl(draftText());
  const popup = window.open(url, "alseqWhatsapp", "width=420,height=740");
  if (popup) {
    popup.opener = null;
    return;
  }
  const link = document.createElement("a");
  link.href = url;
  link.target = "_blank";
  link.rel = "noopener noreferrer";
  link.click();
}

function scrollLog() {
  if (log.value) {
    log.value.scrollTop = log.value.scrollHeight;
  }
}

watch(
  () => guide.open,
  async (open) => {
    if (!open) {
      return;
    }
    if (messages.value.length === 0) {
      boot();
    }
    await nextTick();
    panel.value?.focus();
    scrollLog();
  },
);

watch(messages, () => nextTick(scrollLog), { deep: true });
</script>
