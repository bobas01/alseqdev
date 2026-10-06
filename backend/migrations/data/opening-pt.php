<?php

declare(strict_types=1);

return [
    [
        'locale' => 'pt-br',
        'category' => 'developpement',
        'slug' => 'python-310-fim-das-correcoes',
        'title' => 'Python 3.10 não recebe mais correção',
        'summary' => 'Em 1º de outubro de 2026, Python 3.10.22 virou a última versão dessa linha. Não haverá mais correção de segurança. Quatro outras linhas foram atualizadas no mesmo dia.',
        'cover' => '/blog/python-310.svg',
        'translation_key' => 'python-310',
        'published_at' => '2026-10-04 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — as versões de 1º de outubro de 2026', 'url' => 'https://blog.python.org/2026/10/python-31022-31117/'],
            ['title' => 'Linux Compatible — fim do Python 3.10', 'url' => 'https://www.linuxcompatible.org/story/python-31022-31117-31215-31316-and-3148-ship-as-310-hits-end-of-life/'],
            ['title' => 'endoflife.ai — data de fim do Python 3.10', 'url' => 'https://endoflife.ai/python/3.10'],
        ],
        'body' => <<<'TXT'
Em 1º de outubro de 2026, a linha Python 3.10 parou. A versão 3.10.22 é a última. Ela ainda corrige falhas, e depois não vem mais nada: essa linha não recebe outra atualização de segurança. O programa continua rodando. Ninguém o conserta depois disso.

Já se passaram cinco anos desde a primeira 3.10, em outubro de 2021. A data estava prevista. Não é um corte de surpresa. A partir daqui, ficar no 3.10 é uma escolha: uma falha descoberta mais tarde continua aberta nessa linha.

## No mesmo dia, as outras linhas

O mesmo anúncio publicou quatro outros números: 3.11.17, 3.12.15, 3.13.16 e 3.14.8. São atualizações de manutenção. Não mudam a linguagem. Trazem correções.

A 3.14 é a linha de recursos mais recente. A 3.10 não anda mais. O Linux Compatible retomou o anúncio no mesmo dia: uma publicação, cinco números, e o fim oficial da 3.10. O Python Insider é o texto de origem, no blog do projeto. O endoflife.ai, que acompanha datas de fim de suporte, marca 1º de outubro de 2026 e cita a 3.10.22 como última publicação.

## Sem instalador para este último número

A 3.10.22 sai só como código-fonte. Não há instalador de Windows nem de macOS para este último número. Quem procura um arquivo pronto da 3.10.22 não encontra: ele não foi construído.

Isso não muda o essencial. Mesmo com instalador, esta versão não receberia mais correção.

## O que “sem correção” quer dizer

Uma falha encontrada depois de 1º de outubro de 2026 pode ser reparada numa linha que ainda é acompanhada. Não será reparada na 3.10. Num computador pessoal, o risco às vezes é pequeno. Num serviço no ar, numa imagem que ainda inicia a 3.10, ou num servidor esquecido, a falha seguinte fica aberta nessa linha.

As bibliotecas também passam a exigir uma versão mais nova. O momento mais barato para mudar é antes de algo quebrar, não no dia em que uma ferramenta recusa instalar.

## O que colocar no lugar

Não existe um número mágico. Existe uma linha que ainda recebe correções, experimentada com o projeto. Bibliotecas, hospedagem e as ferramentas em volta precisam acompanhar. Um ambiente separado por projeto evita quebrar o resto da máquina ao mudar a versão geral.

O que vale a pena é achar onde a 3.10 ainda roda, e escolher a linha que a substitui. Esperar o próximo aviso de segurança da 3.10 não serve. Não haverá outro.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'devops',
        'slug' => 'kubernetes-137-opcoes-antigas',
        'title' => 'Kubernetes 1.37 recusa as opções antigas',
        'summary' => 'Kubernetes 1.37, chamado Garhwal, saiu em 26 de agosto de 2026. Dezoito opções antigas impedem um nó de iniciar. É preciso retirá-las antes da atualização.',
        'cover' => '/blog/kube-137.svg',
        'translation_key' => 'kube-137',
        'published_at' => '2026-10-04 19:00:00',
        'sources' => [
            ['title' => 'Kubernetes — anúncio da versão 1.37 Garhwal', 'url' => 'https://kubernetes.io/blog/2026/08/26/kubernetes-v1-37-release/'],
            ['title' => 'Saaro — opções retiradas e escala até zero', 'url' => 'https://blog.saaro.net/en/kubernetes-1-37-garhwal-hpa-scale-to-zero-gang-scheduling-un'],
            ['title' => 'Indra Gusti Prasetya — as dezoito opções e o início', 'url' => 'https://indragustiprasetya.com/blog/kubernetes-1-37-drops-18-kubelet-flags-nodes-never-join.html'],
        ],
        'body' => <<<'TXT'
Kubernetes 1.37 leva o nome Garhwal. A versão saiu em 26 de agosto de 2026. O blog do projeto anuncia 67 mudanças: uma parte fica estável, outra entra em teste. O que as leituras desta semana, no começo de outubro, tratam é mais concreto. Um nó pode recusar iniciar se opções antigas ainda estiverem escritas na configuração.

## Dezoito opções que o nó recusa

O programa que roda os contêineres em cada máquina trocou a peça que fornecia medições antigas. Com essa troca, dezoito opções deixam de ser aceitas. Se uma delas continua na configuração, o nó para ao iniciar. A mensagem fala de uma opção desconhecida.

Dois nomes se repetem nos dois relatos independentes: --containerd e --containerd-namespace. Eles não comandam mais nada. Eles bloqueiam o início. Outras opções da mesma lista, ligadas a registros antigos e a armazenamentos antigos de medições, fazem o mesmo efeito. Uma só opção dessa família permanece: --housekeeping-interval.

Saaro, em 1º de outubro, e Indra Gusti Prasetya, em 25 de setembro, descrevem o mesmo ponto em dois sites diferentes. É preciso retirar essas opções antes da atualização. Elas às vezes se escondem num arquivo de argumentos preparado sozinho, ou na definição do serviço da máquina. Depois da passagem para 1.37, a máquina não volta ao cluster enquanto a linha estiver lá. O blog oficial do Kubernetes fixa a versão e a data. Os dois artigos de outubro dizem o que conferir antes de instalar.

## Descer um serviço até zero

O texto do Saaro guarda outra mudança. O ajuste automático do número de cópias pode reduzir um serviço até zero. Quando não há chamada, as cópias podem sumir e depois voltar. Não é o comportamento antigo, em que restava pelo menos uma.

É uma escolha de custo e de espera. Um serviço que parte de zero demora um pouco mais para responder à primeira chamada. Um serviço que precisa responder sempre na hora não vale a pena descer tanto. Isso se decide serviço por serviço.

## Antes da atualização

O trabalho é uma revisão. Achar as opções retiradas. Tirá-las. Experimentar numa máquina que não carrega o tráfego, e ver se ela inicia, antes de mexer nas outras. A lista completa dos dezoito nomes está nos dois artigos citados e no registro de mudanças do projeto. Essa lista vale mais do que a memória.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'cybersecurite',
        'slug' => 'netscaler-correcao-4-de-outubro',
        'title' => 'NetScaler: instalar a correção de 4 de outubro',
        'summary' => 'Em 4 de outubro de 2026, a Citrix publicou uma correção de emergência para o NetScaler. A empresa fala de indisponibilidade já vista em instalações sem a correção. Vale o número de versão do boletim.',
        'cover' => '/blog/netscaler.svg',
        'translation_key' => 'netscaler-4-oct',
        'published_at' => '2026-10-04 21:00:00',
        'sources' => [
            ['title' => 'BleepingComputer — correção NetScaler de 4 de outubro', 'url' => 'https://www.bleepingcomputer.com/news/security/citrix-patches-netscaler-saml-zero-day-exploited-in-attacks/'],
            ['title' => 'Citrix — boletim de 4 de outubro de 2026', 'url' => 'https://support.citrix.com/external/article/CTX697174/citrix-netscaler-adc-and-citrix-netscale.html'],
            ['title' => 'SecurityOnline — a mesma correção, no mesmo dia', 'url' => 'https://securityonline.info/citrix-netscaler-cve-2026-88779-exploited/'],
        ],
        'body' => <<<'TXT'
No domingo 4 de outubro de 2026, a Citrix publicou uma correção de emergência para NetScaler ADC e NetScaler Gateway. O boletim leva o número CVE-2026-88779. A Citrix descreve uma indisponibilidade: o equipamento pode deixar de responder. A nota indicada pela empresa é 8,7. A Citrix escreve que ataques dirigidos já atingiram instalações que não tinham a correção.

BleepingComputer e SecurityOnline relataram a publicação no mesmo dia, cada um no seu site. O catálogo americano de falhas já usadas, mantido pela CISA, acrescentou esse número no mesmo domingo. Para os órgãos federais envolvidos, a data limite indicada é 7 de outubro. O boletim a seguir continua sendo o da Citrix: é ele que traz os números de versão.

## O que os artigos não decidem

Vários textos dizem que pesquisadores olham se o efeito para na indisponibilidade ou se vai além. Não é o que o boletim estabelece. O boletim fala de um serviço que cai. Enquanto a empresa não disser outra coisa, é isso que fica.

Este texto não descreve como o problema é provocado. A única ação útil é instalar a versão corrigida e conferir o número que aparece.

## As versões que corrigem

A Citrix pede para alcançar, conforme a linha já em uso:

- 14.1-73.41, ou uma versão mais recente da linha 14.1
- 13.1-64.28, ou uma versão mais recente da linha 13.1

As edições FIPS e NDcPP têm os próprios números no boletim oficial. Uma versão “recente o bastante” não basta. São esses números, ou mais novos.

## Uma segunda atualização

No fim de setembro, outras correções de emergência já tinham saído para os mesmos equipamentos. A Citrix avisa que as instalações atualizadas naquela hora precisam de outra atualização, quando entram no boletim de 4 de outubro. A correção de setembro não cobre a de domingo.

Para um acesso remoto de empresa, o passo é aplicar o boletim do fabricante e conferir se o número da versão é o que corrige. O prazo do catálogo americano lembra a pressa. Ele não substitui a página da Citrix.
TXT,
    ],
    [
        'locale' => 'pt-br',
        'category' => 'ia',
        'slug' => 'modelos-que-escolhem',
        'title' => 'Modelos que escolhem em vez de escrever',
        'summary' => 'Em 1º de outubro de 2026, Cloudflare e AWS publicaram modelos que não escrevem. Eles devolvem uma escolha entre respostas já autorizadas, com uma probabilidade.',
        'cover' => '/blog/decision.svg',
        'translation_key' => 'decision-models',
        'published_at' => '2026-10-04 18:00:00',
        'sources' => [
            ['title' => 'Cloudflare Blog — anúncio do Clef', 'url' => 'https://blog.cloudflare.com/clef-decision-models/'],
            ['title' => 'TechCrunch — modelos que separam opções', 'url' => 'https://techcrunch.com/2026/10/01/amazon-releases-its-own-jev-clone-as-decision-models-flood-the-web/'],
            ['title' => 'beri.net — Clef e Strands Decider, no mesmo dia', 'url' => 'https://www.beri.net/article/cloudflare-clef-amazon-strands-decider-open-weight-decision-models-vs-jev-benchmarks-pricing'],
        ],
        'body' => <<<'TXT'
Em 1º de outubro de 2026, duas equipes publicaram modelos que não escrevem. A gente passa a situação e as respostas autorizadas. Eles devolvem uma escolha, com uma probabilidade. Não um parágrafo para reler, nem uma frase para cortar.

É outra tarefa, diferente da dos modelos que escrevem. Escrever serve para explicar, resumir, propor. Escolher serve para ligar o passo seguinte: mandar um processo para uma equipe, aceitar ou recusar um pedido, pegar uma ferramenta em vez de outra. O resultado cabe num campo.

## Clef, na Cloudflare

A Cloudflare apresentou Clef e Clef-flash. O primeiro é o maior dos dois. O segundo foi feito para responder mais rápido. Os dois são oferecidos no serviço Workers AI. Os pesos saem sob a licença Apache 2.0: dá para reutilizá-los e rodá-los em outro lugar.

O blog da Cloudflare descreve o funcionamento. O modelo lê a situação e perguntas fechadas, depois dá uma probabilidade para cada resposta permitida. Não há texto livre para interpretar. A TechCrunch, no mesmo dia, coloca essa publicação entre modelos feitos para separar opções já definidas, em vez de produzir um texto longo. O beri.net põe os dois anúncios lado a lado, num terceiro site.

## Strands Decider, na AWS

No mesmo 1º de outubro, um laboratório da AWS publicou o Strands Decider. A TechCrunch o descreve como um modelo aberto, pequeno o bastante para rodar numa máquina local, usado para separar opções já decididas e dizer o quanto a escolha é segura. Ele não escreve uma resposta livre. O beri.net acrescenta que os pesos, os dados de treino e os scripts foram publicados: dá para ler como ele foi construído, não só usá-lo como uma caixa fechada.

Os dois anúncios não se copiam. O Clef é primeiro um serviço, com pesos reutilizáveis. O Decider é pequeno e feito para ficar perto da máquina que o usa. Os dois recusam o texto livre.

## O que isso muda numa ferramenta

Numa ferramenta de trabalho, um passo em que “o modelo decide” fica mais simples de controlar quando as respostas possíveis estão escritas antes. Dá para verificar se a saída é uma das respostas previstas. Não se relê um parágrafo que teria inventado um terceiro caminho.

Isso não substitui um modelo que precisa escrever uma nota ou responder a um cliente. Substitui os lugares em que se pede a um modelo grande para escolher, e depois se espera que ele tenha respondido no formato certo. Aqui o formato é imposto. A escolha continua para ser lida quando a decisão tem um custo: o modelo indica uma probabilidade, não assina no lugar da pessoa.
TXT,
    ],
];
