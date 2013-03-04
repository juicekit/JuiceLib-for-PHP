<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Collections\ArrayList,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Germany extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 3 / 5)->toint();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 5 / 3)->toint();
    }

    protected function getStripeCount() {
        return 3;
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add($this->black());
        $stripes->add(new Hex("#DD0000"));
        $stripes->add(new Hex("#FFCE00"));

        return $stripes;
    }

}