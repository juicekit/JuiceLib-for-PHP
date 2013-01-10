<?php

namespace JuiceLib\Graphic\Color;

use JuiceLib\Integer,
    JuiceLib\String,
    JuiceLib\Math,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Exception\UnsupportedOperationException;

class RGB extends Color {

    private $r;
    private $g;
    private $b;

    public function __construct($r, $g, $b) {
        try {
            $r = new Integer($r);
            $g = new Integer($g);
            $b = new Integer($b);

            $max = Math::max($r, $b, $b);

            if ($max() > 255) {
                throw new IllegalArgumentException();
            }
        } catch (Exception $e) {
            throw new IllegalArgumentException($e);
        }

        $this->r = $r();
        $this->g = $g();
        $this->b = $b();
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
        throw new UnsupportedOperationException();
    }

    public function asHSL() {
        throw new UnsupportedOperationException();
    }

    public function asHSV() {
        throw new UnsupportedOperationException();
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

}