<?php

declare(strict_types=1);

return [
    [
        'locale' => 'en',
        'category' => 'developpement',
        'slug' => 'python-315-is-out',
        'title' => 'Python 3.15 is out',
        'summary' => 'On 9 October 2026, Python 3.15.0 became the stable release. It is the feature line after 3.14. The project counts 5,643 changes from 1,012 people.',
        'cover' => '/blog/python-315.svg',
        'translation_key' => 'python-315',
        'published_at' => '2026-10-12 20:00:00',
        'sources' => [
            ['title' => 'Python Insider — Python 3.15.0', 'url' => 'https://blog.python.org/2026/10/python-3150-final-is-here/'],
            ['title' => 'Phoronix — the Python 3.15 release', 'url' => 'https://www.phoronix.com/news/Python-3.15-Released'],
            ['title' => 'LWN — Python 3.15 released', 'url' => 'https://lwn.net/Articles/1099602/'],
        ],
        'body' => <<<'TXT'
On 9 October 2026, Python 3.15.0 became the stable release. It is the feature line that follows 3.14. The project announcement counts 5,643 changes from 1,012 people.

## What changes in the language

Three additions show up in the announcement and in both same-day write-ups. frozendict is a dictionary that cannot be changed after it is created. sentinel is a value meant to say “nothing in particular”, instead of a homemade stand-in. The default encoding becomes UTF-8. Imports can be declared lazy, so a script can start before everything is loaded.

The just-in-time compiler is still experimental. The project gives two figures: about 7 to 8 percent faster, as a geometric mean, on Linux x86-64 compared with the usual interpreter, and about 11 to 12 percent on ARM macOS compared with the tail-calling interpreter. Phoronix repeats both ranges. LWN keeps the same set: the two new types, UTF-8, package startup files, and that compiler.

## The installers

The official 64-bit Windows binaries now use the tail-calling interpreter. The official macOS installer also installs, by default, a second copy that can run without the global lock. It can be unchecked at install time. Third-party packages that are not ready for that mode turn the lock back on.

That is no reason to switch everything the same day. 3.15 is the new line. A production app stays on a line already tried with its libraries, and 3.15 is tested aside.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'devops',
        'slug' => 'github-actions-5-october',
        'title' => 'GitHub Actions stalled on 5 October',
        'summary' => 'On 5 October 2026, GitHub Actions and the machines it lends slowed down for four hours. At the peak, 47 percent of workflows on those machines failed. Self-hosted machines were not affected.',
        'cover' => '/blog/github-actions.svg',
        'translation_key' => 'github-actions-5-oct',
        'published_at' => '2026-10-12 19:00:00',
        'sources' => [
            ['title' => 'GitHub Status — the 5 October 2026 Actions incident', 'url' => 'https://www.githubstatus.com/'],
            ['title' => 'Automater — the peak figures', 'url' => 'https://automater.ai/news/github-actions-hosted-runners-october-5-2026-outage/'],
        ],
        'body' => <<<'TXT'
On 5 October 2026, between 18:48 and 22:49 UTC (3:48 p.m. to 7:49 p.m. São Paulo time), GitHub Actions and the machines it lends slowed down. GitHub says so on its status page. At the peak, for about an hour and a half, 47 percent of workflows on those machines failed, and 71.9 percent of jobs did not start within five minutes. Over the whole window, 14.3 percent of workflows and 26.5 percent of jobs missed that five-minute mark.

Sites already published on GitHub Pages kept being served. Self-hosted machines were not affected. Some accounts also saw errors on the repository list, on licensing and billing pages, and on some Copilot features.

## The cause GitHub gives

GitHub describes a partial network break between one of its datacenter regions and part of its databases and storage hosted in the cloud. Service was restored by moving that traffic to healthy regions and adding capacity. Actions was back at 21:54 UTC. The services named in the report were back at 22:49 UTC. The detailed analysis is still promised.

Automater repeated the same figures, on another site, from that report.

## What to do with it

A red pipeline that evening can come from the platform. Checking the status page avoids hunting a bug that is not in the project. A machine of one’s own kept running. That is no reason to move everything. It is a reason not to treat one failure, in that time window, as a regression in the code.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'cybersecurite',
        'slug' => 'wordpress-713-to-install',
        'title' => 'WordPress 7.1.3 is ready to install',
        'summary' => 'On 6 October 2026, WordPress published version 7.1.3. The announcement speaks of seven security fixes and four other corrections. The project asks sites to update right away.',
        'cover' => '/blog/wordpress-713.svg',
        'translation_key' => 'wordpress-713',
        'published_at' => '2026-10-12 21:00:00',
        'sources' => [
            ['title' => 'WordPress News — version 7.1.3', 'url' => 'https://wordpress.org/news/2026/10/wordpress-7-1-3-maintenance-and-security-release/'],
            ['title' => 'Patchstack — the same release', 'url' => 'https://patchstack.com/articles/wordpress-7-1-3-security-release/'],
            ['title' => 'Search Engine Journal — seven fixes', 'url' => 'https://www.searchenginejournal.com/wordpress-7-1-3-fixes-7-vulnerabilities-and-1-critical-flaw/592109/'],
        ],
        'body' => <<<'TXT'
On 6 October 2026, WordPress published version 7.1.3. The official announcement speaks of seven security fixes and four bug fixes. The project asks sites to update right away, from the dashboard, or to wait for the automatic update if the site has it turned on.

## What the fixes cover

The WordPress post describes the effects, without a how-to. A comment waiting for moderation can place a script on the comments administration page. A site export can be abused as far as the database. Someone who is not logged in can read comments on a private or unpublished post. An author can pin a post beyond that role. Embedded Imgur content can carry a script. Two other points tighten more internal cases.

Patchstack and Search Engine Journal picked up the release the same day: same date, seven fixes, the same advice to update. This text does not repeat how each one is triggered. The version to reach is 7.1.3, or the security update of the line that is still followed.

## Older lines

WordPress says the fixes are also being prepared for lines that are still eligible, down to 4.7, and that they ship as they are ready. Only the latest version is actively supported. A site left on an old line is waiting for a backport that may not be there yet.

The useful step is to read the number in the dashboard and move to 7.1.3 if the site is on 7.1. Sites with automatic updates pick it up on their own. The others wait for a click.
TXT,
    ],
    [
        'locale' => 'en',
        'category' => 'ia',
        'slug' => 'chatgpt-mark-in-europe',
        'title' => 'ChatGPT will mark its text in Europe',
        'summary' => 'On 5 October 2026, OpenAI announced an invisible mark on eligible ChatGPT and Codex text in the European Union. The detector is not public. A missing mark does not prove a person wrote the text.',
        'cover' => '/blog/chatgpt-eu.svg',
        'translation_key' => 'chatgpt-marque-ue',
        'published_at' => '2026-10-12 18:00:00',
        'sources' => [
            ['title' => 'OpenAI — text marking for the European Union', 'url' => 'https://openai.com/index/eu-text-provenance'],
            ['title' => 'The Hindu — the same announcement, 6 October', 'url' => 'https://www.thehindu.com/business/openai-to-watermark-chatgpt-text-in-eu-under-ai-act-rules/article71551205.ece'],
            ['title' => 'Agence Europe — invisible mark, detector kept back', 'url' => 'https://agenceurope.eu/en/bulletin/article/13953/29/openai-announces-watermark-for-texts-generated-by-its-tools-in-eu'],
        ],
        'body' => <<<'TXT'
On 5 October 2026, OpenAI explained how it plans to make text from its tools recognizable, for the European rule on AI. Over the coming weeks, an invisible mark will be added to eligible ChatGPT and Codex text, for users in the European Union, on every plan. It is not turned on for the rest of the world at this launch.

The same day, API customers everywhere can ask for that mark on some models. It stays off until someone turns it on. The detector is not public: OpenAI is opening applications, first for researchers and organizations it accepts.

## What the mark says

OpenAI calls it textGrain. It is a statistical signal in the choice of words, not hidden characters. The detector looks for that signal. The Hindu and Agence Europe describe the same thing, on 6 October: an invisible mark, limited to Europe for ChatGPT, a detector kept back, and limits the company states outright.

OpenAI gives its own measurements, repeated by The Hindu. On psychology texts, with a target of one false alarm in a hundred, the detector finds the mark in about 80 percent of 200-token passages, and about 95 percent of 400-token ones. In mathematics, where the wording is tighter, detection drops. Replacing 10 percent of the words with synonyms takes a detection rate from about 92 percent down to 66 percent. At 25 percent of words replaced, it falls to about 17 percent.

## What it does not say

OpenAI writes it, and Agence Europe keeps it: the mark does not measure the human share. It does not say who owns the text, who asked for it, or whether the text is right. A missing mark does not prove a person wrote it. The passage can be too short, edited, translated, or come from another tool.

For a website, the useful point is there. Text pasted from ChatGPT in Europe may carry this mark. The mark does not replace a read-through, and it is not proof.
TXT,
    ],
];
