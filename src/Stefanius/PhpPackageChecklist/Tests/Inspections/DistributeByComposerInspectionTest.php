<?php

namespace Stefanius\PhpPackageChecklist\Tests\Inspections;

use Stefanius\PhpPackageChecklist\Inspections\DistributeByComposerInspection;
use Stefanius\PhpPackageChecklist\Tests\TestSuite;

class DistributeByComposerInspectionTest extends TestSuite
{
    public function testFile()
    {
        $inspection = new DistributeByComposerInspection();

        $result = $inspection->passed(__DIR__ . '/files/bogus/non_existing_composer.json');

        $this->assertSame(false, $result);
    }
}