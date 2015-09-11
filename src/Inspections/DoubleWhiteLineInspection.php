<?php

namespace Stefanius\QuickSniffer\Inspections;

class DoubleWhiteLineInspection implements InspectionInterface
{
    public function passed($filename)
    {
        return $this->checkWhiteLines(file($filename));
    }

    protected function checkWhiteLines(array $lines = [])
    {
        foreach ($lines as $key => $line) {
            if ($key < count($lines)) {
                if (strlen(trim($lines[$key])) === 0 && strlen(trim($lines[$key + 1])) === 0) {
                    return false;
                }
            }
        }

        return true;
    }
}