<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList;

class Italy extends VerticalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());

        $stripes->add(new Hex("#009246"));
        $stripes->add(new Hex("#F1F2F1"));
        $stripes->add(new Hex("#CD2B37"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 3;
    }

}