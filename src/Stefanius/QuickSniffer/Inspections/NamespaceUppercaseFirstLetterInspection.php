<?php

namespace Stefanius\QuickSniffer\Inspections;

class NamespaceUppercaseFirstLetterInspection extends AbstractInspection
{
    protected $errorMessage = 'Every element of the namespace must start with an uppercased character. File: "%s". Element: "%s". Full Namespace: "%s"';

    public function passed($filename)
    {
        if (!$this->matchedFileType($filename, [$this::PHP_FILE])) {
            return true;
        }

        $result = true;

        $lines = file($filename);
        $namespace = $this->findNamepace($lines);

        if (!$namespace) {
            return true;
        }

        $elements = explode('\\', $namespace);

        foreach ($elements as $element) {
            if ($element !== ucfirst($element)) {
                $this->error(sprintf($this->errorMessage, $filename, $element, $namespace));

                $result = false;
            }
        }

        return $result;
    }

    protected function findNamepace(array $lines = [])
    {
        $namespace = false;

        foreach ($lines as $line) {
            if (strpos($line, 'namespace') === 0) {
                $namespace = $line;
                $namespace = trim(str_replace('namespace', '', $namespace));

                break;
            }
        }

        return $namespace;
    }
}