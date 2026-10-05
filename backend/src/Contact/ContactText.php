<?php

namespace App\Contact;

final class ContactText
{
    public static function line(mixed $value): string
    {
        if (!is_string($value)) {
            return '';
        }

        $value = trim(strip_tags($value));

        return preg_replace('/\s+/u', ' ', $value) ?? '';
    }

    public static function block(mixed $value): string
    {
        if (!is_string($value)) {
            return '';
        }

        $value = strip_tags(str_replace(["\r\n", "\r"], "\n", $value));
        $value = preg_replace("/[\\x00-\\x08\\x0B\\x0C\\x0E-\\x1F\\x7F]/", '', $value) ?? '';

        return trim($value);
    }
}
