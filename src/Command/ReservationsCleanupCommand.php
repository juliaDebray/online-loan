<?php
namespace App\Command;

use App\Repository\ReservationsRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * this command is created fo a future cron job implementation
 */

class ReservationsCleanupCommand extends Command
{
    private $reservationsRepository;

    protected static $defaultName = 'app:reservations:cleanup';

    public function __construct(ReservationsRepository $reservationsRepository)
    {
        $this->reservationsRepository = $reservationsRepository;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('Deletes expired reservations from the database')
            ->addOption('dry-run', null, InputOption::VALUE_NONE, 'Dry run')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        if ($input->getOption('dry-run')) {
            $io->note('Dry mode enabled');

            $count = $this->reservationsRepository-$this->deleteOldReservations();
        } else {
            $count = $this->reservationsRepository->deleteOldReservations();
        }

        $io->success(sprintf('Deleted "%d" old reservation.', $count));

        return 0;
    }
}
