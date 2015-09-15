<?php

namespace Stefanius\PhpPackageChecklist\Inspections;

class WriteDocumentationInspection extends AbstractInspection
{
    public function passed($filename)
    {
        if (!$this->matchedFileType($filename, [$this::MARKDOWN_FILE])) {
            return true;
        }

        if (!file_exists($filename) && strpos(strtolower($filename), 'readme.md') !== false) {
            $this->error("The readme.md file does not exists. Keeping track of a documentation is required.");

            return false;
        }
    }
}