<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Repository\ContactMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class AdminController extends AbstractController
{
    #[Route('/api/admin/login', name: 'admin_login', methods: ['POST'])]
    public function login(): JsonResponse
    {
        return $this->json(['reason' => 'invalid'], 401, ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/logout', name: 'admin_logout', methods: ['POST'])]
    public function logout(): never
    {
        throw new \LogicException('La déconnexion est gérée par la sécurité.');
    }

    #[Route('/api/admin/session', name: 'admin_session', methods: ['GET'])]
    public function session(): JsonResponse
    {
        return $this->json(
            ['authenticated' => $this->isGranted('ROLE_ADMIN')],
            headers: ['Cache-Control' => 'no-store'],
        );
    }

    #[Route('/api/admin/messages', name: 'admin_messages', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function messages(ContactMessageRepository $messages): JsonResponse
    {
        return $this->json(
            array_map(fn (ContactMessage $message) => [
                'id' => $message->getId(),
                'name' => $message->getName(),
                'email' => $message->getEmail(),
                'locale' => $message->getLocale(),
                'createdAt' => $message->getCreatedAt()->format(\DateTimeInterface::ATOM),
                'excerpt' => $this->excerpt($message->getMessage()),
            ], $messages->latest()),
            headers: ['Cache-Control' => 'no-store'],
        );
    }

    #[Route('/api/admin/messages/{id}', name: 'admin_message', methods: ['GET'])]
    #[IsGranted('ROLE_ADMIN')]
    public function message(ContactMessage $message): JsonResponse
    {
        return $this->json([
            'id' => $message->getId(),
            'name' => $message->getName(),
            'email' => $message->getEmail(),
            'locale' => $message->getLocale(),
            'createdAt' => $message->getCreatedAt()->format(\DateTimeInterface::ATOM),
            'message' => $message->getMessage(),
        ], headers: ['Cache-Control' => 'no-store']);
    }

    #[Route('/api/admin/messages/{id}', name: 'admin_message_delete', methods: ['DELETE'])]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(ContactMessage $message, EntityManagerInterface $entityManager): JsonResponse
    {
        $entityManager->remove($message);
        $entityManager->flush();

        return $this->json(['ok' => true], headers: ['Cache-Control' => 'no-store']);
    }

    private function excerpt(string $message): string
    {
        if (mb_strlen($message) <= 140) {
            return $message;
        }

        return mb_substr($message, 0, 137).'…';
    }
}
