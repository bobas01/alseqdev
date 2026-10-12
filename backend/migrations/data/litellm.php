<?php

declare(strict_types=1);

return [
    [
        'locale' => 'fr',
        'category' => 'developpement',
        'slug' => 'litellm-une-porte-pour-lequipe',
        'title' => 'LiteLLM, une porte pour toute une équipe',
        'summary' => 'LiteLLM, de BerriAI, met une seule interface devant plus de cent modèles. Le proxy ajoute des clés par personne et un suivi des dépenses. Pour quelqu’un seul, le gain est plus mince.',
        'cover' => '/blog/litellm.svg',
        'translation_key' => 'litellm',
        'published_at' => '2026-10-12 22:00:00',
        'sources' => [
            ['title' => 'LiteLLM — prise en main', 'url' => 'https://docs.litellm.ai/docs/'],
            ['title' => 'PyPI — le paquet litellm', 'url' => 'https://pypi.org/project/litellm/'],
            ['title' => 'GitHub — BerriAI/litellm', 'url' => 'https://github.com/BerriAI/litellm'],
        ],
        'body' => <<<'TXT'
LiteLLM est une bibliothèque ouverte, sous licence MIT, tenue par BerriAI. Elle donne une seule façon d’appeler plus de cent modèles : OpenAI, Anthropic, Vertex AI, Bedrock, et d’autres. L’appel garde le format d’OpenAI, quel que soit le fournisseur derrière. PyPI la décrit comme une bibliothèque pour parler aux fournisseurs de modèles. Le code est sur GitHub, la documentation sur le site du projet.

## Deux usages

Le premier est dans un programme Python. Une fonction unique envoie la demande, réessaie, et peut basculer sur un autre déploiement si le premier ne répond pas. La réponse revient dans le même format.

Le second est un proxy que l’on héberge soi-même. N’importe quel outil qui parle déjà le format d’OpenAI peut viser cette porte, sans changer son code. La documentation décrit des clés virtuelles, un budget par clé, par personne ou par équipe, un journal, et un écran d’administration. C’est là que LiteLLM devient un outil d’équipe : on voit qui dépense, et on coupe une clé sans couper les autres.

## Quand ça vaut le coup

Une personne seule, qui branche déjà ses outils sur une passerelle locale, y gagne peu. La pièce utile apparaît quand plusieurs personnes partagent les mêmes modèles et qu’il faut un compte par personne. Le proxy demande alors une base Postgres pour les clés et les dépenses. Ce n’est pas un bouton sur le bureau.

Le projet reste une bibliothèque et un serveur à tenir. Il ne choisit pas le modèle à votre place, et il ne relit pas ce que le modèle écrit.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'developpement',
        'slug' => 'litellm-a-door-for-the-team',
        'title' => 'LiteLLM, a door for the whole team',
        'summary' => 'LiteLLM, from BerriAI, puts one interface in front of more than a hundred models. The proxy adds a key per person and spend tracking. For someone working alone, the gain is thinner.',
        'cover' => '/blog/litellm.svg',
        'translation_key' => 'litellm',
        'published_at' => '2026-10-12 22:00:00',
        'sources' => [
            ['title' => 'LiteLLM — getting started', 'url' => 'https://docs.litellm.ai/docs/'],
            ['title' => 'PyPI — the litellm package', 'url' => 'https://pypi.org/project/litellm/'],
            ['title' => 'GitHub — BerriAI/litellm', 'url' => 'https://github.com/BerriAI/litellm'],
        ],
        'body' => <<<'TXT'
LiteLLM is an open library, under the MIT license, kept by BerriAI. It gives one way to call more than a hundred models: OpenAI, Anthropic, Vertex AI, Bedrock, and others. The call keeps the OpenAI format, whichever provider sits behind it. PyPI describes it as a library for talking to model providers. The code is on GitHub, the documentation on the project site.

## Two uses

The first is inside a Python program. One function sends the request, retries, and can switch to another deployment if the first does not answer. The reply comes back in the same format.

The second is a proxy you host yourself. Any tool that already speaks the OpenAI format can aim at that door, without a code change. The documentation describes virtual keys, a budget per key, per person or per team, a log, and an admin screen. That is where LiteLLM becomes a team tool: you see who is spending, and you can cut one key without cutting the others.

## When it earns its place

Someone working alone, who already points their tools at a local gateway, gains little. The useful piece appears when several people share the same models and each person needs an account. The proxy then needs a Postgres database for the keys and the spend. It is not a button on the desk.

The project remains a library and a server to keep running. It does not pick the model for you, and it does not read over what the model writes.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'developpement',
        'slug' => 'litellm-uma-porta-para-a-equipe',
        'title' => 'LiteLLM, uma porta para a equipe inteira',
        'summary' => 'O LiteLLM, da BerriAI, põe uma só interface na frente de mais de cem modelos. O proxy acrescenta uma chave por pessoa e o acompanhamento do gasto. Para quem trabalha sozinho, o ganho é mais fino.',
        'cover' => '/blog/litellm.svg',
        'translation_key' => 'litellm',
        'published_at' => '2026-10-12 22:00:00',
        'sources' => [
            ['title' => 'LiteLLM — primeiros passos', 'url' => 'https://docs.litellm.ai/docs/'],
            ['title' => 'PyPI — o pacote litellm', 'url' => 'https://pypi.org/project/litellm/'],
            ['title' => 'GitHub — BerriAI/litellm', 'url' => 'https://github.com/BerriAI/litellm'],
        ],
        'body' => <<<'TXT'
O LiteLLM é uma biblioteca aberta, sob licença MIT, mantida pela BerriAI. Ela dá um só jeito de chamar mais de cem modelos: OpenAI, Anthropic, Vertex AI, Bedrock e outros. A chamada guarda o formato da OpenAI, seja qual for o fornecedor por trás. O PyPI a descreve como uma biblioteca para falar com fornecedores de modelos. O código está no GitHub, a documentação no site do projeto.

## Dois usos

O primeiro é dentro de um programa Python. Uma função manda o pedido, tenta de novo, e pode passar para outro servidor se o primeiro não responde. A resposta volta no mesmo formato.

O segundo é um proxy que se hospeda. Qualquer ferramenta que já fala o formato da OpenAI pode apontar para essa porta, sem mudar o código. A documentação descreve chaves virtuais, um teto por chave, por pessoa ou por equipe, um registro, e uma tela de administração. É aí que o LiteLLM vira ferramenta de equipe: dá para ver quem gasta, e cortar uma chave sem cortar as outras.

## Quando vale a pena

Quem trabalha sozinho, e já aponta as ferramentas para uma passagem local, ganha pouco. A peça útil aparece quando várias pessoas compartilham os mesmos modelos e cada uma precisa de uma conta. O proxy pede então uma base Postgres para as chaves e os gastos. Não é um botão na mesa.

O projeto continua sendo uma biblioteca e um servidor para manter. Ele não escolhe o modelo no seu lugar, e não relê o que o modelo escreve.
TXT,
    ],
    [
        'locale' => 'es',
        'category' => 'developpement',
        'slug' => 'litellm-una-puerta-para-el-equipo',
        'title' => 'LiteLLM, una puerta para todo el equipo',
        'summary' => 'LiteLLM, de BerriAI, pone una sola interfaz delante de más de cien modelos. El proxy añade una clave por persona y un seguimiento del gasto. Para quien trabaja solo, la ganancia es más fina.',
        'cover' => '/blog/litellm.svg',
        'translation_key' => 'litellm',
        'published_at' => '2026-10-12 22:00:00',
        'sources' => [
            ['title' => 'LiteLLM — primeros pasos', 'url' => 'https://docs.litellm.ai/docs/'],
            ['title' => 'PyPI — el paquete litellm', 'url' => 'https://pypi.org/project/litellm/'],
            ['title' => 'GitHub — BerriAI/litellm', 'url' => 'https://github.com/BerriAI/litellm'],
        ],
        'body' => <<<'TXT'
LiteLLM es una biblioteca abierta, bajo licencia MIT, llevada por BerriAI. Da una sola manera de llamar a más de cien modelos: OpenAI, Anthropic, Vertex AI, Bedrock y otros. La llamada guarda el formato de OpenAI, sea cual sea el proveedor que hay detrás. PyPI la describe como una biblioteca para hablar con proveedores de modelos. El código está en GitHub, la documentación en el sitio del proyecto.

## Dos usos

El primero es dentro de un programa Python. Una función envía la petición, reintenta, y puede pasar a otro despliegue si el primero no responde. La respuesta vuelve en el mismo formato.

El segundo es un proxy que se aloja uno mismo. Cualquier herramienta que ya habla el formato de OpenAI puede apuntar a esa puerta, sin cambiar el código. La documentación describe claves virtuales, un tope por clave, por persona o por equipo, un registro y una pantalla de administración. Ahí LiteLLM se vuelve una herramienta de equipo: se ve quién gasta, y se corta una clave sin cortar las demás.

## Cuándo merece la pena

Quien trabaja solo, y ya apunta sus herramientas a una pasarela local, gana poco. La pieza útil aparece cuando varias personas comparten los mismos modelos y cada una necesita una cuenta. El proxy pide entonces una base Postgres para las claves y el gasto. No es un botón en el escritorio.

El proyecto sigue siendo una biblioteca y un servidor que hay que mantener. No elige el modelo en su lugar, y no relee lo que el modelo escribe.
TXT,
    ],
];
