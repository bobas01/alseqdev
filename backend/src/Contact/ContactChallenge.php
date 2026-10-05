<?php

namespace App\Contact;

final class ContactChallenge
{
    public const MIN_DELAY_MS = 3000;
    public const MAX_AGE_MS = 43_200_000;
    public const CLOCK_SKEW_MS = 60_000;

    /** @return array{issued: int, proof: string} */
    public function issue(string $secret, ?int $nowMs = null): array
    {
        $issued = $nowMs ?? (int) floor(microtime(true) * 1000);

        return [
            'issued' => $issued,
            'proof' => $this->proof($secret, $issued),
        ];
    }

    public function problem(string $secret, mixed $issued, mixed $proof, ?int $nowMs = null): ?string
    {
        if (!is_int($issued) || !is_string($proof) || !hash_equals($this->proof($secret, $issued), $proof)) {
            return 'invalid';
        }

        $now = $nowMs ?? (int) floor(microtime(true) * 1000);
        $elapsed = $now - $issued;
        if ($issued > $now + self::CLOCK_SKEW_MS || $elapsed > self::MAX_AGE_MS) {
            return 'invalid';
        }
        if ($elapsed < self::MIN_DELAY_MS) {
            return 'soon';
        }

        return null;
    }

    private function proof(string $secret, int $issued): string
    {
        return hash_hmac('sha256', (string) $issued, $secret);
    }
}
