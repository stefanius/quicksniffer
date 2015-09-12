<?php

namespace Stefanius\QuickSniffer\Tests\Inspections;

use Stefanius\QuickSniffer\Inspections\DoubleWhiteLineInspection;
use Stefanius\QuickSniffer\Tests\TestSuite;

class DoubleWhiteLineInspectionTest extends TestSuite
{
    public function testFile()
    {
        $inspection = new DoubleWhiteLineInspection();

        $result = $inspection->passed(__DIR__ . '/files/doublewhiteline.php');

        $this->assertContains('doublewhiteline.php". See line: 9', $inspection->getMessage());
        $this->assertSame(false, $result);
    }
}