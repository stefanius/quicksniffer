<?php

namespace Stefanius\PhpPackageChecklist\Inspections;

class KeepChangelogInspection extends AbstractInspection
{
    public function passed($filename)
    {
        if (!$this->matchedFileType($filename, [$this::MARKDOWN_FILE])) {
            return true;
        }

        if (!file_exists($filename) && strpos(strtolower($filename), 'changelog.md') !== false) {
            $this->error("The changelog.md file does not exists. Keeping track of a changelog is required.");

            return false;
        }
    }
}