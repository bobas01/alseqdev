# ALSEQ DEV

Site professionnel. Symfony 7.4 pour l’API, Vue 3 pour les pages.

## Lancer le site

```bash
cd frontend
npm install
npm run dev
```

Le site s’ouvre sur http://localhost:5173/pt-br

Langues : `/pt-br`, `/fr`, `/en`, `/es`.

## Lancer l’API

PHP 8.3 ou plus, avec l’extension OpenSSL.

```bash
cd backend
composer install
php -d expose_php=0 -S 127.0.0.1:8000 -t public
```
