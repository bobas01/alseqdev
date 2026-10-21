<?php

declare(strict_types=1);

return [
    [
        'locale' => 'pt-br',
        'category' => 'developpement',
        'slug' => 'postgresql-19-primeiro-candidato',
        'title' => 'O PostgreSQL 19 está perto da versão final',
        'summary' => 'Em 15 de outubro de 2026, saiu uma versão de teste quase definitiva. A versão estável está prevista para 19 de novembro, depois de outro teste em 12 de novembro.',
        'cover' => '/blog/postgresql-19.svg',
        'translation_key' => 'postgresql-19',
        'published_at' => '2026-10-18 20:00:00',
        'sources' => [
            ['title' => 'PostgreSQL — 19 RC 1', 'url' => 'https://www.postgresql.org/about/news/postgresql-19-rc-1-released-3409/'],
            ['title' => 'PostgreSQL — notas da versão 19', 'url' => 'https://www.postgresql.org/docs/19/release-19.html'],
            ['title' => 'LWN — funções retiradas durante a beta', 'url' => 'https://lwn.net/Articles/1100182/'],
            ['title' => 'AWS — o teste no RDS Preview', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/postgresql-19-rc1-amazon-rds-database-preview-environment/'],
        ],
        'body' => <<<'TXT'
Em 15 de outubro de 2026, o PostgreSQL Global Development Group publicou uma versão de teste quase definitiva da 19. Ela deve ficar quase igual à versão estável, ainda com correções possíveis. O grande pacote de correções de 12 de novembro entra nessa versão antes do lançamento: outro teste está previsto para esse dia. Sem adiamento, a versão geral é 19 de novembro de 2026.

## O que entra

As notas da versão 19 descrevem o comando REPACK, que recupera espaço em disco e pode reordenar as linhas. Com a opção concorrente, leituras e escritas continuam durante a reescrita. Ele substitui VACUUM FULL e CLUSTER, que continuam disponíveis. Duas extensões permitem fixar escolhas do planejador, ou reaplicá-las depois. A replicação lógica pode ser ligada sem reiniciar o servidor quando o nível do diário já é « replica ». Os valores de sequência também podem ser replicados.

O anúncio de 15 de outubro lista correções desde a beta 4, em especial no REPACK concorrente, no conselho de plano, e nessa ativação da replicação lógica.

## O que não se faz com ele

A Amazon RDS oferece essa versão de teste no ambiente de prévia, no mesmo dia. Essas bases ficam lá no máximo 60 dias, e depois são apagadas. Em 13 de outubro, o LWN reproduziu um membro da equipe: várias funções previstas foram retiradas durante a beta, porque os defeitos apareceram tarde demais para serem segurados. A versão de teste publicada não é, portanto, a lista inteira anunciada antes.

Uma base em produção fica numa versão que já está em serviço. A 19 se experimenta à parte. A passagem a partir de uma versão maior mais antiga é uma atualização maior.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'devops',
        'slug' => 'lambda-pode-servir-uma-pagina',
        'title' => 'O Lambda publica um site já pronto',
        'summary' => 'Em 12 de outubro de 2026, a AWS passou a colocar no ar um site Node.js já feito, sem reescrevê-lo no formato próprio do Lambda.',
        'cover' => '/blog/lambda-web.svg',
        'translation_key' => 'lambda-web',
        'published_at' => '2026-10-18 19:00:00',
        'sources' => [
            ['title' => 'AWS — anúncio do Lambda Web Functions', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/aws-lambda-web-functions/'],
            ['title' => 'AWS News Blog — o mesmo lançamento', 'url' => 'https://aws.amazon.com/blogs/aws/announcing-aws-lambda-web-functions-for-fast-consistent-web-app-performance-anywhere/'],
            ['title' => 'LocalStack — a prova local', 'url' => 'https://blog.localstack.cloud/aws-lambda-web-functions-are-here/'],
        ],
        'body' => <<<'TXT'
Em 12 de outubro de 2026, a AWS anunciou o Lambda Web Functions. Um site Node.js já escrito com Express, Hono, Fastify ou Next.js pode ficar como está. Não é preciso reescrevê-lo no formato próprio do Lambda.

## O que muda

As funções Lambda que já existem passam a se chamar Lambda Event Functions. A AWS diz que essa mudança de nome não pede novo deploy. Um ambiente web quente trata vários pedidos ao mesmo tempo, até 128. Paga-se o tempo de processador realmente usado, e a memória enquanto o ambiente existe, inclusive entre dois pedidos. O tempo gasto à espera de uma base conta pouco em processador.

No lançamento, o motor é Node.js. As regiões abertas são Virgínia do Norte, Ohio, Oregon, Tóquio e Irlanda. Dá para publicar em várias delas e deixar cada pedido ir para a mais próxima. Uma função pode alcançar uma rede privada. O CloudFront pode usá-la como origem, anunciado no mesmo dia.

## O que isso não resolve

O LocalStack escreveu que passa a aceitá-las desde esse lançamento, para experimentá-las localmente antes de um deploy. O modelo continua sendo Node.js, em cinco regiões. Uma aplicação já hospedada em outro lugar não precisa se mudar por causa disso.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'cybersecurite',
        'slug' => 'nextjs-1641-para-instalar',
        'title' => 'Next.js 16.4.1 é a versão a instalar',
        'summary' => 'Em 14 de outubro de 2026, o Next.js publicou uma atualização de segurança fora das datas habituais. Instale a 16.4.1, ou a 15.5.28 se o site ainda estiver na linha 15.',
        'cover' => '/blog/nextjs-1641.svg',
        'translation_key' => 'nextjs-20261014',
        'published_at' => '2026-10-18 21:00:00',
        'sources' => [
            ['title' => 'Next.js — atualização de 14 de outubro', 'url' => 'https://nextjs.org/blog/nextjs-security-update-october-14-2026'],
            ['title' => 'NHS England Digital — o mesmo alerta', 'url' => 'https://digital.nhs.uk/cyber-alerts/2026/cc-4873'],
        ],
        'body' => <<<'TXT'
Em 14 de outubro de 2026, a Vercel publicou a atualização de segurança anunciada na semana anterior. Ela sai do calendário habitual. As versões indicadas são 16.4.1, na linha ainda seguida de perto, e 15.5.28, na linha de manutenção 15.5.

## O que as correções cobrem

O texto descreve os efeitos, sem modo de uso. Dois pontos críticos podem levar à execução de código no servidor, sem conta. Um diz respeito às aplicações que guardam resultados em cache. O editor pede para atualizar mesmo que esse caso não esteja na aplicação. O outro diz respeito à otimização de imagens, quando o servidor roda em Linux. Um terceiro ponto pode saturar o processador e impedir o mesmo processo de responder. Ele visa aplicações App Router que tenham pelo menos uma ação de servidor. O roteador de páginas, e uma aplicação sem ação de servidor, ficam fora desse terceiro ponto.

O NHS England retomou o aviso em 19 de outubro: três falhas, execução de código ou indisponibilidade, e o mesmo conselho de atualizar. Este texto não retoma o detalhe de cada gatilho.

## A versão a alcançar

Na linha 16, o número publicado em 14 de outubro é 16.4.1. Na linha 15.5, é 15.5.28. Um site ainda abaixo, nas faixas afetadas, continua exposto enquanto não tiver esses números.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'ia',
        'slug' => 'gemini-4-argon-preco-de-lancamento',
        'title' => 'O Gemini 4 Argon custa menos até 30 de novembro',
        'summary' => 'Em 13 de outubro de 2026, o Google abriu este modelo. Até 30 de novembro, o texto enviado custa 2 dólares por milhão de unidades, e a resposta 10. Esses preços dobram em 1º de dezembro. Ele não é gratuito.',
        'cover' => '/blog/gemini-4-argon.svg',
        'translation_key' => 'gemini-4-argon',
        'published_at' => '2026-10-18 18:00:00',
        'sources' => [
            ['title' => 'Google — Gemini 4 Argon', 'url' => 'https://blog.google/innovation-and-ai/models-and-research/gemini-models/introducing-gemini-4-argon/'],
            ['title' => 'Google AI for Developers — ficha do modelo', 'url' => 'https://ai.google.dev/gemini-api/docs/latest-model'],
            ['title' => 'Google Cloud — a mesma abertura', 'url' => 'https://cloud.google.com/blog/products/ai-machine-learning/gemini-4-argon-available-on-google-cloud'],
        ],
        'body' => <<<'TXT'
Em 13 de outubro de 2026, o Google abriu o Gemini 4 Argon. O identificador da API é gemini-4-argon. O preço de lançamento vale até 30 de novembro de 2026: 2 dólares por milhão de tokens de entrada, 10 dólares na saída, reflexão incluída. A partir de 1º de dezembro, as tarifas passam a 4 e 20. Os tokens de entrada já vistos custam 95 % menos: 0,10 dólar, depois 0,20. O modelo não está na oferta gratuita.

## O que o Google diz

A janela tem 1.048.576 tokens, divididos entre a entrada, a reflexão e a saída. O nível de reflexão padrão é médio. Dá para baixar ou subir. O Google diz que o Argon é o primeiro no índice Vals, que cobre finanças, código, direito e tributos. É a medida dele.

O texto de 13 de outubro abre a API no AI Studio, o Antigravity para assinantes Ultra, e o aplicativo Gemini para assinantes Pro e Ultra. A documentação de desenvolvedor, datada de 16 de outubro, confirma o preço, a janela e a ausência de oferta gratuita. O cache pedido à mão não é aceito. O cache automático é, a partir de um certo volume.

## O que não se faz com ele

O preço dobra em 1º de dezembro. Um teste na tarifa de lançamento não diz a conta de janeiro. O Google também conta trabalhos internos, com os números dele. A saída é cobrada, reflexão incluída. O modelo não relê o trabalho no seu lugar.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'developpement',
        'slug' => 'um-arquivo-fixa-as-actions',
        'title' => 'Um arquivo guarda a versão exata das ferramentas do GitHub',
        'summary' => 'Em 14 de outubro de 2026, o GitHub mostrou um arquivo que guarda a versão das ferramentas executadas sozinhas. O teste é para contas Enterprise Cloud. Guardar a versão não prova que a ferramenta seja confiável.',
        'cover' => '/blog/actions-lock.svg',
        'translation_key' => 'actions-lock',
        'published_at' => '2026-10-18 22:00:00',
        'sources' => [
            ['title' => 'GitHub Changelog — a prévia de 14 de outubro', 'url' => 'https://github.blog/changelog/2026-10-14-github-actions-workflow-lockfiles-in-public-preview/'],
            ['title' => 'GitHub Docs — travar as dependências', 'url' => 'https://docs.github.com/en/actions/how-tos/secure-your-work/lock-workflow-dependencies'],
            ['title' => 'GitHub — repositório gh-actions-lock', 'url' => 'https://github.com/github/gh-actions-lock'],
        ],
        'body' => <<<'TXT'
Em 14 de outubro de 2026, o GitHub abriu uma prévia pública dos arquivos de travamento para o GitHub Actions. Uma etiqueta ou um ramo pode se mover depois da revisão. O arquivo guarda o commit registrado, e o Actions executa esse commit, mesmo que a etiqueta tenha se movido desde então.

A prévia é anunciada para o GitHub Enterprise Cloud, inclusive com residência de dados. O registro não a abre para os planos Team e Free. A extensão se chama actions-lock. O arquivo produzido é .github/workflows/actions.lock. Dá para inscrever só um workflow. Uma vez inscrito, cada dependência, inclusive as que ele puxa, precisa de uma linha.

Travar não diz que a dependência é sadia. O GitHub diz isso: revise antes de fixar. O Dependabot, quando propõe uma atualização de uma action já inscrita, regenera a linha no mesmo pedido. Um administrador de empresa, de organização ou de repositório pode exigir o arquivo. A extensão está antes da versão 1.0, e o formato ainda pode mudar.

É útil quando os workflows já rodam no Enterprise Cloud e o risco visado é uma etiqueta que se move. Nos outros planos, a prévia não foi anunciada. Não é uma verificação do conteúdo das actions.
TXT,
    ],
];
