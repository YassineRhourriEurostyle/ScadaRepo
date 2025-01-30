<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\DBBackup;
use Symfony\Component\DependencyInjection\ContainerInterface;

class DBBackupCommand extends Command {

    protected static $defaultName = 'db:backup';

    public function __construct(ContainerInterface $container) {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure() {
        $this
                ->setDescription('Backups database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int {
        $io = new SymfonyStyle($input, $output);
        $em = $this->container->get('doctrine')->getManager('default');

        $d = new DBBackup($em);
        $d->backup();

        $io->success("Database saved.");

        return 0;
    }

}
