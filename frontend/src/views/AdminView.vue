<template>
  <section class="band band-paper">
    <div class="wrap admin">
      <h1>Messages</h1>
      <form v-if="!authenticated" @submit.prevent="login">
        <label>
          E-mail
          <input v-model="email" type="email" autocomplete="username" required />
        </label>
        <label>
          Mot de passe
          <input v-model="password" type="password" autocomplete="current-password" required />
        </label>
        <button class="btn btn-ink" type="submit" :disabled="busy">Entrer</button>
        <p v-if="error" class="form-status" role="status">{{ error }}</p>
      </form>
      <template v-else>
        <div class="admin-bar">
          <button class="btn btn-ink" type="button" @click="logout">Sortir</button>
        </div>
        <p v-if="messages.length === 0">Aucun message.</p>
        <ul v-else class="admin-list">
          <li v-for="item in messages" :key="item.id">
            <button type="button" @click="openMessage(item.id)">
              <strong>{{ item.name }}</strong>
              <span>{{ item.email }}</span>
              <span>{{ formatDate(item.createdAt) }}</span>
              <span>{{ item.excerpt }}</span>
            </button>
          </li>
        </ul>
        <article v-if="current" class="admin-message">
          <h2>{{ current.name }}</h2>
          <p>{{ current.email }}</p>
          <p>{{ formatDate(current.createdAt) }} · {{ current.locale }}</p>
          <p class="admin-body">{{ current.message }}</p>
          <button class="btn btn-ink" type="button" @click="removeMessage(current.id)">Supprimer</button>
        </article>
      </template>
    </div>
  </section>
</template>

<script setup>
import { onMounted, ref } from "vue";

const email = ref("alseqdev@gmail.com");
const password = ref("");
const authenticated = ref(false);
const busy = ref(false);
const error = ref("");
const messages = ref([]);
const current = ref(null);

onMounted(async () => {
  const response = await fetch("/api/admin/session", { credentials: "same-origin" });
  if (!response.ok) {
    return;
  }
  const data = await response.json();
  authenticated.value = data.authenticated === true;
  if (authenticated.value) {
    await loadMessages();
  }
});

async function login() {
  busy.value = true;
  error.value = "";
  try {
    const response = await fetch("/api/admin/login", {
      method: "POST",
      credentials: "same-origin",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email: email.value, password: password.value }),
    });
    if (!response.ok) {
      error.value = response.status === 429
        ? "Trop de tentatives. Réessayez plus tard."
        : "Adresse ou mot de passe incorrect.";
      return;
    }
    password.value = "";
    authenticated.value = true;
    await loadMessages();
  } catch {
    error.value = "La connexion n’a pas abouti.";
  } finally {
    busy.value = false;
  }
}

async function loadMessages() {
  const response = await fetch("/api/admin/messages", { credentials: "same-origin" });
  if (response.status === 401) {
    authenticated.value = false;
    return;
  }
  messages.value = response.ok ? await response.json() : [];
}

async function openMessage(id) {
  const response = await fetch(`/api/admin/messages/${id}`, { credentials: "same-origin" });
  if (response.ok) {
    current.value = await response.json();
  }
}

async function removeMessage(id) {
  if (!window.confirm("Supprimer ce message ?")) {
    return;
  }
  const response = await fetch(`/api/admin/messages/${id}`, {
    method: "DELETE",
    credentials: "same-origin",
  });
  if (!response.ok) {
    return;
  }
  current.value = null;
  await loadMessages();
}

async function logout() {
  await fetch("/api/admin/logout", { method: "POST", credentials: "same-origin" });
  authenticated.value = false;
  messages.value = [];
  current.value = null;
}

function formatDate(value) {
  return new Intl.DateTimeFormat("fr-FR", {
    dateStyle: "medium",
    timeStyle: "short",
  }).format(new Date(value));
}
</script>
