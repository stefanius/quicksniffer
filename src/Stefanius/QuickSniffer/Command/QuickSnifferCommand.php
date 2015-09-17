<?php

namespace Stefanius\QuickSniffer\Command;

use Stefanius\PhpCsSniffer\Command\PhpCsSnifferCommand;
use Stefanius\PhpPackageChecklist\Checklists\CompleteChecklist;
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
        $status = true;

        $inspections = [
            new DoubleWhiteLineInspection(),
            new WhiteLineBeforeAndAfterNamespaceInspection(),
            new NamespaceUppercaseFirstLetterInspection(),
        ];

        foreach ($files as $file) {
            foreach ($inspections as $inspection) {
                if (!$inspection->passed($file)) {
                    $output->writeln($inspection->getMessage());
                    $status = false;
                }
            }
        }

        if (!$status) {
            $output->writeln("The pre-test has failed. You cannot commit until you solve the above issues.");

            exit(1);
        }

        $status = CompleteChecklist::run($output, $files);

        if (!$status) {
            $output->writeln("The package does not match the package checklist. You cannot commit until you solve the above issues.");

            exit(1);
        }

        $status = $this->executePhpCsSniffer();

        if (!$status) {
            $output->writeln("The php-cs-sniffer results some errors. In this version it is not required to fix it right away, but be aware that this may change in future releases.");
        }
    }
}