<?php

namespace Stefanius\GitPhony\HelperClass;

use Symfony\Component\Process\ProcessBuilder;

abstract class AbstractGitPhony
{
    /**
     * @param array $arguments
     *
     * @return \Symfony\Component\Process\Process
     */
    protected function createProcess(array $arguments = [])
    {
        $processBuilder = new ProcessBuilder($arguments);

        return $processBuilder->getProcess();
    }

}