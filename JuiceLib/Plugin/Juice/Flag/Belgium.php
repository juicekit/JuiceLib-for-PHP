<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList;

class Belgium extends VerticalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 13 / 15)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 15 / 13)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());

        $stripes->add($this->black());
        $stripes->add(new Hex("#FAE042"));
        $stripes->add(new Hex("#ED2939"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 3;
    }

}