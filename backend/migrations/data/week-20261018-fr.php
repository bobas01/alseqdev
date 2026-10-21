<?php

declare(strict_types=1);

return [
    [
        'locale' => 'fr',
        'category' => 'developpement',
        'slug' => 'postgresql-19-premier-candidat',
        'title' => 'PostgreSQL 19 approche de sa version finale',
        'summary' => 'Le 15 octobre 2026, une version d’essai presque définitive est sortie. La version stable est prévue le 19 novembre, après un second essai le 12 novembre.',
        'cover' => '/blog/postgresql-19.svg',
        'translation_key' => 'postgresql-19',
        'published_at' => '2026-10-18 20:00:00',
        'sources' => [
            ['title' => 'PostgreSQL — 19 RC 1', 'url' => 'https://www.postgresql.org/about/news/postgresql-19-rc-1-released-3409/'],
            ['title' => 'PostgreSQL — notes de la version 19', 'url' => 'https://www.postgresql.org/docs/19/release-19.html'],
            ['title' => 'LWN — des fonctions retirées pendant la bêta', 'url' => 'https://lwn.net/Articles/1100182/'],
            ['title' => 'AWS — l’essai sur RDS Preview', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/postgresql-19-rc1-amazon-rds-database-preview-environment/'],
        ],
        'body' => <<<'TXT'
Le 15 octobre 2026, le PostgreSQL Global Development Group a publié une version d’essai presque définitive de la 19. Elle doit être presque identique à la version stable, avec encore des corrections possibles. La grosse fournée de correctifs du 12 novembre entre dans cette version avant la sortie : un second essai est prévu ce jour-là. Sauf report, la version générale est le 19 novembre 2026.

## Ce qui est dedans

Les notes de la version 19 décrivent la commande REPACK, qui récupère l’espace disque et peut réordonner les lignes. Avec l’option concurrente, les lectures et les écritures continuent pendant la réécriture. Elle remplace VACUUM FULL et CLUSTER, qui restent disponibles. Deux extensions permettent de figer des choix du planificateur, ou de les réappliquer ensuite. La réplication logique peut s’activer sans redémarrer le serveur quand le niveau de journal est déjà « replica ». Les valeurs de séquence peuvent aussi être répliquées.

L’annonce du 15 octobre liste des corrections depuis la bêta 4, notamment sur REPACK en mode concurrent, sur le conseil de plan, et sur cette activation de la réplication logique.

## Ce qu’on n’en fait pas

Amazon RDS propose cette version d’essai dans son environnement d’aperçu, le même jour. Ces bases y sont gardées 60 jours au plus, puis supprimées. LWN a relayé, le 13 octobre, un membre de l’équipe : plusieurs fonctions prévues ont été retirées pendant la bêta, parce que les défauts sont apparus trop tard pour être tenus. La version d’essai publiée n’est donc pas toute la liste annoncée plus tôt.

Une base en production reste sur une version déjà en service. On essaie la 19 à part. Le passage depuis une version majeure plus ancienne se fait par une mise à jour majeure.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'devops',
        'slug' => 'lambda-sert-une-page-web',
        'title' => 'Lambda publie un site déjà écrit',
        'summary' => 'Le 12 octobre 2026, AWS permet de mettre en ligne un site Node.js déjà fait, sans le réécrire dans le format propre à Lambda.',
        'cover' => '/blog/lambda-web.svg',
        'translation_key' => 'lambda-web',
        'published_at' => '2026-10-18 19:00:00',
        'sources' => [
            ['title' => 'AWS — annonce Lambda Web Functions', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/aws-lambda-web-functions/'],
            ['title' => 'AWS News Blog — le même lancement', 'url' => 'https://aws.amazon.com/blogs/aws/announcing-aws-lambda-web-functions-for-fast-consistent-web-app-performance-anywhere/'],
            ['title' => 'LocalStack — l’essai en local', 'url' => 'https://blog.localstack.cloud/aws-lambda-web-functions-are-here/'],
        ],
        'body' => <<<'TXT'
Le 12 octobre 2026, AWS a annoncé Lambda Web Functions. Un site Node.js déjà écrit avec Express, Hono, Fastify ou Next.js peut rester tel quel. Il n’y a pas à le réécrire dans un format propre à Lambda.

## Ce qui change

Les fonctions Lambda déjà en place s’appellent désormais Lambda Event Functions. AWS dit que ce changement de nom ne demande aucun redéploiement. Un environnement web chaud traite plusieurs requêtes à la fois, jusqu’à 128. On paie le temps de processeur réellement utilisé, et la mémoire tant que l’environnement existe, y compris entre deux requêtes. Le temps passé à attendre une base compte peu en processeur.

Au lancement, le moteur est Node.js. Les régions ouvertes sont la Virginie du Nord, l’Ohio, l’Oregon, Tokyo et l’Irlande. On peut déployer vers plusieurs d’entre elles et laisser chaque requête partir vers la plus proche. Une fonction peut joindre un réseau privé. CloudFront peut s’en servir comme origine, annoncé le même jour.

## Ce que ça ne règle pas

LocalStack a écrit qu’il les prend en charge dès ce lancement, pour les essayer en local avant un déploiement. Le modèle reste du Node.js, dans cinq régions. Une application déjà hébergée ailleurs n’a pas à déménager pour ça.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'cybersecurite',
        'slug' => 'nextjs-1641-a-installer',
        'title' => 'Next.js 16.4.1 est à installer',
        'summary' => 'Le 14 octobre 2026, Next.js a publié une mise à jour de sécurité en dehors des dates habituelles. Il faut installer la 16.4.1, ou la 15.5.28 si le site est encore sur la série 15.',
        'cover' => '/blog/nextjs-1641.svg',
        'translation_key' => 'nextjs-20261014',
        'published_at' => '2026-10-18 21:00:00',
        'sources' => [
            ['title' => 'Next.js — mise à jour du 14 octobre', 'url' => 'https://nextjs.org/blog/nextjs-security-update-october-14-2026'],
            ['title' => 'NHS England Digital — la même alerte', 'url' => 'https://digital.nhs.uk/cyber-alerts/2026/cc-4873'],
        ],
        'body' => <<<'TXT'
Le 14 octobre 2026, Vercel a publié la mise à jour de sécurité annoncée la semaine d’avant. Elle sort du calendrier habituel. Les versions indiquées sont 16.4.1, sur la branche encore suivie de près, et 15.5.28, sur la branche de maintenance 15.5.

## Ce que les correctifs couvrent

Le billet décrit les effets, sans mode d’emploi. Deux points critiques peuvent mener à l’exécution de code sur le serveur, sans compte. L’un concerne les applications qui mettent des résultats en cache. L’éditeur demande de mettre à jour même si ce cas n’est pas dans l’application. L’autre concerne l’optimisation d’images, quand le serveur tourne sur Linux. Un troisième point peut saturer le processeur et empêcher le même processus de répondre. Il vise les applications App Router qui ont au moins une action serveur. Le routeur de pages, et une application sans action serveur, sont en dehors de ce troisième point.

NHS England a repris l’avis le 19 octobre : trois failles, exécution de code ou indisponibilité, et le même conseil de mettre à jour. Ce texte ne reprend pas le détail de chaque déclencheur.

## La version à atteindre

Sur la branche 16, le numéro publié le 14 octobre est 16.4.1. Sur la branche 15.5, c’est 15.5.28. Un site encore en dessous, dans les plages concernées, reste exposé tant qu’il n’a pas ces numéros.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'ia',
        'slug' => 'gemini-4-argon-prix-dappel',
        'title' => 'Gemini 4 Argon coûte moins cher jusqu’au 30 novembre',
        'summary' => 'Le 13 octobre 2026, Google a ouvert ce modèle. Jusqu’au 30 novembre, le texte envoyé coûte 2 dollars par million d’unités, et la réponse 10. Ces prix doublent le 1er décembre. Il n’est pas gratuit.',
        'cover' => '/blog/gemini-4-argon.svg',
        'translation_key' => 'gemini-4-argon',
        'published_at' => '2026-10-18 18:00:00',
        'sources' => [
            ['title' => 'Google — Gemini 4 Argon', 'url' => 'https://blog.google/innovation-and-ai/models-and-research/gemini-models/introducing-gemini-4-argon/'],
            ['title' => 'Google AI for Developers — fiche du modèle', 'url' => 'https://ai.google.dev/gemini-api/docs/latest-model'],
            ['title' => 'Google Cloud — la même ouverture', 'url' => 'https://cloud.google.com/blog/products/ai-machine-learning/gemini-4-argon-available-on-google-cloud'],
        ],
        'body' => <<<'TXT'
Le 13 octobre 2026, Google a ouvert Gemini 4 Argon. L’identifiant d’API est gemini-4-argon. Le prix d’appel court jusqu’au 30 novembre 2026 : 2 dollars le million de jetons en entrée, 10 dollars en sortie, réflexion comprise. À partir du 1er décembre, les tarifs passent à 4 et 20. Les jetons d’entrée déjà vus sont comptés 95 % moins cher : 0,10 dollar, puis 0,20. Le modèle n’est pas sur l’offre gratuite.

## Ce que Google en dit

La fenêtre fait 1 048 576 jetons, partagés entre l’entrée, la réflexion et la sortie. Le niveau de réflexion par défaut est moyen. On peut le baisser ou le monter. Google dit qu’Argon est premier sur l’indice Vals, qui couvre la finance, le code, le droit et la fiscalité. C’est sa mesure.

Le billet du 13 octobre ouvre l’API dans AI Studio, Antigravity pour les abonnés Ultra, et l’application Gemini pour les abonnés Pro et Ultra. La documentation développeur, datée du 16 octobre, confirme le prix, la fenêtre et l’absence d’offre gratuite. La mise en cache demandée à la main n’est pas prise en charge. La mise en cache automatique, elle, l’est à partir d’un certain volume.

## Ce qu’on n’en fait pas

Le prix double le 1er décembre. Un essai au tarif d’appel ne dit pas la facture de janvier. Google raconte aussi des chantiers internes, avec ses propres chiffres. La sortie est facturée, réflexion comprise. Le modèle ne relit pas le travail à votre place.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'developpement',
        'slug' => 'fichier-fige-les-actions',
        'title' => 'Un fichier garde la version exacte des outils GitHub',
        'summary' => 'Le 14 octobre 2026, GitHub a montré un fichier qui retient la version des outils lancés tout seuls. L’essai est réservé aux comptes Enterprise Cloud. Retenir la version ne prouve pas que l’outil soit fiable.',
        'cover' => '/blog/actions-lock.svg',
        'translation_key' => 'actions-lock',
        'published_at' => '2026-10-18 22:00:00',
        'sources' => [
            ['title' => 'GitHub Changelog — l’aperçu du 14 octobre', 'url' => 'https://github.blog/changelog/2026-10-14-github-actions-workflow-lockfiles-in-public-preview/'],
            ['title' => 'GitHub Docs — verrouiller les dépendances', 'url' => 'https://docs.github.com/en/actions/how-tos/secure-your-work/lock-workflow-dependencies'],
            ['title' => 'GitHub — dépôt gh-actions-lock', 'url' => 'https://github.com/github/gh-actions-lock'],
        ],
        'body' => <<<'TXT'
Le 14 octobre 2026, GitHub a ouvert un aperçu public des fichiers de verrouillage pour GitHub Actions. Une étiquette ou une branche peut bouger après la relecture. Le fichier garde le commit enregistré, et Actions exécute celui-là, même si l’étiquette a bougé depuis.

L’aperçu est annoncé pour GitHub Enterprise Cloud, y compris avec résidence des données. Le journal ne l’ouvre pas aux formules Team et Free. L’extension s’appelle actions-lock. Le fichier produit est .github/workflows/actions.lock. On peut n’enrôler qu’un workflow. Une fois enrôlé, chaque dépendance, y compris celles qu’elle tire, doit avoir une ligne.

Verrouiller ne dit pas que la dépendance est saine. GitHub le dit : on relit avant de figer. Dependabot, quand il propose une mise à jour d’une action déjà enrôlée, régénère la ligne dans la même demande. Un administrateur d’entreprise, d’organisation ou de dépôt peut exiger le fichier. L’extension est avant la version 1.0, et le format peut encore changer.

C’est utile quand les workflows tournent déjà sur Enterprise Cloud et que le risque visé est une étiquette qui bouge. Ailleurs, l’aperçu n’est pas annoncé. Ce n’est pas un contrôle du contenu des actions.
TXT,
    ],
];
