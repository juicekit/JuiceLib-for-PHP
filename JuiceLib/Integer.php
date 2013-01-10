<?php

namespace JuiceLib;

use JuiceLib\Exception\IllegalArgumentException;

class Integer extends Number implements Initializer {

    public function __construct($number) {
        if (!is_int($number)) {
            throw new IllegalArgumentException();
        }

        $this->number = intval($number);
    }

    public static function init($number) {
        return new Integer($number);
    }

}