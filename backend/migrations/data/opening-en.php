<?php

declare(strict_types=1);

return [
    [
        'locale' => 'en',
        'category' => 'developpement',
        'slug' => 'python-310-end-of-security-fixes',
        'title' => 'Python 3.10 will get no further security fix',
        'summary' => 'On 1 October 2026, Python 3.10.22 became the last release of that line. No security fix will follow. Four other lines were updated the same day.',
        'cover' => '/blog/python-310.svg',
        'translation_key' => 'python-310',
        'published_at' => '2026-10-04 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — the 1 October 2026 releases', 'url' => 'https://blog.python.org/2026/10/python-31022-31117/'],
            ['title' => 'Linux Compatible — Python 3.10 reaches the end', 'url' => 'https://www.linuxcompatible.org/story/python-31022-31117-31215-31316-and-3148-ship-as-310-hits-end-of-life/'],
            ['title' => 'endoflife.ai — Python 3.10 end date', 'url' => 'https://endoflife.ai/python/3.10'],
        ],
        'body' => <<<'TXT'
On 1 October 2026, the Python 3.10 line stopped. Release 3.10.22 is the last one. It still carries security fixes, and then nothing follows: that line will not be patched again. The software keeps running. Nobody repairs it after that.

Five years have passed since the first 3.10, in October 2021. The date was planned. It is not a surprise cutoff. From here, staying on 3.10 is a choice: a flaw found later stays open on that line.

## The other lines, the same day

The same announcement published four other numbers: 3.11.17, 3.12.15, 3.13.16 and 3.14.8. They are maintenance updates. They do not change the language. They carry fixes.

3.14 is the newest feature line. 3.10 will not move again. Linux Compatible reported the announcement the same day: one publication, five numbers, and the official end of 3.10. Python Insider is the original post, on the project blog. endoflife.ai, which tracks support dates, marks 1 October 2026 and names 3.10.22 as the last release.

## No installer for this last number

3.10.22 ships as source code only. There is no Windows or macOS installer for this last number. Someone looking for a ready-to-run file of 3.10.22 will not find one: it was not built.

That does not change the point. Even with an installer, this version would get no further fix.

## What “no further fix” means

A flaw found after 1 October 2026 can be repaired on a line that is still supported. It will not be repaired in 3.10. On a personal machine the risk is sometimes small. On a public service, an image that still starts 3.10, or a forgotten server, the next flaw stays open on that line.

Libraries also end up requiring a newer version. The cheaper moment to move is before something breaks, not the day a tool refuses to install.

## What replaces it

There is no magic number. There is a line that still receives fixes, tried with the project. Libraries, hosting and the tools around it have to follow. A separate environment per project avoids breaking the rest of the machine when the global version changes.

The useful step is to find where 3.10 still runs, then pick the line that replaces it. Waiting for the next security notice about 3.10 does nothing. There will not be one.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'devops',
        'slug' => 'kubernetes-137-old-options',
        'title' => 'Kubernetes 1.37 rejects the old options',
        'summary' => 'Kubernetes 1.37, named Garhwal, shipped on 26 August 2026. Eighteen old options stop a node from starting. They have to be removed before the upgrade.',
        'cover' => '/blog/kube-137.svg',
        'translation_key' => 'kube-137',
        'published_at' => '2026-10-04 19:00:00',
        'sources' => [
            ['title' => 'Kubernetes — the 1.37 Garhwal announcement', 'url' => 'https://kubernetes.io/blog/2026/08/26/kubernetes-v1-37-release/'],
            ['title' => 'Saaro — removed options, scale down to zero', 'url' => 'https://blog.saaro.net/en/kubernetes-1-37-garhwal-hpa-scale-to-zero-gang-scheduling-un'],
            ['title' => 'Indra Gusti Prasetya — the eighteen options and startup', 'url' => 'https://indragustiprasetya.com/blog/kubernetes-1-37-drops-18-kubelet-flags-nodes-never-join.html'],
        ],
        'body' => <<<'TXT'
Kubernetes 1.37 is named Garhwal. It shipped on 26 August 2026. The project blog announces 67 changes: some become stable, others enter trial. What this week’s write-ups focus on, in early October, is more concrete. A node can refuse to start if old options are still written in its configuration.

## Eighteen options the node refuses

The program that runs containers on each machine changed the piece that used to supply older measurements. With that change, eighteen options are no longer accepted. If one of them remains in the configuration, the node stops while starting. The message talks about an unknown option.

Two names come back in both independent write-ups: --containerd and --containerd-namespace. They no longer control anything. They block startup. Other options from the same list, tied to old logs and old measurement storage, do the same. One option from that family stays: --housekeeping-interval.

Saaro, on 1 October, and Indra Gusti Prasetya, on 25 September, describe the same point on two different sites. Those options have to be removed before the upgrade. They sometimes hide in an arguments file prepared automatically, or in the machine’s service definition. After the move to 1.37, the machine does not rejoin the cluster while that line is still there. The official Kubernetes blog sets the version and its date. The two October articles say what to check before installing it.

## Scaling a service down to zero

Saaro’s piece keeps another change. Automatic adjustment of the number of copies can reduce a service all the way to zero. When nothing is calling it, the copies can disappear, then come back. That is not the old behavior, which kept at least one.

It is a choice of cost and delay. A service that starts from zero takes a little longer to answer the first call. A service that must always answer immediately should not go that low. The decision is per service.

## Before the upgrade

The work is a reread. Find the removed options. Take them out. Try this on a machine that does not carry traffic, and check that it starts, before touching the others. The full list of eighteen names is in the two articles cited and in the project changelog. That list wins over memory.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'cybersecurite',
        'slug' => 'netscaler-october-4-patch',
        'title' => 'NetScaler: install the 4 October patch',
        'summary' => 'On 4 October 2026, Citrix published an emergency patch for NetScaler. The vendor reports outages already seen on unpatched installs. The version number in the bulletin is the one that counts.',
        'cover' => '/blog/netscaler.svg',
        'translation_key' => 'netscaler-4-oct',
        'published_at' => '2026-10-04 21:00:00',
        'sources' => [
            ['title' => 'BleepingComputer — the 4 October NetScaler patch', 'url' => 'https://www.bleepingcomputer.com/news/security/citrix-patches-netscaler-saml-zero-day-exploited-in-attacks/'],
            ['title' => 'Citrix — bulletin of 4 October 2026', 'url' => 'https://support.citrix.com/external/article/CTX697174/citrix-netscaler-adc-and-citrix-netscale.html'],
            ['title' => 'SecurityOnline — the same patch, the same day', 'url' => 'https://securityonline.info/citrix-netscaler-cve-2026-88779-exploited/'],
        ],
        'body' => <<<'TXT'
On Sunday 4 October 2026, Citrix published an emergency patch for NetScaler ADC and NetScaler Gateway. The bulletin is numbered CVE-2026-88779. Citrix describes it as an outage: the appliance can stop answering. The score given by the vendor is 8.7. Citrix writes that targeted attacks have already hit installs that did not have the patch.

BleepingComputer and SecurityOnline reported the publication the same day, each on its own site. The US catalog of flaws already being used, kept by CISA, added this number the same Sunday. For the federal agencies concerned, the stated deadline is 7 October. The bulletin to follow is still Citrix’s: that is the page with the version numbers.

## What the articles do not settle

Several write-ups say researchers are looking at whether the effect stops at the outage, or goes further. That is not what the bulletin establishes. The bulletin talks about a service going down. Until the vendor says otherwise, that is the fact to keep.

This text does not describe how the problem is triggered. The useful action is to install the fixed version, then check the number on screen.

## The versions that fix it

Citrix asks you to reach, depending on the line already in place:

- 14.1-73.41, or a later release of the 14.1 line
- 13.1-64.28, or a later release of the 13.1 line

FIPS and NDcPP editions have their own numbers in the official bulletin. A version that is “recent enough” is not enough. It has to be these numbers, or newer.

## A second update

In late September, other emergency patches had already been published for the same appliances. Citrix warns that installs updated then still need another update when they are covered by the 4 October bulletin. The September patch does not cover Sunday’s.

For a company’s remote access, the step is to apply the vendor bulletin, then check that the version number is the one that fixes it. The US catalog deadline is a reminder of urgency. It does not replace Citrix’s page.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'ia',
        'slug' => 'models-that-choose',
        'title' => 'Models that choose instead of writing',
        'summary' => 'On 1 October 2026, Cloudflare and AWS published models that do not write. They return a choice among answers that were already allowed, with a probability.',
        'cover' => '/blog/decision.svg',
        'translation_key' => 'decision-models',
        'published_at' => '2026-10-04 18:00:00',
        'sources' => [
            ['title' => 'Cloudflare Blog — the Clef announcement', 'url' => 'https://blog.cloudflare.com/clef-decision-models/'],
            ['title' => 'TechCrunch — models that sort options', 'url' => 'https://techcrunch.com/2026/10/01/amazon-releases-its-own-jev-clone-as-decision-models-flood-the-web/'],
            ['title' => 'beri.net — Clef and Strands Decider, the same day', 'url' => 'https://www.beri.net/article/cloudflare-clef-amazon-strands-decider-open-weight-decision-models-vs-jev-benchmarks-pricing'],
        ],
        'body' => <<<'TXT'
On 1 October 2026, two teams published models that do not write. You give them a situation and the answers that are allowed. They return a choice, with a probability. Not a paragraph to reread, not a sentence to split apart.

That is a different job from the models that write. Writing explains, summarizes, proposes. Choosing connects the next step: send a file to a team, accept or refuse a request, pick one tool rather than another. The result fits in a box.

## Clef, from Cloudflare

Cloudflare introduced Clef and Clef-flash. The first is the larger of the two. The second is meant to answer faster. Both are offered on the Workers AI service. The weights are published under the Apache 2.0 license: they can be reused and run somewhere else.

The Cloudflare blog describes how it works. The model reads the situation and closed questions, then gives a probability for each allowed answer. There is no free text to interpret. TechCrunch, the same day, places this release among models built to sort options that were already set, rather than to produce a long text. beri.net puts the two announcements side by side, on a third site.

## Strands Decider, from AWS

The same 1 October, an AWS lab published Strands Decider. TechCrunch describes it as an open model, small enough to run on a local machine, used to sort options that were already decided and to say how sure the choice is. It does not write a free answer. beri.net adds that the weights, the training data and the scripts were published: you can read how it was built, not only use it as a closed box.

The two announcements are not copies. Clef is first a service, with reusable weights. Decider is small and meant to stay near the machine that uses it. Both refuse free text.

## What changes in a tool

In a business tool, a step where “the model decides” is easier to check when the possible answers are written in advance. You can verify that the output is one of the expected boxes. You do not reread a paragraph that invented a third path.

This does not replace a model that has to draft a note or answer a client. It replaces the places where a large model is asked to choose, and then hoped to answer in the right format. Here the format is imposed. The choice still needs a human look when the decision has a cost: the model states a probability, it does not sign in someone’s place.
TXT,
    ],
];
