<?php

namespace App\EventSubscriber;

use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\Event\MessageEvent;
use Symfony\Component\Mime\Email;

final class DevMailCopySubscriber implements EventSubscriberInterface
{
    public function __construct(
        #[Autowire('%kernel.project_dir%')]
        private string $projectDir,
        #[Autowire('%kernel.environment%')]
        private string $environment,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [MessageEvent::class => 'copy'];
    }

    public function copy(MessageEvent $event): void
    {
        if ($this->environment !== 'dev') {
            return;
        }

        $message = $event->getMessage();
        if (!$message instanceof Email) {
            return;
        }

        $dir = $this->projectDir.'/var/mail';
        if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
            return;
        }

        file_put_contents(
            sprintf('%s/%s-%s.txt', $dir, date('Ymd-His'), bin2hex(random_bytes(3))),
            $message->toString(),
        );
    }
}
