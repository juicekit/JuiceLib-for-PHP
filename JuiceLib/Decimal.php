<?php

namespace JuiceLib;

use JuiceLib\Exception\IllegalArgumentException;

class Decimal extends Number implements Initializer {

    public function __construct($number) {

        if (!is_float($number)) {
            throw new IllegalArgumentException();
        }

        $this->number = $number;
    }

    public static function init($number) {
        return new Decimal($number);
    }

}