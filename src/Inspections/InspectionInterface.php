<?php

namespace Stefanius\QuickSniffer\Inspections;

interface InspectionInterface
{
    public function passed($filename);

    public function getMessage();
}