<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Integer,
    JuiceLib\Math,
    JuiceLib\Object,
    JuiceLib\Comparable,
    JuiceLib\Graphic\Color\Color;

class HSV extends Object implements Color, Comparable {

    private $h;
    private $s;
    private $v;

    public function __construct($h, $s, $v) {
        $this->h = Integer::init($h)->toInt();
        $this->s = Integer::init($s)->toInt();
        $this->v = Integer::init($v)->toInt();
    }

    public function getH() {
        return $this->h;
    }

    public function getS() {
        return $this->s;
    }

    public function getV() {
        return $this->v;
    }

    public function asCMYK() {
        return $this->asRGB()->asCMYK();
    }

    public function asHSL() {
        return $this->asRGB()->asHSL();
    }

    public function asHSV() {
        return $this;
    }

    public function asHex() {
        return $this->asRGB()->asHex();
    }

    public function asRGB() {

        $h = $this->h / 360;
        $s = $this->s / 100;
        $v = $this->v / 100;

        if ($s == 0) {
            return new RGB($v * 255, $v * 255, $v * 255);
        }

        $h *= 6;

        $i = Integer::init($h)->toInt();

        $m = $v * (1 - $s);
        $n = $v * (1 - $s * ($h - $i));
        $o = $v * (1 - $s * (1 - ($h - $i)));

        switch ($i) {
            case 0:
                $r = $v;
                $g = $o;
                $b = $m;
                break;
            case 1:
                $r = $n;
                $g = $v;
                $b = $m;
                break;
            case 2:
                $r = $m;
                $g = $v;
                $b = $o;
                break;
            case 3:
                $r = $m;
                $g = $n;
                $b = $v;
                break;
            case 4:
                $r = $o;
                $g = $m;
                $b = $v;
                break;
            default:
                $r = $v;
                $g = $m;
                $b = $n;
        }

        $r = Math::round($r * 255)->toInt();
        $g = Math::round($g * 255)->toInt();
        $b = Math::round($b * 255)->toInt();

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
