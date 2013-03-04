<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Collections\ArrayList,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Colombia extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toint();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toint();
    }

    protected function getStripeCount() {
        return 4;
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add(new Hex("#FCD116"));
        $stripes->add(new Hex("#FCD116"));
        $stripes->add(new Hex("#003893"));
        $stripes->add(new Hex("#CE1126"));

        return $stripes;
    }

}