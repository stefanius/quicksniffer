<?php

namespace Stefanius\QuickSniffer\Inspections;

class NamespaceUppercaseFirstLetterInspection implements InspectionInterface
{
    public function passed($filename)
    {
        $result = true;

        $lines = file($filename);
        $namespace = $this->findNamepace($lines);
        
        if (!$namespace) {
            return true;
        }

        $elements = explode('\\', $namespace);

        foreach ($elements as $element) {
            if ($element !== ucfirst($element)) {
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