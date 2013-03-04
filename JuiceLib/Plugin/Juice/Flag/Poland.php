<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList;

class Poland extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 5 / 8)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 8 / 5)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add($this->white());
        $stripes->add(new Hex("#DC143C"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 2;
    }

}
