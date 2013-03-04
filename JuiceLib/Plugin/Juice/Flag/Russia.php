<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList;

class Russia extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());

        $stripes->add($this->white());
        $stripes->add(new Hex("#0039A6"));
        $stripes->add(new Hex("#D52B1E"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 3;
    }

}