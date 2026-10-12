<?php

declare(strict_types=1);

return [
    [
        'locale' => 'fr',
        'category' => 'developpement',
        'slug' => 'python-315-est-sorti',
        'title' => 'Python 3.15 est sorti',
        'summary' => 'Le 9 octobre 2026, Python 3.15.0 est devenu la version stable. C’est la branche qui suit 3.14. Le projet compte 5 643 changements, venus de 1 012 personnes.',
        'cover' => '/blog/python-315.svg',
        'translation_key' => 'python-315',
        'published_at' => '2026-10-12 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — Python 3.15.0', 'url' => 'https://blog.python.org/2026/10/python-3150-final-is-here/'],
            ['title' => 'Phoronix — la sortie de Python 3.15', 'url' => 'https://www.phoronix.com/news/Python-3.15-Released'],
            ['title' => 'LWN — Python 3.15 released', 'url' => 'https://lwn.net/Articles/1099602/'],
        ],
        'body' => <<<'TXT'
Le 9 octobre 2026, Python 3.15.0 est devenu la version stable. C’est la branche de fonctionnalités qui suit 3.14. L’annonce du projet compte 5 643 changements, venus de 1 012 personnes.

## Ce qui change dans le langage

Trois ajouts reviennent dans l’annonce et dans les deux reprises du jour. frozendict est un dictionnaire qu’on ne modifie plus après l’avoir créé. sentinel est une valeur prévue pour dire « rien de particulier », à la place d’un bricolage. L’encodage par défaut passe à UTF-8. Les imports peuvent être déclarés paresseux, pour qu’un script démarre avant d’avoir tout chargé.

Le compilateur à la volée reste expérimental. Le projet donne deux chiffres : environ 7 à 8 % plus rapide, en moyenne géométrique, sur Linux x86-64 par rapport à l’interpréteur habituel, et environ 11 à 12 % sur macOS ARM par rapport à l’interpréteur à appels terminaux. Phoronix reprend ces deux fourchettes. LWN retient le même ensemble : les deux nouveaux types, UTF-8, les fichiers de démarrage des paquets, et ce compilateur.

## Les installeurs

Les binaires Windows 64 bits officiels utilisent désormais l’interpréteur à appels terminaux. L’installeur macOS officiel installe aussi, par défaut, une seconde copie capable de tourner sans le verrou global. On peut la décocher à l’installation. Les paquets tiers qui ne sont pas prêts pour ce mode remettent le verrou.

Ce n’est pas une raison de tout basculer le jour même. 3.15 est la branche nouvelle. Une application en production reste sur une branche déjà éprouvée avec ses bibliothèques, puis on essaie 3.15 à part.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'devops',
        'slug' => 'github-actions-5-octobre',
        'title' => 'GitHub Actions a calé le 5 octobre',
        'summary' => 'Le 5 octobre 2026, GitHub Actions et les machines qu’il prête ont ralenti pendant quatre heures. Au plus fort, 47 % des workflows sur ces machines ont échoué. Les machines hébergées chez soi n’ont pas été touchées.',
        'cover' => '/blog/github-actions.svg',
        'translation_key' => 'github-actions-5-oct',
        'published_at' => '2026-10-12 19:00:00',
        'sources' => [
            ['title' => 'GitHub Status — incident Actions du 5 octobre 2026', 'url' => 'https://www.githubstatus.com/'],
            ['title' => 'Automater — les chiffres du pic', 'url' => 'https://automater.ai/news/github-actions-hosted-runners-october-5-2026-outage/'],
        ],
        'body' => <<<'TXT'
Le 5 octobre 2026, entre 18 h 48 et 22 h 49 UTC (15 h 48 à 19 h 49, heure de São Paulo), GitHub Actions et les machines qu’il prête ont ralenti. GitHub le dit sur sa page de statut. Au plus fort, pendant environ une heure et demie, 47 % des workflows sur ces machines ont échoué, et 71,9 % des tâches n’ont pas démarré dans les cinq minutes. Sur toute la plage, 14,3 % des workflows et 26,5 % des tâches ont raté ce délai de cinq minutes.

Les sites déjà publiés sur GitHub Pages ont continué d’être servis. Les machines que l’on héberge soi-même n’ont pas été touchées. Une partie des comptes a aussi vu des erreurs sur la liste des dépôts, sur les pages de licence et de facturation, et sur certaines fonctions de Copilot.

## La cause donnée par GitHub

GitHub décrit une coupure partielle de réseau entre une région de ses centres et une partie de ses bases et de ses stockages hébergés dans le cloud. Le service a été rétabli en déplaçant ce trafic vers des régions saines et en ajoutant de la capacité. Actions était revenu à 21 h 54 UTC. L’ensemble des services cités, à 22 h 49 UTC. L’analyse détaillée est encore annoncée.

Automater a repris les mêmes chiffres, sur un autre site, à partir de ce compte rendu.

## Ce qu’on en fait

Un pipeline rouge ce soir-là peut venir de la plateforme. Le comparer à la page de statut évite de chercher un bug qui n’est pas dans le projet. Une machine à soi a continué. Ce n’est pas une raison de tout déménager. C’est une raison de ne pas prendre un échec isolé, sur cette plage horaire, pour une régression du code.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'cybersecurite',
        'slug' => 'wordpress-713-a-installer',
        'title' => 'WordPress 7.1.3 est à installer',
        'summary' => 'Le 6 octobre 2026, WordPress a publié la version 7.1.3. L’annonce parle de sept correctifs de sécurité et de quatre corrections. Le projet demande de mettre à jour tout de suite.',
        'cover' => '/blog/wordpress-713.svg',
        'translation_key' => 'wordpress-713',
        'published_at' => '2026-10-12 21:00:00',
        'sources' => [
            ['title' => 'WordPress News — version 7.1.3', 'url' => 'https://wordpress.org/news/2026/10/wordpress-7-1-3-maintenance-and-security-release/'],
            ['title' => 'Patchstack — la même publication', 'url' => 'https://patchstack.com/articles/wordpress-7-1-3-security-release/'],
            ['title' => 'Search Engine Journal — sept correctifs', 'url' => 'https://www.searchenginejournal.com/wordpress-7-1-3-fixes-7-vulnerabilities-and-1-critical-flaw/592109/'],
        ],
        'body' => <<<'TXT'
Le 6 octobre 2026, WordPress a publié la version 7.1.3. L’annonce officielle parle de sept correctifs de sécurité et de quatre corrections de bugs. Le projet demande de mettre à jour tout de suite, depuis le tableau de bord, ou d’attendre la mise à jour automatique si le site l’a activée.

## Ce que les correctifs couvrent

Le billet de WordPress décrit les effets, sans mode d’emploi. Un commentaire en attente peut déposer un script sur la page d’administration des commentaires. L’export du site peut être abusé jusqu’à la base. Une personne non connectée peut lire des commentaires d’un article privé ou non publié. Un auteur peut épingler un article au-delà de son rôle. Un contenu Imgur intégré peut porter un script. Deux autres points durcissent des cas plus internes.

Patchstack et Search Engine Journal ont repris la publication le jour même : même date, sept correctifs, même conseil de mettre à jour. Ce texte ne reprend pas le détail de chaque déclencheur. La version à atteindre est 7.1.3, ou la mise à jour de sécurité de la branche encore suivie.

## Les anciennes branches

WordPress indique que les correctifs sont aussi préparés pour les branches encore éligibles, jusqu’à 4.7, et qu’ils partent au fur et à mesure. Seule la dernière version est activement suivie. Un site laissé sur une vieille branche attend un portage qui n’est pas forcément déjà là.

Le geste est de lire le numéro dans le tableau de bord et de passer à 7.1.3 si le site est sur 7.1. Les sites en mise à jour automatique le prennent seuls. Les autres attendent un clic.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'ia',
        'slug' => 'chatgpt-marque-europe',
        'title' => 'ChatGPT va marquer ses textes en Europe',
        'summary' => 'Le 5 octobre 2026, OpenAI a annoncé une marque invisible sur les textes éligibles de ChatGPT et de Codex dans l’Union européenne. Le détecteur n’est pas public. L’absence de marque ne prouve pas qu’une personne a écrit le texte.',
        'cover' => '/blog/chatgpt-eu.svg',
        'translation_key' => 'chatgpt-marque-ue',
        'published_at' => '2026-10-12 18:00:00',
        'sources' => [
            ['title' => 'OpenAI — marquage des textes pour l’Union européenne', 'url' => 'https://openai.com/index/eu-text-provenance'],
            ['title' => 'The Hindu — la même annonce, le 6 octobre', 'url' => 'https://www.thehindu.com/business/openai-to-watermark-chatgpt-text-in-eu-under-ai-act-rules/article71551205.ece'],
            ['title' => 'Agence Europe — marque invisible, détecteur réservé', 'url' => 'https://agenceurope.eu/en/bulletin/article/13953/29/openai-announces-watermark-for-texts-generated-by-its-tools-in-eu'],
        ],
        'body' => <<<'TXT'
Le 5 octobre 2026, OpenAI a expliqué comment il compte rendre reconnaissables les textes produits par ses outils, pour le règlement européen sur l’IA. Dans les semaines qui viennent, une marque invisible sera ajoutée aux textes éligibles de ChatGPT et de Codex, pour les utilisateurs dans l’Union européenne, sur toutes les formules. Ce n’est pas activé pour le reste du monde à ce lancement.

Le même jour, les clients de l’API, partout, peuvent demander cette marque pour certains modèles. Elle reste éteinte tant qu’on ne l’active pas. Le détecteur n’est pas public : OpenAI ouvre des demandes, d’abord pour des chercheurs et des organismes qu’il aura acceptés.

## Ce que la marque dit

OpenAI appelle ça textGrain. C’est un signal statistique dans le choix des mots, pas des caractères cachés. Le détecteur cherche ce signal. The Hindu et Agence Europe décrivent la même chose, le 6 octobre : une marque invisible, limitée à l’Europe pour ChatGPT, un détecteur réservé, et des limites assumées.

OpenAI donne ses propres mesures, reprises par The Hindu. Sur des textes de psychologie, avec un taux visé d’une fausse alerte sur cent, le détecteur retrouve la marque dans environ 80 % des passages de 200 jetons, et environ 95 % de ceux de 400. En mathématiques, où les mots sont plus contraints, la détection baisse. Remplacer 10 % des mots par des synonymes fait tomber une détection d’environ 92 % à 66 %. À 25 % de mots remplacés, elle tombe à environ 17 %.

## Ce qu’elle ne dit pas

OpenAI l’écrit, et Agence Europe le retient : la marque ne mesure pas la part humaine. Elle ne dit pas à qui appartient le texte, qui l’a demandé, ni si le texte est juste. L’absence de marque ne prouve pas qu’une personne l’a écrit. Le passage peut être trop court, modifié, traduit, ou venir d’un autre outil.

Pour un site, le point utile est là. Un texte collé depuis ChatGPT en Europe pourra porter cette marque. La marque ne remplace pas une relecture, et elle ne sert pas de preuve.
TXT,
    ],
];
