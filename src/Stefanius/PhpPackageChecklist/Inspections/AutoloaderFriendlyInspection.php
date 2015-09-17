<?php

namespace Stefanius\PhpPackageChecklist\Inspections;

use Stefanius\LocalSnifferSdk\Inspections\AbstractInspection;

class AutoloaderFriendlyInspection extends AbstractInspection
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

        $composerData = json_decode(file_get_contents($filename), true);

        if (!$this->isPsr4Friendly($composerData)) {
            $this->error("The composer.json file is nog PSR-4 / autoloading compatible.");

            return false;
        }

        if (!$this->isSourceCodeInSrcFolder($composerData)) {
            $this->error("The sourcecode has to be moved to a src/ subfolder.");

            return false;
        }

        return true;
    }

    protected function hasAutoload($composerData)
    {
        if (!is_array($composerData)) {
            return false;
        }

        if (!array_key_exists('autoload', $composerData)) {
            return false;
        }

        if (!is_array($composerData['autoload'])) {
            return false;
        }

        return true;
    }

    protected function isPsr4Friendly($composerData)
    {
        if (!$this->hasAutoload($composerData)) {
            return false;
        }

        if (!array_key_exists('psr-4', $composerData['autoload'])) {
            return false;
        }

        return is_array($composerData['autoload']['psr-4']);
    }

    protected function isSourceCodeInSrcFolder($composerData)
    {
        return false; //Enable.

        $sourceFolders = $composerData['autoload']['psr-4'];

        if (count($sourceFolders) === 0) {
            return false;
        }

        $result = false;

        foreach ($sourceFolders as $key => $value) {
            $pathElements = explode('/', $value);

            if ($pathElements[0] === 'src') {
                $result = true;
            }
        }

        return $result;
    }
}
