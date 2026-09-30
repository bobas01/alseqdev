import { createI18n } from "vue-i18n";
import fr from "./locales/fr.json";
import en from "./locales/en.json";
import ptBR from "./locales/pt-BR.json";
import es from "./locales/es.json";

export const LOCALES = ["pt-br", "fr", "en", "es"];

const htmlLang = {
  "pt-br": "pt-BR",
  fr: "fr",
  en: "en",
  es: "es",
};

export function htmlLanguage(locale) {
  return htmlLang[locale] ?? "pt-BR";
}

export const i18n = createI18n({
  legacy: false,
  locale: "pt-br",
  fallbackLocale: "pt-br",
  messages: {
    "pt-br": ptBR,
    fr,
    en,
    es,
  },
});
