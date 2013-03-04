<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList;

class Ireland extends VerticalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w / 2)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());

        $stripes->add(new Hex("#009B48"));
        $stripes->add($this->white());
        $stripes->add(new Hex("#FF7900"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 3;
    }

}