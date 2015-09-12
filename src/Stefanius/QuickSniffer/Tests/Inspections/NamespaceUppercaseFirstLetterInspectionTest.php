<?php

namespace Stefanius\QuickSniffer\Tests\Inspections;

use Stefanius\QuickSniffer\Inspections\NamespaceUppercaseFirstLetterInspection;
use Stefanius\QuickSniffer\Tests\TestSuite;

class NamespaceUppercaseFirstLetterInspectionTest extends TestSuite
{
    public function testFile()
    {
        $inspection = new NamespaceUppercaseFirstLetterInspection();

        $result = $inspection->passed(__DIR__ . '/files/lowercasedNamespace.php');

        $this->assertSame(false, $result);
    }
}