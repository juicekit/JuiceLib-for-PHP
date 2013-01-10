<?php

namespace JuiceLib;

use JuiceLib\Exception\IllegalArgumentException;

class Integer extends Number implements Initializer {

    public function __construct($number) {

        if ($number instanceof Number) {
            $this->number = $number->toInt();
        } else if (!is_object($number) && is_numeric($number)) {
            $this->number = intval($number);
        } else {
            throw new IllegalArgumentException();
        }
    }

    public static function init($number) {
        return new Integer($number);
    }

}