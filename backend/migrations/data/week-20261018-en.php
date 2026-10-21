<?php

declare(strict_types=1);

return [
    [
        'locale' => 'en',
        'category' => 'developpement',
        'slug' => 'postgresql-19-first-candidate',
        'title' => 'PostgreSQL 19 is close to the final release',
        'summary' => 'On 15 October 2026, a near-final trial version shipped. The stable release is planned for 19 November, after a second trial on 12 November.',
        'cover' => '/blog/postgresql-19.svg',
        'translation_key' => 'postgresql-19',
        'published_at' => '2026-10-18 20:00:00',
        'sources' => [
            ['title' => 'PostgreSQL — 19 RC 1', 'url' => 'https://www.postgresql.org/about/news/postgresql-19-rc-1-released-3409/'],
            ['title' => 'PostgreSQL — version 19 release notes', 'url' => 'https://www.postgresql.org/docs/19/release-19.html'],
            ['title' => 'LWN — features pulled during beta', 'url' => 'https://lwn.net/Articles/1100182/'],
            ['title' => 'AWS — the trial on RDS Preview', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/postgresql-19-rc1-amazon-rds-database-preview-environment/'],
        ],
        'body' => <<<'TXT'
On 15 October 2026, the PostgreSQL Global Development Group published a near-final trial of version 19. It should be nearly identical to the stable release, with more fixes still possible. The large batch of fixes due on 12 November goes into this version before the release: a second trial is planned for that day. Unless it slips, the general release is 19 November 2026.

## What is in it

The version 19 notes describe the REPACK command, which reclaims disk space and can reorder rows. With the concurrent option, reads and writes continue during the rewrite. It replaces VACUUM FULL and CLUSTER, which stay available. Two extensions can pin planner choices, or apply them again later. Logical replication can be turned on without restarting the server when the journal level is already “replica”. Sequence values can be replicated too.

The 15 October announcement lists fixes since beta 4, including concurrent REPACK, plan advice, and that logical-replication switch.

## What not to do with it

Amazon RDS offers this trial version in its preview environment, the same day. Those databases are kept for 60 days at most, then deleted. On 13 October, LWN relayed a core team member: several planned features were pulled during beta, because the defects showed up too late to hold. The trial that shipped is therefore not the whole list announced earlier.

A production database stays on a version already in service. 19 is tried aside. Moving from an older major version is a major upgrade.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'devops',
        'slug' => 'lambda-can-serve-a-web-page',
        'title' => 'Lambda can publish a site you already built',
        'summary' => 'On 12 October 2026, AWS let you put an existing Node.js site online without rewriting it into Lambda’s own format.',
        'cover' => '/blog/lambda-web.svg',
        'translation_key' => 'lambda-web',
        'published_at' => '2026-10-18 19:00:00',
        'sources' => [
            ['title' => 'AWS — Lambda Web Functions announcement', 'url' => 'https://aws.amazon.com/about-aws/whats-new/2026/10/aws-lambda-web-functions/'],
            ['title' => 'AWS News Blog — the same launch', 'url' => 'https://aws.amazon.com/blogs/aws/announcing-aws-lambda-web-functions-for-fast-consistent-web-app-performance-anywhere/'],
            ['title' => 'LocalStack — trying it locally', 'url' => 'https://blog.localstack.cloud/aws-lambda-web-functions-are-here/'],
        ],
        'body' => <<<'TXT'
On 12 October 2026, AWS announced Lambda Web Functions. A Node.js site already written with Express, Hono, Fastify, or Next.js can stay as it is. There is nothing to rewrite into Lambda’s own format.

## What changes

Lambda functions already in place are now called Lambda Event Functions. AWS says the rename does not ask for a redeploy. One warm web environment handles several requests at once, up to 128. You pay for the processor time actually used, and for memory for as long as the environment exists, including the gaps between requests. Time spent waiting on a database costs little processor.

At launch, the runtime is Node.js. The open regions are Northern Virginia, Ohio, Oregon, Tokyo, and Ireland. You can deploy to several of them and let each request go to the closest one. A function can reach a private network. CloudFront can use one as an origin, announced the same day.

## What it does not settle

LocalStack wrote that it supports them from this launch, so they can be tried locally before a deploy. The model stays Node.js, in five regions. An application already hosted elsewhere does not have to move for this.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'cybersecurite',
        'slug' => 'nextjs-1641-to-install',
        'title' => 'Next.js 16.4.1 is the one to install',
        'summary' => 'On 14 October 2026, Next.js published a security update outside the usual dates. Install 16.4.1, or 15.5.28 if the site is still on the 15 line.',
        'cover' => '/blog/nextjs-1641.svg',
        'translation_key' => 'nextjs-20261014',
        'published_at' => '2026-10-18 21:00:00',
        'sources' => [
            ['title' => 'Next.js — the 14 October update', 'url' => 'https://nextjs.org/blog/nextjs-security-update-october-14-2026'],
            ['title' => 'NHS England Digital — the same alert', 'url' => 'https://digital.nhs.uk/cyber-alerts/2026/cc-4873'],
        ],
        'body' => <<<'TXT'
On 14 October 2026, Vercel published the security update announced the week before. It sits outside the usual schedule. The versions named are 16.4.1, on the line still followed closely, and 15.5.28, on the 15.5 maintenance line.

## What the fixes cover

The post describes the effects, without a how-to. Two critical points can lead to code running on the server, with no account. One concerns applications that cache results. The publisher asks you to update even if that case is not in the application. The other concerns image optimization, when the server runs on Linux. A third point can saturate the processor and stop the same process from answering. It targets App Router applications that have at least one server action. The pages router, and an application with no server action, sit outside that third point.

NHS England picked up the advisory on 19 October: three flaws, code execution or an outage, and the same advice to update. This text does not repeat the detail of each trigger.

## The version to reach

On the 16 line, the number published on 14 October is 16.4.1. On the 15.5 line, it is 15.5.28. A site still below that, inside the affected ranges, stays exposed until it has those numbers.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'ia',
        'slug' => 'gemini-4-argon-introductory-price',
        'title' => 'Gemini 4 Argon costs less through 30 November',
        'summary' => 'On 13 October 2026, Google opened this model. Through 30 November, text you send is $2 per million units and the reply is $10. Those prices double on 1 December. It is not free.',
        'cover' => '/blog/gemini-4-argon.svg',
        'translation_key' => 'gemini-4-argon',
        'published_at' => '2026-10-18 18:00:00',
        'sources' => [
            ['title' => 'Google — Gemini 4 Argon', 'url' => 'https://blog.google/innovation-and-ai/models-and-research/gemini-models/introducing-gemini-4-argon/'],
            ['title' => 'Google AI for Developers — the model page', 'url' => 'https://ai.google.dev/gemini-api/docs/latest-model'],
            ['title' => 'Google Cloud — the same opening', 'url' => 'https://cloud.google.com/blog/products/ai-machine-learning/gemini-4-argon-available-on-google-cloud'],
        ],
        'body' => <<<'TXT'
On 13 October 2026, Google opened Gemini 4 Argon. The API id is gemini-4-argon. The introductory price runs through 30 November 2026: $2 per million input tokens, $10 per million output tokens, thinking included. From 1 December, the rates become $4 and $20. Input tokens already seen are priced 95 percent lower: $0.10, then $0.20. The model is not on the free tier.

## What Google says about it

The window is 1,048,576 tokens, shared by input, thinking, and output. The default thinking level is medium. It can be turned down or up. Google says Argon ranks first on the Vals Index, which covers finance, code, law, and tax. That is Google’s measurement.

The 13 October post opens the API in AI Studio, Antigravity for Ultra subscribers, and the Gemini app for Pro and Ultra subscribers. The developer documentation, dated 16 October, confirms the price, the window, and the lack of a free tier. Cache requested by hand is not supported. Automatic caching is, from a certain size.

## What not to do with it

The price doubles on 1 December. A trial at the introductory rate does not say what January’s bill will be. Google also tells of internal jobs, with its own figures. Output is billed, thinking included. The model does not reread the work for you.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'developpement',
        'slug' => 'a-file-pins-github-actions',
        'title' => 'A file keeps the exact version of GitHub’s tools',
        'summary' => 'On 14 October 2026, GitHub showed a file that keeps the version of tools it runs on its own. The trial is for Enterprise Cloud accounts. Keeping the version does not prove the tool is safe.',
        'cover' => '/blog/actions-lock.svg',
        'translation_key' => 'actions-lock',
        'published_at' => '2026-10-18 22:00:00',
        'sources' => [
            ['title' => 'GitHub Changelog — the 14 October preview', 'url' => 'https://github.blog/changelog/2026-10-14-github-actions-workflow-lockfiles-in-public-preview/'],
            ['title' => 'GitHub Docs — locking workflow dependencies', 'url' => 'https://docs.github.com/en/actions/how-tos/secure-your-work/lock-workflow-dependencies'],
            ['title' => 'GitHub — the gh-actions-lock repository', 'url' => 'https://github.com/github/gh-actions-lock'],
        ],
        'body' => <<<'TXT'
On 14 October 2026, GitHub opened a public preview of lockfiles for GitHub Actions. A tag or a branch can move after review. The file keeps the recorded commit, and Actions runs that commit, even if the tag has moved since.

The preview is announced for GitHub Enterprise Cloud, including with data residency. The changelog does not open it to the Team and Free plans. The extension is called actions-lock. The file it writes is .github/workflows/actions.lock. You can onboard a single workflow. Once onboarded, every dependency, including the ones it pulls in, must have a line.

Locking does not mean the dependency is sound. GitHub says so: review before you pin. When Dependabot opens an update for an action already onboarded, it regenerates the line in the same pull request. An enterprise, organization, or repository admin can require the file. The extension is before version 1.0, and the format can still change.

It is useful when workflows already run on Enterprise Cloud and the risk you want to cut is a tag that moves. Elsewhere, the preview is not announced. It is not a check of what is inside the actions.
TXT,
    ],
];
