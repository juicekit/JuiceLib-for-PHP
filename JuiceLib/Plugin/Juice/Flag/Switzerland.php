<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Switzerland extends Flag {

    protected function build() {
        $this->image()->setBackGround(new Hex("#D52B1E"));

        $offset = $this->getWidth() * 15 / 110;
        $w = $this->getWidth() * 24 / 110;

        $cs = $this->getWidth() * 80 / 110;

        $center = $this->getWidth() / 2;

        $this->image()->addRectangle($center - $w / 2, $offset, $w, $cs, $this->white());
        $this->image()->addRectangle($offset, $center - $w / 2, $cs, $w, $this->white());
    }

    protected function calculateHeight($w) {
        return Integer::init($w)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h)->toInt();
    }

}
