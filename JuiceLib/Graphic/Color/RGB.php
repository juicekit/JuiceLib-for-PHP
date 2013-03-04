<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Integer,
    JuiceLib\Decimal,
    JuiceLib\String,
    JuiceLib\Math,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Comparable,
    JuiceLib\Object;

class RGB extends Object implements Color, Comparable, Alpha {

    private $r;
    private $g;
    private $b;
    private $resource;

    public function __construct($r, $g, $b, $a = 100) {

        $r = Integer::init($r);
        $g = Integer::init($g);
        $b = Integer::init($b);

        if (Math::max($r, $g, $b)->toInt() > 255) {
            throw new IllegalArgumentException();
        }

        $this->setAlpha($a);

        $this->r = Integer::init($r)->toInt();
        $this->g = Integer::init($g)->toInt();
        $this->b = Integer::init($b)->toInt();
    }

    public function getR() {
        return $this->r;
    }

    public function getG() {
        return $this->g;
    }

    public function getB() {
        return $this->b;
    }

    public function asCMYK() {
        $c = 1 - ($this->r / 255);
        $m = 1 - ($this->g / 255);
        $y = 1 - ($this->b / 255);

        $k = Math::min(new Decimal($c), new Decimal($m), new Decimal($y))->toDecimal();

        $cyan = 100 * ($c - $k) / (1 - $k);
        $magenta = 100 * ($m - $k) / (1 - $k);
        $yellow = 100 * ($y - $k) / (1 - $k);
        $black = 100 * $k;

        return new CMYK($cyan, $magenta, $yellow, $black);
    }

    public function asHSL() {

        $r = $this->r / 255;
        $g = $this->g / 255;
        $b = $this->b / 255;


        $max = Math::max(new Decimal($r), new Decimal($g), new Decimal($b))->toDecimal();
        $min = Math::min(new Decimal($r), new Decimal($g), new Decimal($b))->toDecimal();

        $x = $max - $min;
        $sum = $max + $min;

        $h = 0;

        switch ($max) {
            case $r:
                $h = ((60 * ($g - $b) / $x) + 360) % 360;
                break;
            case $g;
                $h = (60 * ($b - $r) / $x) + 120;
                break;
            case $b:
                $h = (60 * ($r - $g) / $x) + 240;
                break;
        }

        $l = $sum / 2;

        if ($l == 0) {
            $s = 0;
        } else if ($l == 1) {
            $s = 1;
        } else if ($l <= 0.5) {
            $s = $x / $sum;
        } else {
            $s = $x / (2 - $sum);
        }

        return new HSL($h, $s * 100, $l * 100);
    }

    public function asHSV() {

        $h = 0;
        $s = 0;

        $r = new Decimal($this->r / 255);
        $g = new Decimal($this->g / 255);
        $b = new Decimal($this->b / 255);

        $min = Math::min($r, $g, $b);
        $max = Math::max($r, $g, $b);

        $v = $max();
        $delta = new Decimal($max() - $min());

        if (!$max->equals(new Decimal(0))) {
            $s = $delta() / $max();
        } else {
            $s = 0;
            $v = null;
            return;
        }

        if ($r->equals($max)) {
            $h = ($g() - $b()) / $delta();
        } else if ($g->equals($max)) {
            $h = 2 + ( $b() - $r() ) / $delta();
        } else {
            $h = 4 + ( $r() - $g() ) / $delta();
        }

        $h *= 60;

        if ($h < 0)
            $h += 360;

        return new HSV(Math::round($h), Math::round($s * 100), Math::round($v * 100));
    }

    public function asHex() {
        $r = new String(base_convert($this->r, 10, 16));
        $g = new String(base_convert($this->g, 10, 16));
        $b = new String(base_convert($this->b, 10, 16));

        if ($r->length() < 2) {
            $r = "0" . $r;
        }
        if ($g->length() < 2) {
            $g = "0" . $g;
        }
        if ($b->length() < 2) {
            $b = "0" . $b;
        }

        return new Hex($r . $g . $b);
    }

    public function asRGB() {
        return $this;
    }

    public function equals(Object $object) {
        if (!($object instanceof Color)) {
            throw new IllegalArgumentException();
        }

        $rgb = $object->asRGB();

        return $rgb->getR() == $this->getR() && $rgb->getG() == $this->getG() && $rgb->getB() == $this->getB();
    }

    public function compareTo(Comparable $object) {
        if (!($object instanceof Color)) {
            throw new IllegalArgumentException();
        }

        $rgb = $object->asRGB();

        $t = Integer::init($this->getR() + $this->getG() + $this->getB())->toInt();
        $o = Integer::init($rgb->getR() + $rgb->getG() + $rgb->getB())->toInt();

        return $t - $o;
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