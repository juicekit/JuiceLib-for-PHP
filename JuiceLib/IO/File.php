<?php

namespace JuiceLib\IO;

use JuiceLib\Object,
    JuiceLib\Comparable,
    JuiceLib\Collections\ArrayList,
    JuiceLib\Exception\IllegalArgumentException;

class File extends Object implements Comparable {

    private $path;
    private $file;
    private $directory = false;

    public function isWritable() {
        return is_writable($this->path);
    }

    public function exists() {
        return file_exists($this->path);
    }

    public function getPath() {
        return $this->path;
    }

    public function isAbsolute() {
        return $this->getAbsolutePath() == $this->getPath();
    }

    public function isFile() {
        return $this->file;
    }

    public function isReadable() {
        return is_readable($this->path);
    }

    /**
     * 
     * @return \JuiceLib\IO\File
     */
    public function getParent() {
        $parent = new File(realpath(dirname($this->path)));

        return $parent->getAbsolutePath() == $this->getAbsolutePath() ? null : $parent;
    }

    /**
     * 
     * @return \JuiceLib\Collections\ArrayList
     */
    public function listFiles() {
        if ($this->isFile()) {
            return new ArrayList();
        }


        $files = new ArrayList(new File());

        $dir = scandir($this->getAbsolutePath());

        foreach ($dir as $entry) {
            if ($entry == "." || $entry == "..") {
                continue;
            }

            $files->add(new File($entry));
        }

        return $files;
    }

    public function copy(File $destination) {
        if ($this->isFile()) {
            copy($this->getAbsolutePath(), $destination->getAbsolutePath());
        }
    }

    public function getAbsolutePath() {
        $pathInfo = pathinfo($this->path);

        $path = realpath($this->path);

        if (!$path) {
            $path = realpath($pathInfo['dirname']) . "\\" . $pathInfo['basename'];
        }

        return $path;
    }

    public function __construct($path = null) {
        $this->path = $path;
        $this->directory = is_dir($path);
        $this->file = is_file($path);
    }

    public function isDirectory() {
        return $this->directory;
    }

    public function compareTo(Comparable $object) {
        if (!($object instanceof File)) {
            throw new IllegalArgumentException();
        }

        return 0;
    }

}