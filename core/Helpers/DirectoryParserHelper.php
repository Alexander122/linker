<?php

namespace core\helpers;

class DirectoryParserHelper
{
    /**
     * @var string file search path
     */
    public $searchPath;

    /**
     * @var string file name search
     */
    public $searchFile;

    /**
     * @var array map directory
     */
    public $map;

    /**
     * @var array paths to all files found in the directory
     */
    public $path = [];

    /**
     * DirParserHelper constructor.
     * @param $searchPath
     */
    public function __construct($searchPath)
    {
        $this->searchPath = $searchPath;
        $this->map = $this->buildDirectoryMap($this->searchPath);
    }

    /**
     * Search for a file in a directory initialized
     * @param $file
     * @return array
     */
    public function findFiles($file)
    {
        $this->searchFile = $file;
        $this->path = $this->findAllFiles($this->map, $this->searchFile);

        return $this->path;
    }

    /**
     * Ignored files and folders in a directory
     * @return array
     */
    public function getIgnoreDirAndFiles()
    {
        return [
            '.',
            '..',
            '.git',
            '.idea',
            '.gitignore',
            '.htaccess',
        ];
    }

    /**
     * Building a directory map
     * @param $start
     * @return array
     */
    public function buildDirectoryMap($start)
    {
        $files = [];
        $handle = opendir($start);

        while (false !== ($file = readdir($handle)))
        {
            if (!in_array($file, self::getIgnoreDirAndFiles()))
            {
                if (is_dir($start.'/'.$file))
                {
                    $dir = self::buildDirectoryMap($start.'/'.$file);
                    $files[$file] = $dir;
                } else {
                    array_push($files, $file);
                }
            }
        }
        closedir($handle);

        return $files;
    }

    /**
     * Search all file entries in the directory
     * @param $map
     * @param $file
     * @return array
     */
    public function findAllFiles($map, $file)
    {
        static $path;
        static $tempPath;

        foreach ($map as $key => $value) {
            $tempPath[] = $key;
            if (is_array($value)) {
                $this->findAllFiles($value, $file);
            }

            if ($value == $file) {
                array_pop($tempPath);
                $path[] = implode('/', $tempPath)."/";
            } else {
                array_pop($tempPath);
            }
        }

        return $path;
    }
}