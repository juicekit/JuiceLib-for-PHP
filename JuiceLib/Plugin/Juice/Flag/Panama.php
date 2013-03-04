<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Star,
    JuiceLib\Collections\ArrayList;

class Panama extends HorizontalStripes {

    private function blue() {
        return new Hex("#005293");
    }

    private function red() {
        return new Hex("#D21034");
    }

    protected function build() {

        parent::build();

        $halfW = $this->getWidth() / 2;

        $this->image()->addRectangle(0, 0, $halfW, $this->stripeHeight(), $this->white());
        $this->image()->addRectangle($halfW, $this->stripeHeight(), $halfW, $this->stripeHeight(), $this->white());

        $stripeMiddleY = $this->stripeHeight() / 2;

        $boxMiddleX = $halfW / 2;

        $star1 = new Star($boxMiddleX, $stripeMiddleY, $this->stripeHeight() / 4);
        $star2 = new Star($boxMiddleX + $halfW, $stripeMiddleY + $this->stripeHeight(), $this->stripeHeight() / 4);

        $this->image()->addPolygon($star1->getCoordinates(), $this->blue());
        $this->image()->addPolygon($star2->getCoordinates(), $this->red());
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());

        $stripes->add($this->blue());
        $stripes->add($this->red());

        return $stripes;
    }

    protected function getStripeCount() {
        return 2;
    }

}
