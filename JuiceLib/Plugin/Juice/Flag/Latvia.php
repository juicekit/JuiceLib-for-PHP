<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Latvia extends Flag {

    protected function build() {
        $this->image()->setBackGround(new Hex("#9E3039"));

        $h = $this->getHeight() * 1 / 5;

        $this->image()->addRectangle(0, $h*2, $this->getWidth(), $h, $this->white());
    }

    protected function calculateHeight($w) {
        return Integer::init($w  / 2)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 2)->toInt();
    }

}