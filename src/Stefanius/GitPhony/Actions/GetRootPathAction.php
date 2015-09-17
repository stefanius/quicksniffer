<?php

namespace Stefanius\GitPhony\Actions;

use Stefanius\GitPhony\HelperClass\AbstractGitPhony;

class GetRootPathAction extends AbstractGitPhony
{
    /**
     * Get the full path of the repository root
     *
     * @return string
     */
    public function run()
    {
        $process = $this->createProcess(['git', 'rev-parse', '--show-toplevel']);
        $process->run();

        return trim($process->getOutput());
    }
}