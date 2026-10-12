<?php

declare(strict_types=1);

return [
    [
        'locale' => 'pt-br',
        'category' => 'developpement',
        'slug' => 'python-315-saiu',
        'title' => 'Python 3.15 saiu',
        'summary' => 'Em 9 de outubro de 2026, Python 3.15.0 virou a versão estável. É a linha de recursos que vem depois da 3.14. O projeto conta 5.643 mudanças, de 1.012 pessoas.',
        'cover' => '/blog/python-315.svg',
        'translation_key' => 'python-315',
        'published_at' => '2026-10-12 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — Python 3.15.0', 'url' => 'https://blog.python.org/2026/10/python-3150-final-is-here/'],
            ['title' => 'Phoronix — o lançamento do Python 3.15', 'url' => 'https://www.phoronix.com/news/Python-3.15-Released'],
            ['title' => 'LWN — Python 3.15 released', 'url' => 'https://lwn.net/Articles/1099602/'],
        ],
        'body' => <<<'TXT'
Em 9 de outubro de 2026, Python 3.15.0 virou a versão estável. É a linha de recursos que vem depois da 3.14. O anúncio do projeto conta 5.643 mudanças, de 1.012 pessoas.

## O que muda na linguagem

Três acréscimos aparecem no anúncio e nas duas retomadas do dia. frozendict é um dicionário que não se altera depois de criado. sentinel é um valor feito para dizer « nada em especial », no lugar de um improviso. A codificação padrão passa a ser UTF-8. Os imports podem ser declarados preguiçosos, para um script começar antes de carregar tudo.

O compilador na hora continua experimental. O projeto dá dois números: cerca de 7 a 8 % mais rápido, em média geométrica, no Linux x86-64 em relação ao interpretador usual, e cerca de 11 a 12 % no macOS ARM em relação ao interpretador de chamadas finais. O Phoronix repete as duas faixas. O LWN fica com o mesmo conjunto: os dois tipos novos, UTF-8, os arquivos de arranque dos pacotes, e esse compilador.

## Os instaladores

Os binários oficiais de Windows 64 bits passam a usar o interpretador de chamadas finais. O instalador oficial de macOS também instala, por padrão, uma segunda cópia capaz de rodar sem o travamento global. Dá para desmarcar na instalação. Pacotes de terceiros que não estão prontos para esse modo religam o travamento.

Não é motivo para trocar tudo no mesmo dia. A 3.15 é a linha nova. Um aplicativo em produção fica numa linha já provada com as bibliotecas, e a 3.15 se testa à parte.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'devops',
        'slug' => 'github-actions-5-de-outubro',
        'title' => 'GitHub Actions travou em 5 de outubro',
        'summary' => 'Em 5 de outubro de 2026, o GitHub Actions e as máquinas que ele empresta ficaram lentos por quatro horas. No pico, 47 % dos fluxos nessas máquinas falharam. Máquinas hospedadas por conta própria não foram atingidas.',
        'cover' => '/blog/github-actions.svg',
        'translation_key' => 'github-actions-5-oct',
        'published_at' => '2026-10-12 19:00:00',
        'sources' => [
            ['title' => 'GitHub Status — incidente do Actions em 5 de outubro de 2026', 'url' => 'https://www.githubstatus.com/'],
            ['title' => 'Automater — os números do pico', 'url' => 'https://automater.ai/news/github-actions-hosted-runners-october-5-2026-outage/'],
        ],
        'body' => <<<'TXT'
Em 5 de outubro de 2026, entre 18h48 e 22h49 UTC (15h48 às 19h49, horário de Brasília), o GitHub Actions e as máquinas que ele empresta ficaram lentos. O GitHub diz isso na página de status. No pico, por cerca de uma hora e meia, 47 % dos fluxos nessas máquinas falharam, e 71,9 % das tarefas não começaram em cinco minutos. No período inteiro, 14,3 % dos fluxos e 26,5 % das tarefas perderam esse prazo de cinco minutos.

Sites já publicados no GitHub Pages continuaram no ar. Máquinas hospedadas por conta própria não foram atingidas. Parte das contas também viu erros na lista de repositórios, nas páginas de licença e de cobrança, e em algumas funções do Copilot.

## A causa que o GitHub dá

O GitHub descreve um corte parcial de rede entre uma região dos centros dele e parte das bases e dos armazenamentos hospedados na nuvem. O serviço voltou ao mover esse tráfego para regiões saudáveis e ao acrescentar capacidade. O Actions tinha voltado às 21h54 UTC. O conjunto dos serviços citados, às 22h49 UTC. A análise detalhada ainda está prometida.

A Automater repetiu os mesmos números, em outro site, a partir desse relato.

## O que fazer com isso

Um fluxo vermelho nessa noite pode vir da plataforma. Comparar com a página de status evita procurar um bug que não está no projeto. Uma máquina própria continuou. Não é motivo para mudar tudo de lugar. É motivo para não tomar uma falha isolada, nessa faixa de horário, como uma regressão do código.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'cybersecurite',
        'slug' => 'wordpress-713-para-instalar',
        'title' => 'WordPress 7.1.3 está para instalar',
        'summary' => 'Em 6 de outubro de 2026, o WordPress publicou a versão 7.1.3. O anúncio fala de sete correções de segurança e de quatro ajustes. O projeto pede para atualizar na hora.',
        'cover' => '/blog/wordpress-713.svg',
        'translation_key' => 'wordpress-713',
        'published_at' => '2026-10-12 21:00:00',
        'sources' => [
            ['title' => 'WordPress News — versão 7.1.3', 'url' => 'https://wordpress.org/news/2026/10/wordpress-7-1-3-maintenance-and-security-release/'],
            ['title' => 'Patchstack — a mesma publicação', 'url' => 'https://patchstack.com/articles/wordpress-7-1-3-security-release/'],
            ['title' => 'Search Engine Journal — sete correções', 'url' => 'https://www.searchenginejournal.com/wordpress-7-1-3-fixes-7-vulnerabilities-and-1-critical-flaw/592109/'],
        ],
        'body' => <<<'TXT'
Em 6 de outubro de 2026, o WordPress publicou a versão 7.1.3. O anúncio oficial fala de sete correções de segurança e de quatro correções de bugs. O projeto pede para atualizar na hora, pelo painel, ou esperar a atualização automática se o site a tiver ligada.

## O que as correções cobrem

O texto do WordPress descreve os efeitos, sem modo de usar. Um comentário à espera pode deixar um script na página de administração dos comentários. A exportação do site pode ser abusada até a base. Uma pessoa sem login pode ler comentários de um artigo privado ou não publicado. Um autor pode fixar um artigo além do papel dele. Um conteúdo do Imgur embutido pode carregar um script. Dois outros pontos endurecem casos mais internos.

Patchstack e Search Engine Journal retomaram a publicação no mesmo dia: mesma data, sete correções, o mesmo conselho de atualizar. Este texto não repete o gatilho de cada uma. A versão a alcançar é a 7.1.3, ou a atualização de segurança da linha que ainda é acompanhada.

## As linhas antigas

O WordPress diz que as correções também estão sendo preparadas para as linhas ainda elegíveis, até a 4.7, e que saem conforme ficam prontas. Só a última versão é acompanhada de fato. Um site deixado numa linha velha espera um porte que talvez ainda não exista.

O que vale a pena é ler o número no painel e passar para a 7.1.3 se o site está na 7.1. Sites com atualização automática pegam sozinhos. Os outros esperam um clique.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'ia',
        'slug' => 'chatgpt-marca-na-europa',
        'title' => 'O ChatGPT vai marcar os textos na Europa',
        'summary' => 'Em 5 de outubro de 2026, a OpenAI anunciou uma marca invisível nos textos elegíveis do ChatGPT e do Codex na União Europeia. O detector não é público. A falta da marca não prova que uma pessoa escreveu o texto.',
        'cover' => '/blog/chatgpt-eu.svg',
        'translation_key' => 'chatgpt-marque-ue',
        'published_at' => '2026-10-12 18:00:00',
        'sources' => [
            ['title' => 'OpenAI — marcação de textos para a União Europeia', 'url' => 'https://openai.com/index/eu-text-provenance'],
            ['title' => 'The Hindu — o mesmo anúncio, em 6 de outubro', 'url' => 'https://www.thehindu.com/business/openai-to-watermark-chatgpt-text-in-eu-under-ai-act-rules/article71551205.ece'],
            ['title' => 'Agence Europe — marca invisível, detector reservado', 'url' => 'https://agenceurope.eu/en/bulletin/article/13953/29/openai-announces-watermark-for-texts-generated-by-its-tools-in-eu'],
        ],
        'body' => <<<'TXT'
Em 5 de outubro de 2026, a OpenAI explicou como pretende tornar reconhecíveis os textos produzidos pelas ferramentas dela, para o regulamento europeu de IA. Nas próximas semanas, uma marca invisível será acrescentada aos textos elegíveis do ChatGPT e do Codex, para usuários na União Europeia, em todos os planos. Não fica ligada para o resto do mundo neste lançamento.

No mesmo dia, clientes da API, em qualquer lugar, podem pedir essa marca para alguns modelos. Ela fica desligada até alguém ativar. O detector não é público: a OpenAI abre pedidos, primeiro para pesquisadores e organizações que ela aceitar.

## O que a marca diz

A OpenAI chama isso de textGrain. É um sinal estatístico na escolha das palavras, não caracteres escondidos. O detector procura esse sinal. The Hindu e a Agence Europe descrevem a mesma coisa, em 6 de outubro: uma marca invisível, limitada à Europa para o ChatGPT, um detector reservado, e limites assumidos.

A OpenAI dá as próprias medidas, retomadas pelo The Hindu. Em textos de psicologia, com uma taxa visada de um alarme falso em cem, o detector acha a marca em cerca de 80 % das passagens de 200 tokens, e cerca de 95 % das de 400. Em matemática, onde as palavras são mais presas, a detecção cai. Trocar 10 % das palavras por sinônimos derruba uma detecção de cerca de 92 % para 66 %. Com 25 % das palavras trocadas, cai para cerca de 17 %.

## O que ela não diz

A OpenAI escreve, e a Agence Europe guarda: a marca não mede a parte humana. Não diz de quem é o texto, quem pediu, nem se o texto está certo. A falta da marca não prova que uma pessoa escreveu. A passagem pode ser curta demais, editada, traduzida, ou vir de outra ferramenta.

Para um site, o ponto útil está aí. Um texto colado do ChatGPT na Europa pode carregar essa marca. A marca não substitui uma leitura, e não serve de prova.
TXT,
    ],
];
