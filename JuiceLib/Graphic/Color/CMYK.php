<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Integer,
    JuiceLib\Object,
    JuiceLib\Comparable,
    JuiceLib\Graphic\Color\Color;

class CMYK extends Object implements Color, Comparable {

    private $c;
    private $m;
    private $y;
    private $k;

    public function __construct($c, $m, $y, $k) {
        $this->c = Integer::init($c)->toInt();
        $this->m = Integer::init($m)->toInt();
        $this->y = Integer::init($y)->toInt();
        $this->k = Integer::init($k)->toInt();
    }

    public function getC() {
        return $this->c;
    }

    public function getM() {
        return $this->m;
    }

    public function getY() {
        return $this->y;
    }

    public function getK() {
        return $this->k;
    }

    public function asCMYK() {
        return $this;
    }

    public function asHSL() {
        return $this->asRGB()->asHSL();
    }

    public function asHSV() {
        return $this->asRGB()->asHSV();
    }

    public function asHex() {
        return $this->asRGB()->asHex();
    }

    public function asRGB() {
        $k = $this->k / 100;

        $c = $this->c / 100;
        $m = $this->m / 100;
        $y = $this->y / 100;

        $r = 255 * (1 - $c) * (1 - $k);
        $g = 255 * (1 - $m) * (1 - $k);
        $b = 255 * (1 - $y) * (1 - $k);

        return new RGB($r, $g, $b);
    }

    public function equals(Object $object) {
        return $this->asRGB()->equals($object);
    }

    public function compareTo(Comparable $object) {
        return $this->asRGB()->compareTo($object);
    }

}

?>
