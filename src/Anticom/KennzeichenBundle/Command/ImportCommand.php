<?php

namespace Anticom\KennzeichenBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Timo Mühlbach
 */
class ImportCommand extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('anticom:import:csv')
            ->setDescription('Importiert oder aktuallisiert Kennzeichendaten')
            ->addArgument('CSV Datei', InputArgument::REQUIRED, 'Pfad zur importierenden CSV Datei')
            ->addOption('ignore-first-line', 'i', InputOption::VALUE_NONE, 'Import ignoriert die erste Zeile')
            ->setHelp(<<<EOF
Das <info>%command.name%</info> Tool importiert eine CVS Datei in die Datenbank

<info>php %command.full_name%</info>
EOF
            );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        //TODO implement
    }
}
