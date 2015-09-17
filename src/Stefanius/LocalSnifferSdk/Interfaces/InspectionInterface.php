<?php

namespace Stefanius\LocalSnifferSdk\Interfaces;

interface InspectionInterface
{
    public function passed($filename);

    public function getMessage();
}