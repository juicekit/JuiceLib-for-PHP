<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Graphic\GD;

interface Color extends GD {

    public function asRGB();

    public function asHex();

    public function asCMYK();

    public function asHSV();

    public function asHSL();
}