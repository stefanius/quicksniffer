<?php

namespace Stefanius\PhpCsSniffer\Command;

use Stefanius\PhpPackageChecklist\Checklists\CompleteChecklist;
use Stefanius\QuickSniffer\Inspections\DoubleWhiteLineInspection;
use Stefanius\QuickSniffer\Inspections\NamespaceUppercaseFirstLetterInspection;
use Stefanius\QuickSniffer\Inspections\WhiteLineBeforeAndAfterNamespaceInspection;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\CS\Console\Command\FixCommand;

class PhpCsSnifferCommand extends AbstractPhpCsSnifferCommand
{
    /**
     * @inheritdoc
     */
    protected function configure()
    {
        $this->setName('php-cs-sniffer:check');
    }

    /**
     * @inheritdoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return $this->executePhpCsFixer();
    }
}