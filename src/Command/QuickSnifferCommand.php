<?php

namespace Stefanius\QuickSniffer\Command;

use Stefanius\QuickSniffer\Inspections\DoubleWhiteLineInspection;
use Stefanius\QuickSniffer\Inspections\NamespaceUppercaseFirstLetterInspection;
use Stefanius\QuickSniffer\Inspections\WhiteLineBeforeAndAfterNamespaceInspection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class QuickSnifferCommand extends AbstractQuickSnifferCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('quicksniffer:check');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = $this->getCommittedFiles();

        $inspections = [
            new DoubleWhiteLineInspection(),
            new WhiteLineBeforeAndAfterNamespaceInspection(),
            new NamespaceUppercaseFirstLetterInspection(),
        ];

        foreach ($files as $file) {
            foreach ($inspections as $inspection) {
                if (!$inspection->passed($file)) {
                    $output->writeln($inspection->getMessage());
                }
            }
        }
    }
}