<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Integer,
    JuiceLib\Object,
    JuiceLib\Comparable,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Graphic\Color\Color;

class CMYK extends Object implements Color, Comparable, Alpha {

    private $c;
    private $m;
    private $y;
    private $k;
    private $resource;

    public function __construct($c, $m, $y, $k, $a = 100) {
        $this->c = Integer::init($c)->toInt();
        $this->m = Integer::init($m)->toInt();
        $this->y = Integer::init($y)->toInt();
        $this->k = Integer::init($k)->toInt();

        $this->setAlpha($a);
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

        return new RGB($r, $g, $b, $this->alpha);
    }

    public function equals(Object $object) {
        return $this->asRGB()->equals($object);
    }

    public function compareTo(Comparable $object) {
        return $this->asRGB()->compareTo($object);
    }

    private $alpha;

    public function getAlpha() {
        if (is_null($this->alpha)) {
            $this->setAlpha(100);
        }

        return $this->alpha;
    }

    public function setAlpha($alpha) {

        $alpha = Integer::init($alpha)->toInt();

        if ($alpha < 0 || $alpha > 100) {
            $alpha = 100;
        }

        $this->alpha = $alpha;
    }

    public function resource() {
        return $this->resource;
    }

    public function setResource($resource) {
        if (is_bool($resource)) {
            throw new IllegalArgumentException();
        }

        $this->resource = $resource;
    }

}

?>
