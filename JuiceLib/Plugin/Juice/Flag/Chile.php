<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Star,
    JuiceLib\Collections\ArrayList;

class Chile extends HorizontalStripes {

    protected function build() {

        parent::build();

        $sw = $this->stripeHeight();

        $this->image()->addRectangle(0, 0, $sw, $sw, new Hex("#0039A6"));

        $cstar = new Star($sw / 2, $sw / 2, $sw / 4);
        $this->image()->addPolygon($cstar->getCoordinates(), $this->white());
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add($this->white());
        $stripes->add(new Hex("#D52B1E"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 2;
    }

}
