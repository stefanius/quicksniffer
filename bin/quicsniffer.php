#!/usr/bin/env php

<?php
if (file_exists(__DIR__ . '/../../../autoload.php')) {
    require_once(__DIR__ . '/../../../autoload.php');
} elseif (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once(__DIR__ . '/../vendor/autoload.php');
}



use Symfony\Component\Console\Application;
use Stefanius\QuickSniffer\Command\QuickSnifferCommand;

$command = new QuickSnifferCommand();
$console = new Application();
$console->setDefaultCommand($command->getName());
$console->add($command);
$console->run();