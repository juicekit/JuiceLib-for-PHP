<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Finland extends Flag {

    protected function build() {
        $blue = new Hex("#003580");

        $hh = $this->getHeight() * 3 / 11;
        $vw = $this->getWidth() * 3 / 18;

        $x = $this->getWidth() * 5 / 18;
        $y = $this->getHeight() * 4 / 11;

        $this->image()->addRectangle(0, $y, $this->getWidth(), $hh, $blue);
        $this->image()->addRectangle($x, 0, $vw, $this->getHeight(), $blue);
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 11 / 18)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 18 / 11)->toInt();
    }

}