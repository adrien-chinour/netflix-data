<?php

namespace App\Command;

use App\Model\BillingHistory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class MoneySpendCommand extends Command
{
    private SymfonyStyle $io;

    protected function configure()
    {
        $this->setName("money");
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        $this->io = new SymfonyStyle($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $amount = array_reduce(BillingHistory::load(), fn(?float $sum, BillingHistory $item) => $sum + $item->amount);
        $this->io->text("You spend $amount.");
        return 0;
    }
}
