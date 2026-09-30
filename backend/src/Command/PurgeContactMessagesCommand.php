<?php

namespace App\Command;

use App\Entity\ContactMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

#[AsCommand(name: 'app:contact:purge', description: 'Supprime les messages de contact trop anciens.')]
final class PurgeContactMessagesCommand extends Command
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        #[Autowire('%env(int:CONTACT_RETENTION_DAYS)%')]
        private int $retentionDays,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $limit = new \DateTimeImmutable(sprintf('-%d days', max(1, $this->retentionDays)));
        $deleted = $this->entityManager->createQuery(
            'DELETE FROM '.ContactMessage::class.' m WHERE m.createdAt < :limit'
        )->setParameter('limit', $limit)->execute();

        $output->writeln(sprintf('Messages supprimés : %d', $deleted));

        return Command::SUCCESS;
    }
}
