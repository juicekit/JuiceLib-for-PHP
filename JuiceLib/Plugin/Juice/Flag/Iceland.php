<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Iceland extends Flag {

    private function blue() {
        return new Hex("#003897");
    }

    private function red() {
        return new Hex("#D72828");
    }

    protected function build() {
        $this->image()->setBackGround($this->blue());

        $hhw = $this->getHeight() * 4 / 18;
        $vww = $this->getWidth() * 4 / 25;
        $xw = $this->getWidth() * 7 / 25;
        $yw = $this->getHeight() * 7 / 18;

        $this->image()->addRectangle(0, $yw, $this->getWidth(), $hhw, $this->white());
        $this->image()->addRectangle($xw, 0, $vww, $this->getHeight(), $this->white());

        $hhb = $this->getHeight() * 2 / 18;
        $vwb = $this->getWidth() * 2 / 25;
        $xb = $this->getWidth() * 8 / 25;
        $yb = $this->getHeight() * 8 / 18;

        $this->image()->addRectangle(0, $yb, $this->getWidth(), $hhb, $this->red());
        $this->image()->addRectangle($xb, 0, $vwb, $this->getHeight(), $this->red());
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 8 / 11)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 11 / 8)->toInt();
    }

}