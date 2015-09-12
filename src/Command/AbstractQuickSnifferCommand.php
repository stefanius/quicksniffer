<?php

namespace Stefanius\QuickSniffer\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\ProcessBuilder;

abstract class AbstractQuickSnifferCommand extends Command
{
    /**
     * @return array
     */
    protected function getCommittedFiles()
    {
        $rootpath = $this->getRootPath();

        $processBuilder = new ProcessBuilder(['git', 'diff', '--name-only']);
        $process = $processBuilder->getProcess();
        $process->run();

        $result = explode(PHP_EOL, $process->getOutput());

        foreach ($result as $key => $value) {
            if (strlen(trim($value)) < 1 || empty($value) ) {
                unset($result[$key]);
            } else {
                $result[$key] = $this->combinePath($rootpath, $result[$key]);
            }
        }

        return $result;
    }

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

    /**
     * Concat the relative path to a root path
     *
     * @param string $root
     * @param string $relative
     *
     * @return string
     */
    protected function combinePath($root, $relative)
    {
        $root = trim($root);
        $relative = trim($relative);

        return $root . '/' . $relative;
    }

}