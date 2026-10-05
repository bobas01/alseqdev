<?php

declare(strict_types=1);

return [
    [
        'locale' => 'fr',
        'category' => 'developpement',
        'slug' => 'python-310-fin-des-correctifs',
        'title' => 'Python 3.10 ne recevra plus de correctif',
        'summary' => 'Le 1er octobre 2026, Python 3.10.22 est devenu la dernière version de cette branche. Aucun correctif de sécurité ne suivra. Quatre autres branches ont été mises à jour le même jour.',
        'cover' => '/blog/python-310.svg',
        'translation_key' => 'python-310',
        'published_at' => '2026-10-04 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — les versions du 1er octobre 2026', 'url' => 'https://blog.python.org/2026/10/python-31022-31117/'],
            ['title' => 'Linux Compatible — fin de Python 3.10', 'url' => 'https://www.linuxcompatible.org/story/python-31022-31117-31215-31316-and-3148-ship-as-310-hits-end-of-life/'],
            ['title' => 'endoflife.ai — date de fin de Python 3.10', 'url' => 'https://endoflife.ai/python/3.10'],
        ],
        'body' => <<<'TXT'
Le 1er octobre 2026, la branche Python 3.10 s’est arrêtée. La version 3.10.22 est la dernière. Elle corrige encore des failles, puis plus rien : cette branche ne recevra plus de mise à jour de sécurité. Le logiciel continue de tourner. Personne ne le répare ensuite.

Cinq ans se sont écoulés depuis la première 3.10, en octobre 2021. La date était prévue. Ce n’est pas une coupure surprise. À partir de là, garder 3.10 est un choix : on accepte qu’une faille découverte plus tard reste ouverte dans cette branche.

## Le même jour, les autres branches

La même annonce a publié quatre autres numéros : 3.11.17, 3.12.15, 3.13.16 et 3.14.8. Ce sont des mises à jour d’entretien. Elles ne changent pas le langage. Elles portent des corrections.

3.14 est la branche de fonctionnalités la plus récente. 3.10, elle, ne bougera plus. Linux Compatible a repris l’annonce le jour même : une seule publication, cinq numéros, et la fin officielle de 3.10. Python Insider est le texte d’origine, sur le blog du projet. endoflife.ai, qui suit les dates de fin de support, marque le 1er octobre 2026 et cite 3.10.22 comme dernière publication.

## Pas d’installeur pour ce dernier numéro

3.10.22 est livrée en code source seulement. Il n’y a pas d’installeur Windows ni macOS pour ce dernier numéro. Le dernier installeur complet de la branche date d’une version antérieure. Quelqu’un qui cherche un fichier prêt à lancer pour 3.10.22 ne le trouvera pas : il n’a pas été construit.

Cela ne change pas le fond. Même avec un installeur, cette version ne recevrait plus de correctif.

## Ce que « plus de correctif » veut dire

Une faille trouvée après le 1er octobre 2026 peut être réparée dans une branche encore suivie. Elle ne le sera pas dans 3.10. Pour une machine personnelle, le risque est parfois faible. Pour un service en ligne, une image qui lance encore 3.10, ou un serveur oublié, la faille suivante restera ouverte sur cette branche.

Les bibliothèques finissent aussi par exiger une version plus récente. Le moment le moins cher pour changer est avant que quelque chose casse, pas le jour où un outil refuse de s’installer.

## Par quoi remplacer

Il n’y a pas un numéro magique. Il y a une branche qui reçoit encore des correctifs, essayée avec le projet. Les bibliothèques, l’hébergement et les outils autour doivent suivre. Un environnement séparé par projet évite de casser le reste de la machine en changeant la version globale.

Le geste utile est de repérer où 3.10 tourne encore, puis de choisir la branche qui la remplace. Attendre le prochain avis de sécurité sur 3.10 ne sert à rien. Il n’y en aura plus.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'devops',
        'slug' => 'kubernetes-137-anciennes-options',
        'title' => 'Kubernetes 1.37 refuse les anciennes options',
        'summary' => 'Kubernetes 1.37, dit Garhwal, est sorti le 26 août 2026. Dix-huit anciennes options empêchent un nœud de démarrer. Il faut les retirer avant la mise à jour.',
        'cover' => '/blog/kube-137.svg',
        'translation_key' => 'kube-137',
        'published_at' => '2026-10-04 19:00:00',
        'sources' => [
            ['title' => 'Kubernetes — annonce de la version 1.37 Garhwal', 'url' => 'https://kubernetes.io/blog/2026/08/26/kubernetes-v1-37-release/'],
            ['title' => 'Saaro — options retirées, mise à l’échelle jusqu’à zéro', 'url' => 'https://blog.saaro.net/en/kubernetes-1-37-garhwal-hpa-scale-to-zero-gang-scheduling-un'],
            ['title' => 'Indra Gusti Prasetya — les dix-huit options et le démarrage', 'url' => 'https://indragustiprasetya.com/blog/kubernetes-1-37-drops-18-kubelet-flags-nodes-never-join.html'],
        ],
        'body' => <<<'TXT'
Kubernetes 1.37 porte le nom Garhwal. La version est sortie le 26 août 2026. Le blog du projet annonce 67 évolutions : une partie devient stable, une autre entre en essai. Ce qui occupe les lectures de cette semaine, début octobre, est plus concret. Un nœud peut refuser de démarrer si d’anciennes options sont encore écrites dans sa configuration.

## Dix-huit options que le nœud refuse

Le programme qui fait tourner les conteneurs sur chaque machine a changé la pièce qui lui fournissait d’anciennes mesures. Avec ce changement, dix-huit options ne sont plus acceptées. Si l’une d’elles reste dans la configuration, le nœud s’arrête au démarrage. Le message parle d’une option inconnue.

Deux noms reviennent dans les deux comptes rendus indépendants : --containerd et --containerd-namespace. Ils ne pilotent plus rien. Ils bloquent le démarrage. D’autres options de la même liste, liées à d’anciens journaux et à d’anciens stockages de mesures, font le même effet. Une seule option de cette famille reste en place : --housekeeping-interval.

Saaro, le 1er octobre, et Indra Gusti Prasetya, le 25 septembre, décrivent le même point, sur deux sites différents. Il faut retirer ces options avant la mise à jour. Elles se cachent parfois dans un fichier d’arguments préparé automatiquement, ou dans la définition du service de la machine. Après le passage en 1.37, la machine ne rejoint plus l’ensemble tant que la ligne est là. Le blog officiel de Kubernetes pose la version et son calendrier. Les deux articles d’octobre disent quoi vérifier avant de l’installer.

## Descendre un service à zéro

Le texte de Saaro retient une autre évolution. L’ajustement automatique du nombre de copies peut réduire un service jusqu’à zéro. Quand il n’y a pas d’appel, les copies peuvent disparaître, puis revenir. Ce n’est pas le comportement ancien, où il en restait au moins une.

C’est un choix de coût et de délai. Un service qui part de zéro met un peu plus de temps à répondre au premier appel. Un service qui doit toujours répondre tout de suite n’a pas intérêt à descendre si bas. Cela se décide service par service.

## Avant la mise à jour

Le travail est une relecture. Repérer les options retirées. Les enlever. Essayer sur une machine qui ne porte pas le trafic, et vérifier qu’elle démarre, avant de toucher les autres. La liste complète des dix-huit noms est dans les deux articles cités et dans le journal des modifications du projet. Cette liste-là prime sur un souvenir.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'cybersecurite',
        'slug' => 'netscaler-correctif-4-octobre',
        'title' => 'NetScaler : installer le correctif du 4 octobre',
        'summary' => 'Le 4 octobre 2026, Citrix a publié un correctif d’urgence pour NetScaler. L’éditeur parle d’une indisponibilité déjà constatée sur des installations non corrigées. Il faut atteindre la version indiquée.',
        'cover' => '/blog/netscaler.svg',
        'translation_key' => 'netscaler-4-oct',
        'published_at' => '2026-10-04 21:00:00',
        'sources' => [
            ['title' => 'BleepingComputer — correctif NetScaler du 4 octobre', 'url' => 'https://www.bleepingcomputer.com/news/security/citrix-patches-netscaler-saml-zero-day-exploited-in-attacks/'],
            ['title' => 'Citrix — bulletin du 4 octobre 2026', 'url' => 'https://support.citrix.com/external/article/CTX697174/citrix-netscaler-adc-and-citrix-netscale.html'],
            ['title' => 'SecurityOnline — le même correctif, le même jour', 'url' => 'https://securityonline.info/citrix-netscaler-cve-2026-88779-exploited/'],
        ],
        'body' => <<<'TXT'
Dimanche 4 octobre 2026, Citrix a publié un correctif d’urgence pour NetScaler ADC et NetScaler Gateway. Le bulletin porte le numéro CVE-2026-88779. Citrix le décrit comme une indisponibilité : l’appareil peut cesser de répondre. La note indiquée par l’éditeur est 8,7. Citrix écrit que des attaques ciblées ont déjà touché des installations qui n’avaient pas le correctif.

BleepingComputer et SecurityOnline ont rapporté la publication le jour même, chacun sur son site. Le catalogue américain des failles déjà utilisées, tenu par CISA, a ajouté ce numéro le même dimanche. Pour les agences fédérales concernées, la date limite indiquée est le 7 octobre. Le bulletin à suivre reste celui de Citrix : c’est lui qui donne les numéros de version.

## Ce que les articles ne tranchent pas

Plusieurs rédactions écrivent que des chercheurs regardent si l’effet s’arrête à l’indisponibilité, ou s’il va plus loin. Ce n’est pas ce que le bulletin établit. Le bulletin parle d’un service qui tombe. Tant que l’éditeur ne dit pas autre chose, le fait à retenir est celui-là.

Ce texte ne décrit pas comment le problème se déclenche. La seule action utile est d’installer la version corrigée, puis de vérifier le numéro affiché.

## Les versions qui corrigent

Citrix demande d’atteindre, selon la branche déjà en place :

- 14.1-73.41, ou une version plus récente de la branche 14.1
- 13.1-64.28, ou une version plus récente de la branche 13.1

Des éditions FIPS et NDcPP ont leurs propres numéros dans le bulletin officiel. Une version « assez récente » ne suffit pas. Il faut ces numéros, ou plus récents.

## Une seconde mise à jour

Fin septembre, d’autres correctifs d’urgence avaient déjà été publiés pour les mêmes appareils. Citrix prévient que les installations mises à jour à ce moment-là doivent l’être encore, lorsqu’elles sont concernées par le bulletin du 4 octobre. Le correctif de septembre ne couvre pas celui de dimanche.

Pour un accès distant d’entreprise, le geste est d’appliquer le bulletin du fabricant, puis de contrôler que le numéro de version est bien celui qui corrige. Le délai du catalogue américain rappelle l’urgence. Il ne remplace pas la page de Citrix.
TXT,
    ],
    [
        'locale' => 'fr',
        'category' => 'ia',
        'slug' => 'modeles-qui-choisissent',
        'title' => 'Des modèles qui choisissent au lieu d’écrire',
        'summary' => 'Le 1er octobre 2026, Cloudflare et AWS ont publié des modèles qui ne rédigent pas. Ils renvoient un choix parmi des réponses déjà autorisées, avec une probabilité.',
        'cover' => '/blog/decision.svg',
        'translation_key' => 'decision-models',
        'published_at' => '2026-10-04 18:00:00',
        'sources' => [
            ['title' => 'Cloudflare Blog — annonce de Clef', 'url' => 'https://blog.cloudflare.com/clef-decision-models/'],
            ['title' => 'TechCrunch — les modèles qui trient des options', 'url' => 'https://techcrunch.com/2026/10/01/amazon-releases-its-own-jev-clone-as-decision-models-flood-the-web/'],
            ['title' => 'beri.net — Clef et Strands Decider, le même jour', 'url' => 'https://www.beri.net/article/cloudflare-clef-amazon-strands-decider-open-weight-decision-models-vs-jev-benchmarks-pricing'],
        ],
        'body' => <<<'TXT'
Le 1er octobre 2026, deux équipes ont publié des modèles qui ne rédigent pas. On leur donne une situation et des réponses autorisées. Ils renvoient un choix, avec une probabilité. Pas un paragraphe à relire, pas une phrase à découper.

C’est une autre tâche que celle des modèles qui écrivent. Écrire sert à expliquer, résumer, proposer. Choisir sert à brancher une suite : envoyer un dossier à une équipe, accepter ou refuser une demande, prendre un outil plutôt qu’un autre. Le résultat tient dans une case.

## Clef, chez Cloudflare

Cloudflare a présenté Clef et Clef-flash. Le premier est le plus grand des deux, le second est prévu pour répondre plus vite. Les deux sont proposés sur le service Workers AI. Les poids sont publiés sous licence Apache 2.0 : on peut les reprendre et les faire tourner ailleurs.

Le blog de Cloudflare décrit le fonctionnement. Le modèle lit la situation et des questions fermées, puis donne une probabilité pour chaque réponse permise. Il n’y a pas de texte libre à interpréter. TechCrunch, le même jour, range cette publication parmi des modèles faits pour trier des options déjà posées, plutôt que pour produire un long texte. beri.net reprend les deux annonces côte à côte, sur un troisième site.

## Strands Decider, chez AWS

Le même 1er octobre, un laboratoire d’AWS a publié Strands Decider. TechCrunch le décrit comme un modèle ouvert, assez petit pour tourner sur une machine locale, qui sert à trier des options déjà décidées et à indiquer à quel point le choix est assuré. Il n’écrit pas de réponse libre. beri.net ajoute que les poids, les données d’entraînement et les scripts ont été publiés : on peut relire comment il a été construit, pas seulement l’utiliser comme une boîte fermée.

Les deux annonces ne se copient pas. Clef est d’abord un service, avec des poids réutilisables. Decider est petit et prévu pour rester près de la machine qui l’utilise. Les deux refusent le texte libre.

## Ce que ça change dans un outil

Dans un outil métier, une étape « le modèle décide » est plus simple à contrôler quand les réponses possibles sont écrites à l’avance. On peut vérifier que la sortie est l’une des cases prévues. On ne relit pas un paragraphe qui aurait inventé une troisième voie.

Cela ne remplace pas un modèle qui doit rédiger une note ou répondre à un client. Cela remplace les endroits où l’on demande à un grand modèle de choisir, puis où l’on espère qu’il a répondu dans le bon format. Ici le format est imposé. Le choix reste à relire quand la décision a un coût : le modèle indique une probabilité, il ne signe pas à la place de la personne.
TXT,
    ],
];
