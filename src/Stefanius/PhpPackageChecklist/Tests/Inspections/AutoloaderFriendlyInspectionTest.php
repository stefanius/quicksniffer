<?php

namespace Stefanius\PhpPackageChecklist\Tests\Inspections;

use Stefanius\PhpPackageChecklist\Inspections\AutoloaderFriendlyInspection;
use Stefanius\PhpPackageChecklist\Tests\TestSuite;

class AutoloaderFriendlyInspectionTest extends TestSuite
{
    public function testFile()
    {
        $inspection = new AutoloaderFriendlyInspection();

        $result = $inspection->passed(__DIR__ . '/files/composer.json');

        $this->assertSame(true, $result);
    }
}