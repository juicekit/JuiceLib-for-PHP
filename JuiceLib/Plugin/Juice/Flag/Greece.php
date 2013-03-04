<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList;

class Greece extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

    private function blue() {
        return new Hex("#0D5EAF");
    }

    protected function build() {
        parent::build();

        $w = $this->stripeHeight() * 5;
        $this->image()->addRectangle(0, 0, $w, $w, $this->blue());

        $x = $y = $this->stripeHeight() * 2;

        $this->image()->addRectangle(0, $y, $w, $this->stripeHeight(), $this->white());
        $this->image()->addRectangle($x, 0, $this->stripeHeight(), $w, $this->white());
    }

    protected function getStripeCount() {
        return 9;
    }

    protected function getStripes() {

        $stripes = new ArrayList($this->white());
        $stripes->add($this->blue());
        $stripes->add($this->white());

        return $stripes;
    }

}