<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Collections\ArrayList,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Netherlands extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toint();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toint();
    }

    protected function getStripeCount() {
        return 3;
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add(new Hex("#AE1C28"));
        $stripes->add($this->white());
        $stripes->add(new Hex("#21468B"));

        return $stripes;
    }

}