<?php

use App\Command\ViewingTimeCommand;
use Symfony\Component\Console\Application;

require __DIR__ . '/vendor/autoload.php';

$application = new Application();
$application->add(new ViewingTimeCommand());
$application->run();
