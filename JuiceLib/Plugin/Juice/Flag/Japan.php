<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Japan extends Flag {

    protected function build() {
        $this->image()->addCircle($this->getWidth() / 2, $this->getHeight() / 2, $this->getHeight() / 1.65, new Hex("#BC002D"));
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

}
