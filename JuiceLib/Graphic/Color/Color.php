<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Object;

abstract class Color extends Object {

    abstract public function asRGB();

    abstract public function asHex();

    abstract public function asCMYK();

    abstract public function asHSV();

    abstract public function asHSL();
}