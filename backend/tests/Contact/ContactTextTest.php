<?php

namespace App\Tests\Contact;

use App\Contact\ContactText;
use PHPUnit\Framework\TestCase;

final class ContactTextTest extends TestCase
{
    public function testLineDropsTagsAndExtraSpaces(): void
    {
        self::assertSame('Ada Lovelace', ContactText::line("  <b>Ada</b>  \n Lovelace "));
    }

    public function testBlockDropsControlCharacters(): void
    {
        self::assertSame("Bonjour\nAda", ContactText::block("Bonjour\x00\nAda"));
    }

    public function testANonStringIsEmpty(): void
    {
        self::assertSame('', ContactText::line(['Ada']));
        self::assertSame('', ContactText::block(null));
    }
}
