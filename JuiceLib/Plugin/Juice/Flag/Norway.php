<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Norway extends Flag {

    private function blue() {
        return new Hex("#002868");
    }

    protected function build() {
        $this->image()->setBackGround(new Hex("#EF2B2D"));

        $hhw = $this->getHeight() * 4 / 16;
        $vww = $this->getWidth() * 4 / 22;
        $xw = $this->getWidth() * 6 / 22;
        $yw = $this->getHeight() * 6 / 16;

        $this->image()->addRectangle(0, $yw, $this->getWidth(), $hhw, $this->white());
        $this->image()->addRectangle($xw, 0, $vww, $this->getHeight(), $this->white());

        $hhb = $this->getHeight() * 2 / 16;
        $vwb = $this->getWidth() * 2 / 22;
        $xb = $this->getWidth() * 7 / 22;
        $yb = $this->getHeight() * 7 / 16;

        $this->image()->addRectangle(0, $yb, $this->getWidth(), $hhb, $this->blue());
        $this->image()->addRectangle($xb, 0, $vwb, $this->getHeight(), $this->blue());
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 8 / 11)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 11 / 8)->toInt();
    }

}