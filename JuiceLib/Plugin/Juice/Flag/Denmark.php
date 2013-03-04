<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Denmark extends Flag {

    protected function build() {
        $this->image()->setBackGround(new Hex("#C60C30"));

        $hh = $this->getHeight() * 4 / 28;
        $vw = $this->getWidth() * 4 / 37;

        $x = $this->getWidth() * 12 / 37;
        $y = $this->getHeight() * 12 / 28;

        $this->image()->addRectangle(0, $y, $this->getWidth(), $hh, $this->white());
        $this->image()->addRectangle($x, 0, $vw, $this->getHeight(), $this->white());
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 28 / 37)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 37 / 28)->toInt();
    }

}