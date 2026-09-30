<?php

namespace App\Contact;

use Symfony\Component\Validator\Constraints as Assert;

final class ContactSubmission
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Length(max: 80)]
        #[Assert\Regex(pattern: '/\A[^\r\n]+\z/')]
        public string $name,
        #[Assert\NotBlank]
        #[Assert\Length(max: 180)]
        #[Assert\Email(mode: 'html5')]
        public string $email,
        #[Assert\NotBlank]
        #[Assert\Length(min: 5, max: 4000)]
        public string $message,
        #[Assert\Choice(choices: ['fr', 'en', 'pt-br', 'es'])]
        public string $locale,
    ) {
    }
}
