<?php

use App\Command\MoneySpendCommand;
use App\Command\ViewingTimeCommand;
use Symfony\Component\Console\Application;

require __DIR__ . '/vendor/autoload.php';

$application = new Application();
$application->add(new ViewingTimeCommand());
$application->add(new MoneySpendCommand());
$application->run();
