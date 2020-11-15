<?php

namespace App\Command;

use App\Model\ViewingActivity;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ViewingTimeCommand extends Command
{

    protected function configure()
    {
        $this
            ->setName("time");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $data = ViewingActivity::load();

        $global = array_reduce($data, function ($sum, ViewingActivity $activity) {
            $time = explode(':', $activity->getDuration());
            return $sum + (((int)$time[0]) * 60 * 60) // hours
                + ((int)$time[1]) * 60 // minutes
                + (int)$time[2]; // seconds
        }, 0);

        if (($hours = $global / 60 / 60) / 24 > 1) {
            $io->text(sprintf("global time on Netflix %d days", $hours / 24));
        } else {
            $io->text(sprintf("global time on Netflix %d hours", $hours));
        }


        return 0;
    }

}
