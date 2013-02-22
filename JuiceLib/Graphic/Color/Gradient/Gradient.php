<?php

namespace JuiceLib\Graphic\Color\Gradient;

use JuiceLib\Graphic\Color\Color,
    JuiceLib\Object,
    JuiceLib\Math;

abstract class Gradient extends Object implements Color {

    private $start;
    private $end;

    public function setStart(Color $color) {
        $this->start = $color->asRGB();
    }

    /**
     * 
     * @return \JuiceLib\Graphic\Color\RGB
     */
    public function getStart() {
        return $this->start;
    }

    public function setEnd(Color $color) {
        $this->end = $color->asRGB();
    }

    /**
     * 
     * @return \JuiceLib\Graphic\Color\RGB
     */
    public function getEnd() {
        return $this->end;
    }

    public function minimumSpan() {
        $sR = $this->getStart()->getR();
        $sG = $this->getStart()->getG();
        $sB = $this->getStart()->getB();

        $eR = $this->getEnd()->getR();
        $eG = $this->getEnd()->getG();
        $eB = $this->getEnd()->getB();

        $r = Math::abs($eR - $sR);
        $g = Math::abs($eG - $sG);
        $b = Math::abs($eB - $sB);

        return Math::max($r, $g, $b)->toInt();
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
        return $this->asRGB()->asHex();
    }

    public function asRGB() {
        return $this->getStart();
    }

}
