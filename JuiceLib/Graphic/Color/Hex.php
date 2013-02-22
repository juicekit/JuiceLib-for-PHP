<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\String,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Object,
    JuiceLib\Graphic\Color\Color,
    JuiceLib\Comparable;

class Hex extends Object implements Color, Comparable {

    private $hex;

    public function __construct($color) {
        try {
            $color = new String($color);

            if ($color->charAt(0) == '#') {
                $color = $color->substring(1, $color->length() - 1);
            }

            if ($color->length() != 3 && $color->length() != 6) {
                throw new IllegalArgumentException();
            }

            if ($color->length() == 3) {
                $hex = $color->charAt(0);
                $hex .= $color->charAt(0);
                $hex .= $color->charAt(1);
                $hex .= $color->charAt(1);
                $hex .= $color->charAt(2);
                $hex .= $color->charAt(2);

                $color = new String($hex);
            }
        } catch (Exception $e) {
            throw new IllegalArgumentException($e);
        }

        $this->hex = $color;
    }

    public function getHex() {
        return $this->hex->toString();
    }

    public function asCMYK() {
        return $this->asRGB()->asCMYK();
    }

    public function asHSL() {
        return $this->asRGB()->asHSL();
    }

    public function asHSV() {
        return $this->asRGB()->asHSV();
    }

    public function asHex() {
        return $this;
    }

    public function asRGB() {
        $r = base_convert($this->hex->substring(0, 2), 16, 10);
        $g = base_convert($this->hex->substring(2, 2), 16, 10);
        $b = base_convert($this->hex->substring(4, 2), 16, 10);

        return new RGB($r, $g, $b);
    }

    public function equals(Object $object) {
        return $this->asRGB()->equals($object);
    }

    public function compareTo(Comparable $object) {
        return $this->asRGB()->compareTo($object);
    }

}
