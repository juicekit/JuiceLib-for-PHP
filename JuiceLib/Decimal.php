<?php

namespace JuiceLib;

use JuiceLib\Exception\IllegalArgumentException;

class Decimal extends Number implements Initializer {

    public function __construct($number) {

        if ($number instanceof Number) {
            $this->number = $number->toDecimal();
        } else if (!is_object($number) && is_numeric($number)) {
            $this->number = doubleval($number);
        } else {
            throw new IllegalArgumentException();
        }
    }

    public static function init($number) {
        return new Decimal($number);
    }

}