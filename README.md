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

Le formulaire de contact passe par `http://localhost:5173/api`. Les messages sont enregistrés, puis envoyés avec `MAILER_DSN`. En local, ce réglage est `null://null` : rien ne quitte la machine, et une copie du message est écrite dans `backend/var/mail`. L’adresse de réception est `alseqdev@gmail.com`. Les messages restent un an, puis `php bin/console app:contact:purge` les supprime. Il n’existe pas d’adresse publique pour les lire : la lecture se fait sur http://localhost:5173/admin, avec le mot de passe dont l’empreinte est dans `backend/.env.local`.

Les pages Confidentialité et Mentions sont sous chaque langue, par exemple http://localhost:5173/fr/confidentialite.

## Production

L’image Docker sert le site et l’API sur le port 80. Les messages sont dans `/data/app.db`. Ce dossier doit être un volume, sinon un déploiement les efface.

Dokploy : application Dockerfile, contexte `.`, port `80`, branche `main`, déploiement automatique. Monter un volume sur `/data`.

Variables à saisir dans Dokploy, pas dans Git :

- `APP_SECRET`
- `ADMIN_PASSWORD_HASH`
- `TRUSTED_HOSTS`, par exemple `^exemple\.com$`
- `DEFAULT_URI`, par exemple `https://exemple.com`
- `MAILER_DSN` reste `null://null` tant que l’envoi d’e-mails n’est pas branché
