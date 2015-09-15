<?php

namespace Stefanius\PhpPackageChecklist\Inspections;

class DistributeByComposerInspection extends AbstractInspection
{
    public function passed($filename)
    {
        if (!$this->matchedFileType($filename, [$this::COMPOSER_JSON])) {
            return true;
        }

        if (!file_exists($filename)) {
            $this->error("The composer.json does not exists. You should create this.");

            return false;
        }

        return true;
    }
}
