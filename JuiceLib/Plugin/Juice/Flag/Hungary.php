<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Collections\ArrayList,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Hungary extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w / 2)->toint();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 2)->toint();
    }

    protected function getStripeCount() {
        return 3;
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add(new Hex("#CE1126"));
        $stripes->add($this->white());
        $stripes->add(new Hex("#008751"));

        return $stripes;
    }

}