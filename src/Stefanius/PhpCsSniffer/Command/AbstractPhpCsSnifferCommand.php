<?php

namespace Stefanius\PhpCsSniffer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

abstract class AbstractPhpCsSnifferCommand extends Command
{
    /**
     * Get the full path of the repository root
     *
     * @return string
     */
    protected function getRootPath()
    {
        $processBuilder = new ProcessBuilder(['git', 'rev-parse', '--show-toplevel']);
        $process = $processBuilder->getProcess();
        $process->run();

        return trim($process->getOutput());
    }

    protected function executePhpCsFixer()
    {
        $rootpath = $this->getRootPath();

        $fixer = false;

        if (file_exists($rootpath . '/vendor/fabpot/php-cs-fixer/php-cs-fixer')) {
            $fixer = $rootpath . '/vendor/fabpot/php-cs-fixer/php-cs-fixer';
        } elseif (file_exists($rootpath . '/bin/php-cs-fixer')) {
            $fixer = $rootpath . '/bin/php-cs-fixer';
        }

        $processBuilder = new ProcessBuilder([$fixer, 'fix', '--dry-run', '-vv', $rootpath]);
        $process = $processBuilder->getProcess();
        $process->run();
        echo $process->getOutput();

        return strlen($process->getOutput()) < 20;
    }
}