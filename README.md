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

PHP 8.4, avec les extensions OpenSSL et PDO SQLite. Le PHP 8.3.0 de WAMP plante à l’enregistrement d’un message.

```bash
cd backend
composer install
php -d expose_php=0 -S 127.0.0.1:8000 -t public public/index.php
```

Le formulaire de contact passe par `http://localhost:5173/api`. Les messages sont enregistrés, puis envoyés avec `MAILER_DSN`. En local, ce réglage est `null://null` : rien ne quitte la machine, et une copie du message est écrite dans `backend/var/mail`. L’adresse de réception se change avec `CONTACT_TO` dans `backend/.env.local`. Les messages restent un an, puis `php bin/console app:contact:purge` les supprime. Il n’existe pas d’adresse pour les lire en public.
