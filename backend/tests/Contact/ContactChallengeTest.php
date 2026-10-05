<?php

namespace App\Tests\Contact;

use App\Contact\ContactChallenge;
use PHPUnit\Framework\TestCase;

final class ContactChallengeTest extends TestCase
{
    private const SECRET = 'test-secret';

    public function testAFreshProofCannotBeSentImmediately(): void
    {
        $challenge = new ContactChallenge();
        $issued = $challenge->issue(self::SECRET, 1_000_000);

        self::assertSame('soon', $challenge->problem(self::SECRET, $issued['issued'], $issued['proof'], 1_000_000));
        self::assertNull($challenge->problem(self::SECRET, $issued['issued'], $issued['proof'], 1_003_000));
    }

    public function testAClientCannotInventTheWaitingTime(): void
    {
        $challenge = new ContactChallenge();

        self::assertSame('invalid', $challenge->problem(self::SECRET, 1_000_000, 'preuve-inventee', 1_010_000));
    }

    public function testAnOldProofExpires(): void
    {
        $challenge = new ContactChallenge();
        $issued = $challenge->issue(self::SECRET, 1_000_000);

        self::assertSame(
            'invalid',
            $challenge->problem(self::SECRET, $issued['issued'], $issued['proof'], 1_000_000 + ContactChallenge::MAX_AGE_MS + 1),
        );
    }
}
