<?php

namespace Stefanius\QuickSniffer\Inspections;

use Stefanius\LocalSnifferSdk\Inspections\AbstractInspection;

class DoubleWhiteLineInspection extends AbstractInspection
{
    protected $errorMessage = 'Double white line detected in: "%s". See line: %s';

    public function passed($filename)
    {
        return $this->checkWhiteLines(file($filename), $filename);
    }

    protected function checkWhiteLines(array $lines = [], $filename)
    {
        foreach ($lines as $key => $line) {
            if ($key < count($lines)) {
                if (strlen(trim($lines[$key])) === 0 && strlen(trim($lines[$key + 1])) === 0) {
                    $this->error(sprintf($this->errorMessage, $filename, $key + 1));

                    return false;
                }
            }
        }

        return true;
    }
}
