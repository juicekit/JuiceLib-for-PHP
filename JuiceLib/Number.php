<?php

namespace JuiceLib;

abstract class Number extends Object implements Comparable {

    protected $number;

    public function __invoke() {
        return $this->number;
    }

    public function toDecimal() {
        return doubleval($this->number);
    }

    public function toInt() {
        return intval($this->number);
    }

    public function compareTo(Comparable $number) {

        if (!($number instanceof Number)) {
            throw new IllegalArgumentException();
        }

        return $this() - $number();
    }

    public function toString() {
        return "{$this->number}";
    }

}