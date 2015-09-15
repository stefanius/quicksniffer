<?php

namespace Stefanius\PhpPackageChecklist\Checklists;

use Stefanius\PhpPackageChecklist\Inspections\AutoloaderFriendlyInspection;
use Stefanius\PhpPackageChecklist\Inspections\DistributeByComposerInspection;
use Stefanius\PhpPackageChecklist\Inspections\KeepChangelogInspection;
use Stefanius\PhpPackageChecklist\Inspections\WriteDocumentationInspection;
use Symfony\Component\Console\Output\OutputInterface;

class CompleteChecklist
{
    public static function run(OutputInterface $output, array $files = [])
    {
        //See: http://phppackagechecklist.com/
        $list = [
             1 => null,
             2 => null,
             3 => new AutoloaderFriendlyInspection(),
             4 => new DistributeByComposerInspection(),
             5 => null,
             6 => null,
             7 => null,
             8 => null,
             9 => null,
            10 => new KeepChangelogInspection(),
            11 => null,
            12 => new WriteDocumentationInspection(),
            13 => null,
            14 => null,
        ];

        $result = true;

        foreach ($files as $file) {
            foreach ($list as $inspection) {
                if ($inspection !== null) {
                    if (!$inspection->passed($file)) {
                        $output->writeln($inspection->getMessage());

                        $result = false;
                    }
                }
            }
        }

        return $result;
    }
}