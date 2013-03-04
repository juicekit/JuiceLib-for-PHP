<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList;

class Ukraine extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add(new Hex("#005BBB"));
        $stripes->add(new Hex("#FFD500"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 2;
    }

}
