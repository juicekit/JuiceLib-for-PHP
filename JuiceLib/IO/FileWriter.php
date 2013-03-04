<?php

namespace JuiceLib\IO;

use JuiceLib\Object,
    JuiceLib\Exception\FileNotFoundException;

class FileWriter extends Object {

    private $file;
    private $handle;

    public function __construct(File $file) {
        $this->file = $file;

        $this->open();
    }

    public function open() {
        if (!is_resource($this->handle)) {
            $this->handle = @fopen($this->file->getAbsolutePath(), "w+");

            if (!$this->handle) {
                throw new FileNotFoundException();
            }
        }
    }

    public function close() {
        fclose($this->handle);
    }

    public function write($val) {
        fwrite($this->handle, $val);
    }

}
