<?php

namespace Stefanius\QuickSniffer\Inspections;

abstract class AbstractInspection implements InspectionInterface
{
    private $message;

    protected function error($message)
    {
        $this->message = $this->message . '<error>' . $message . '</error>' . PHP_EOL;
    }

    protected function info($message)
    {
        $this->message = $this->message . '<info>' . $message . '</info>' . PHP_EOL;
    }

    public function getMessage()
    {
        return $this->message;
    }
}