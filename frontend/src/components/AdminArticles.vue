<template>
  <div class="admin-articles">
    <div class="admin-bar">
      <SiteButton type="button" @click="startNew">Nouvel article</SiteButton>
    </div>
    <p v-if="articles.length === 0 && !editing && !reading">Aucun article.</p>

    <template v-if="reading">
      <article class="admin-read">
        <button type="button" class="article-back" @click="reading = null">Retour à la liste</button>
        <p class="blog-kicker">{{ labels[reading.category] }} · {{ reading.locale }} · {{ reading.status === "published" ? "Publié" : "Brouillon" }}</p>
        <h2>{{ reading.title }}</h2>
        <img v-if="reading.cover" class="admin-cover" :src="`${reading.cover}?v=4`" alt="" />
        <p v-if="reading.summary">{{ reading.summary }}</p>
        <template v-for="(block, index) in blocks" :key="index">
          <h3 v-if="block.type === 'heading'">{{ block.text }}</h3>
          <ul v-else-if="block.type === 'list'">
            <li v-for="item in block.items" :key="item">{{ item }}</li>
          </ul>
          <p v-else>{{ block.text }}</p>
        </template>
        <section v-if="reading.sources.length > 0">
          <h3>Sources</h3>
          <ul>
            <li v-for="source in reading.sources" :key="source.url">
              <a :href="source.url" target="_blank" rel="noopener noreferrer">{{ source.title }}</a>
            </li>
          </ul>
        </section>
        <div class="admin-actions">
          <SiteButton type="button" @click="edit(reading.id)">Modifier</SiteButton>
          <SiteButton type="button" @click="setPublished(reading.status !== 'published')">
            {{ reading.status === "published" ? "Remettre en brouillon" : "Publier" }}
          </SiteButton>
          <SiteButton type="button" @click="remove(reading.id)">Supprimer</SiteButton>
        </div>
      </article>
    </template>

    <template v-else-if="!editing">
      <section v-for="group in groups" :key="group.status">
        <p class="admin-group">{{ group.title }}</p>
        <p v-if="group.items.length === 0">{{ group.empty }}</p>
        <ul v-else class="admin-list">
          <li v-for="item in group.items" :key="item.id">
            <button type="button" @click="openArticle(item.id)">
              <strong>{{ item.title }}</strong>
              <span>{{ item.locale }} · {{ labels[item.category] || item.category }}</span>
            </button>
          </li>
        </ul>
      </section>
    </template>

    <form v-if="editing" class="admin-article" @submit.prevent="save">
      <h2>{{ form.id ? "Modifier l’article" : "Nouvel article" }}</h2>
      <label>
        Langue
        <select v-model="form.locale" required>
          <option value="pt-br">Portugais</option>
          <option value="fr">Français</option>
          <option value="en">Anglais</option>
          <option value="es">Espagnol</option>
        </select>
      </label>
      <label>
        Catégorie
        <select v-model="form.category" required>
          <option v-for="item in categories" :key="item" :value="item">{{ labels[item] }}</option>
        </select>
      </label>
      <label>
        Titre
        <input v-model="form.title" required maxlength="160" />
      </label>
      <label>
        Résumé
        <input v-model="form.summary" maxlength="320" />
      </label>
      <label>
        Visuel
        <input v-model="form.cover" placeholder="/blog/nom.svg" />
      </label>
      <img v-if="form.cover" class="admin-cover" :src="`${form.cover}?v=4`" alt="" />
      <label>
        Texte
        <textarea v-model="form.body" required rows="16" />
      </label>
      <fieldset>
        <legend>Sources</legend>
        <p>Pour publier, au moins deux sites différents. Le nom du site doit se voir dans le titre de la source.</p>
        <div v-for="(source, index) in form.sources" :key="index" class="source-row">
          <input v-model="source.title" placeholder="Nom du site" maxlength="160" />
          <input v-model="source.url" type="url" placeholder="https://" />
          <button type="button" @click="form.sources.splice(index, 1)">Retirer</button>
        </div>
        <button type="button" @click="form.sources.push({ title: '', url: '' })">Ajouter une source</button>
      </fieldset>
      <label>
        Même sujet dans une autre langue
        <input v-model="form.translationKey" maxlength="80" placeholder="Identifiant commun, facultatif" />
      </label>
      <label class="check">
        <input v-model="form.published" type="checkbox" />
        Publier
      </label>
      <p v-if="error" class="form-status" role="status">{{ error }}</p>
      <div class="admin-actions">
        <SiteButton type="submit" :disabled="busy">Enregistrer</SiteButton>
        <SiteButton type="button" @click="closeForm">Annuler</SiteButton>
        <SiteButton v-if="form.id" type="button" @click="remove(form.id)">Supprimer</SiteButton>
      </div>
    </form>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import { BLOG_CATEGORIES, parseBlocks } from "../blog";
import SiteButton from "./SiteButton.vue";

const categories = BLOG_CATEGORIES;
const labels = {
  developpement: "Développement",
  devops: "DevOps",
  cybersecurite: "Cybersécurité",
  ia: "IA",
};

const articles = ref([]);
const editing = ref(false);
const reading = ref(null);
const busy = ref(false);
const error = ref("");
const form = ref(blank());

const blocks = computed(() => parseBlocks(reading.value?.body ?? ""));
const groups = computed(() => [
  {
    status: "draft",
    title: "Brouillons",
    empty: "Aucun brouillon.",
    items: articles.value.filter((item) => item.status !== "published"),
  },
  {
    status: "published",
    title: "Publiés",
    empty: "Aucun article publié.",
    items: articles.value.filter((item) => item.status === "published"),
  },
]);

onMounted(load);

function blank() {
  return {
    id: null,
    locale: "fr",
    category: "developpement",
    title: "",
    summary: "",
    cover: "",
    body: "",
    sources: [
      { title: "", url: "" },
      { title: "", url: "" },
    ],
    translationKey: "",
    published: false,
  };
}

function startNew() {
  form.value = blank();
  error.value = "";
  reading.value = null;
  editing.value = true;
}

function closeForm() {
  editing.value = false;
  error.value = "";
}

async function load() {
  const response = await fetch("/api/admin/articles", { credentials: "same-origin" });
  articles.value = response.ok ? await response.json() : [];
}

async function openArticle(id) {
  const response = await fetch(`/api/admin/articles/${id}`, { credentials: "same-origin" });
  if (!response.ok) {
    return;
  }
  reading.value = await response.json();
  editing.value = false;
}

async function edit(id) {
  const response = await fetch(`/api/admin/articles/${id}`, { credentials: "same-origin" });
  if (!response.ok) {
    return;
  }
  const data = await response.json();
  form.value = {
    id: data.id,
    locale: data.locale,
    category: data.category,
    title: data.title,
    summary: data.summary,
    cover: data.cover ?? "",
    body: data.body,
    sources: data.sources.length > 0 ? data.sources : [{ title: "", url: "" }],
    translationKey: data.translationKey,
    published: data.status === "published",
  };
  error.value = "";
  reading.value = null;
  editing.value = true;
}

async function save() {
  busy.value = true;
  error.value = "";
  const payload = {
    locale: form.value.locale,
    category: form.value.category,
    title: form.value.title,
    summary: form.value.summary,
    cover: form.value.cover,
    body: form.value.body,
    sources: form.value.sources,
    translationKey: form.value.translationKey,
    status: form.value.published ? "published" : "draft",
  };
  const response = await fetch(form.value.id ? `/api/admin/articles/${form.value.id}` : "/api/admin/articles", {
    method: form.value.id ? "PUT" : "POST",
    credentials: "same-origin",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload),
  });
  busy.value = false;
  if (!response.ok) {
    error.value = form.value.published
      ? "Pour publier, il faut un texte assez long et au moins deux sites différents."
      : "Le titre et le texte sont trop courts, ou une adresse n’est pas valable.";
    return;
  }
  editing.value = false;
  await load();
}

async function setPublished(published) {
  if (!reading.value) {
    return;
  }
  const current = reading.value;
  const response = await fetch(`/api/admin/articles/${current.id}`, {
    method: "PUT",
    credentials: "same-origin",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      locale: current.locale,
      category: current.category,
      title: current.title,
      summary: current.summary,
      cover: current.cover,
      body: current.body,
      sources: current.sources,
      translationKey: current.translationKey,
      status: published ? "published" : "draft",
    }),
  });
  if (!response.ok) {
    window.alert("La publication demande au moins deux sites différents.");
    return;
  }
  reading.value = await response.json();
  await load();
}

async function remove(id) {
  if (!id || !window.confirm("Supprimer cet article ?")) {
    return;
  }
  const response = await fetch(`/api/admin/articles/${id}`, {
    method: "DELETE",
    credentials: "same-origin",
  });
  if (!response.ok) {
    return;
  }
  editing.value = false;
  reading.value = null;
  await load();
}
</script>
