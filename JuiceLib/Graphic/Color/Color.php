<?php

namespace JuiceLib\Graphic\Color;

interface Color {

    public function asRGB();

    public function asHex();

    public function asCMYK();

    public function asHSV();

    public function asHSL();
}