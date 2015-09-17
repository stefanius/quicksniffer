<?php

namespace Stefanius\QuickSniffer\Inspections;

use Stefanius\LocalSnifferSdk\Inspections\AbstractInspection;

class WhiteLineBeforeAndAfterNamespaceInspection extends AbstractInspection
{
    public function passed($filename)
    {
        return $this->checkWhiteLines(file($filename));
    }

    protected function checkWhiteLines(array $lines = [])
    {
        foreach ($lines as $key => $line) {
            if (strpos($line, 'namespace') === 0) {
                if ($key < 2) {
                    return false;
                }

                if (strlen(trim($lines[$key - 1])) > 0) {
                    return false;
                }

                if (strlen(trim($lines[$key + 1])) > 0) {
                    return false;
                }

                return true;
            }
        }

        return true;
    }
}