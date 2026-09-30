<?php

namespace App\Controller;

use App\Contact\ContactSubmission;
use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class ContactController extends AbstractController
{
    private const TOKEN_ID = 'submit_contact';
    private const MIN_DELAY_MS = 3000;
    private const MAX_AGE_MS = 43_200_000;
    private const CLOCK_SKEW_MS = 60_000;
    private const MAX_BODY_BYTES = 12_000;

    public function __construct(
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator,
        private MailerInterface $mailer,
        private CsrfTokenManagerInterface $csrfTokenManager,
        private RateLimiterFactory $contactFormLimiter,
        #[Autowire('%env(CONTACT_TO)%')]
        private string $contactTo,
        #[Autowire('%env(CONTACT_FROM)%')]
        private string $contactFrom,
        #[Autowire('%kernel.secret%')]
        private string $secret,
    ) {
    }

    #[Route('/api/contact/token', name: 'contact_token', methods: ['GET'])]
    public function token(): JsonResponse
    {
        return $this->json(
            ['token' => $this->csrfTokenManager->getToken(self::TOKEN_ID)->getValue()],
            headers: ['Cache-Control' => 'no-store'],
        );
    }

    #[Route('/api/contact', name: 'contact_unsupported', methods: ['GET', 'PUT', 'PATCH', 'DELETE'])]
    public function unsupported(): JsonResponse
    {
        return $this->fail('invalid', Response::HTTP_METHOD_NOT_ALLOWED);
    }

    #[Route('/api/contact', name: 'contact_submit', methods: ['POST'])]
    public function submit(Request $request): JsonResponse
    {
        $limiter = $this->contactFormLimiter->create($request->getClientIp() ?? 'unknown');
        if (!$limiter->consume()->isAccepted()) {
            return $this->fail('rate', Response::HTTP_TOO_MANY_REQUESTS);
        }

        $contentType = $request->headers->get('Content-Type', '');
        if (!str_starts_with($contentType, 'application/json')) {
            return $this->fail('invalid', Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        $raw = $request->getContent();
        if ($raw === '' || strlen($raw) > self::MAX_BODY_BYTES) {
            return $this->fail('invalid', Response::HTTP_REQUEST_ENTITY_TOO_LARGE);
        }

        try {
            $payload = json_decode($raw, true, 8, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            return $this->fail('invalid', Response::HTTP_BAD_REQUEST);
        }

        if (!is_array($payload)) {
            return $this->fail('invalid', Response::HTTP_BAD_REQUEST);
        }

        $token = $request->headers->get('X-CSRF-Token', '');
        if (!$this->csrfTokenManager->isTokenValid(new CsrfToken(self::TOKEN_ID, $token))) {
            return $this->fail('invalid', Response::HTTP_FORBIDDEN);
        }

        $honeypot = $payload['fax_number'] ?? '';
        if (!is_string($honeypot) || $honeypot !== '') {
            return $this->ok();
        }

        $startedAt = $payload['startedAt'] ?? null;
        if (is_float($startedAt) && floor($startedAt) === $startedAt) {
            $startedAt = (int) $startedAt;
        }
        if (!is_int($startedAt)) {
            return $this->fail('invalid', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $now = (int) floor(microtime(true) * 1000);
        $elapsed = $now - $startedAt;
        if ($startedAt > $now + self::CLOCK_SKEW_MS || $elapsed > self::MAX_AGE_MS) {
            return $this->fail('invalid', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        if ($elapsed < self::MIN_DELAY_MS) {
            return $this->fail('soon', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $submission = new ContactSubmission(
            $this->cleanLine($payload['name'] ?? ''),
            $this->cleanLine($payload['email'] ?? ''),
            $this->cleanText($payload['message'] ?? ''),
            is_string($payload['locale'] ?? null) ? $payload['locale'] : '',
        );

        if ($this->validator->validate($submission)->count() > 0) {
            return $this->fail('invalid', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $message = new ContactMessage(
            $submission->name,
            $submission->email,
            $submission->message,
            $submission->locale,
            hash('sha256', ($request->getClientIp() ?? '').'|'.$this->secret),
        );
        $this->entityManager->persist($message);
        $this->entityManager->flush();

        try {
            $this->mailer->send($this->email($submission));
        } catch (\Throwable) {
            return $this->fail('mail', Response::HTTP_SERVICE_UNAVAILABLE);
        }

        return $this->ok();
    }

    private function email(ContactSubmission $submission): Email
    {
        $body = implode("\n", [
            'Langue : '.$submission->locale,
            'Nom : '.$submission->name,
            'E-mail : '.$submission->email,
            '',
            $submission->message,
        ]);

        return (new Email())
            ->from(new Address($this->contactFrom, 'ALSEQ DEV'))
            ->to(new Address($this->contactTo))
            ->replyTo(new Address($submission->email, $submission->name))
            ->subject('ALSEQ DEV — nouveau message')
            ->text($body);
    }

    private function cleanLine(mixed $value): string
    {
        if (!is_string($value)) {
            return '';
        }

        $value = trim(strip_tags($value));

        return preg_replace('/\s+/u', ' ', $value) ?? '';
    }

    private function cleanText(mixed $value): string
    {
        if (!is_string($value)) {
            return '';
        }

        $value = strip_tags(str_replace(["\r\n", "\r"], "\n", $value));
        $value = preg_replace("/[\\x00-\\x08\\x0B\\x0C\\x0E-\\x1F\\x7F]/", '', $value) ?? '';

        return trim($value);
    }

    private function ok(): JsonResponse
    {
        return $this->json(['ok' => true], Response::HTTP_CREATED, ['Cache-Control' => 'no-store']);
    }

    private function fail(string $reason, int $status): JsonResponse
    {
        return $this->json(['reason' => $reason], $status, ['Cache-Control' => 'no-store']);
    }
}
