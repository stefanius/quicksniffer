<?php

namespace Stefanius\PhpPackageChecklist\Inspections;

interface InspectionInterface
{
    public function passed($filename);

    public function getMessage();
}