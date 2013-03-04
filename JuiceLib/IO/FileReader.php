<?php

namespace JuiceLib\IO;

use JuiceLib\Object,
    JuiceLib\Collections\Iterator,
    JuiceLib\Exception\FileNotFoundException;

class FileReader extends Object implements Iterator {

    private $file;
    private $lines;
    private $pointer = 0;

    public function __construct(File $file) {
        $this->file = $file;

        $this->lines = file($file->getAbsolutePath());

        if (!$this->lines || !$file->isFile() || !$file->exists()) {
            throw new FileNotFoundException();
        }
    }

    public function current() {
        return $this->lines[$this->pointer];
    }

    public function hasNext() {
        return $this->valid();
    }

    public function key() {
        return $this->pointer;
    }

    public function next() {
        return $this->lines[$this->pointer++];
    }

    public function rewind() {
        $this->pointer = 0;
    }

    public function valid() {
        return isset($this->lines[$this->pointer]);
    }

}