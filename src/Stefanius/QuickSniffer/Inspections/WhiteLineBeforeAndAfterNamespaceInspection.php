<?php

namespace Stefanius\QuickSniffer\Inspections;

use Stefanius\LocalSnifferSdk\Inspections\AbstractInspection;

class WhiteLineBeforeAndAfterNamespaceInspection extends AbstractInspection
{
    public function passed($filename)
    {
        if (!$this->matchedFileType($filename, [$this::PHP_FILE])) {
            return true;
        }

        return $this->checkWhiteLines(file($filename), $filename);
    }

    protected function checkWhiteLines(array $lines = [], $filename)
    {
        foreach ($lines as $key => $line) {
            if (strpos($line, '<?php namespace') === 0) {
                $this->error("The namespace is on the same line as the '<?php' tag. There should be a white line between the namespace and the '<?php' tag. (" . $filename . ")");

                return false;
            }

            if (strpos($line, 'namespace') === 0) {
                if ($key < 2) {
                    $this->error("The namespace should be at least on the third line or the file. The first line is the '<?php' tag, the second line should be empty.(" . $filename . ")");

                    return false;
                }

                if (strlen(trim($lines[$key - 1])) > 0) {
                    $this->error("There should be a white line BEFORE the namespace-line. (" . $filename . ")");

                    return false;
                }

                if (strlen(trim($lines[$key + 1])) > 0) {
                    $this->error("There should be a white line AFTER the namespace-line. (" . $filename . ")");

                    return false;
                }
            }
        }

        return true;
    }
}