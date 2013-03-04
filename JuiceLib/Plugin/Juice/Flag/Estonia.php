<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Collections\ArrayList,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Estonia extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 7 / 11)->toint();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 11 / 7)->toint();
    }

    protected function getStripeCount() {
        return 3;
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add(new Hex("#4891D9"));
        $stripes->add($this->black());
        $stripes->add($this->white());

        return $stripes;
    }

}