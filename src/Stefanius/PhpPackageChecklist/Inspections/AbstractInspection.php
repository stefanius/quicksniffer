<?php

namespace Stefanius\PhpPackageChecklist\Inspections;

abstract class AbstractInspection implements InspectionInterface
{
    private $message;

    const PHP_FILE = "php";

    const JSON_FILE = "json";

    const LOCK_FILE = "lock";

    const MARKDOWN_FILE = "md";

    const COMPOSER_JSON = "composer.json";

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param $message
     */
    protected function error($message)
    {
        $this->message = $this->message . '<error>' . $message . '</error>' . PHP_EOL;
    }

    /**
     * @param $message
     */
    protected function info($message)
    {
        $this->message = $this->message . '<info>' . $message . '</info>' . PHP_EOL;
    }

    /**
     * @param string $filename
     * @param array $types
     *
     * @return bool
     */
    protected function matchedFileType($filename, array $types = [])
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        foreach ($types as $type) {
            if (strtolower($type) === strtolower($ext)) {
                return true;
            }

            if (strpos($type, '.') !== false && strpos($filename, $type) !== false) {
                return true;
            }
        }

        return false;
    }
}
