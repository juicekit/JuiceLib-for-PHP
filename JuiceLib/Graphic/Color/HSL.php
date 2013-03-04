<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Integer,
    JuiceLib\Object,
    JuiceLib\Comparable,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Graphic\Color\Color,
    JuiceLib\Math;

class HSL extends Object implements Color, Comparable, Alpha {

    private $h;
    private $s;
    private $l;
    private $resource;

    public function __construct($h, $s, $l) {
        $this->h = Integer::init($h)->toInt();
        $this->s = Integer::init($s)->toInt();
        $this->l = Integer::init($l)->toInt();
    }

    public function getH() {
        return $this->h;
    }

    public function getS() {
        return $this->s;
    }

    public function getL() {
        return $this->l;
    }

    public function asCMYK() {
        return $this->asRGB()->asCMYK();
    }

    public function asHSL() {
        return $this;
    }

    public function asHSV() {
        return $this->asRGB()->asHSV();
    }

    public function asHex() {
        return $this->asRGB()->asHex();
    }

    private function hueToRgb($p, $q, $h) {
        if ($h < 0)
            $h += 1;
        else if ($h > 1)
            $h -= 1;

        if (($h * 6) < 1)
            return $p + ($q - $p) * $h * 6;
        else if (($h * 2) < 1)
            return $q;
        else if (($h * 3) < 2)
            return $p + ($q - $p) * ((2 / 3) - $h) * 6;
        else
            return $p;
    }

    public function asRGB() {
        $h = $this->h / 360;
        $s = $this->s / 100;
        $l = $this->l / 100;

        if ($l <= 0.5) {
            $q = $l * (1 + $s);
        } else {
            $q = $l + $s - ($l * $s);
        }

        $p = 2 * $l - $q;
        $tr = $h + (1 / 3);
        $tg = $h;
        $tb = $h - (1 / 3);

        $r = Math::round($this->hueToRgb($p, $q, $tr) * 255)->toInt();
        $g = Math::round($this->hueToRgb($p, $q, $tg) * 255)->toInt();
        $b = Math::round($this->hueToRgb($p, $q, $tb) * 255)->toInt();

        return new RGB($r, $g, $b);
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
