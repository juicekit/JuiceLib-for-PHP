<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Star,
    JuiceLib\Collections\ArrayList;

class Honduras extends HorizontalStripes {

    private function blue() {
        return new Hex("#0073CF");
    }

    protected function build() {

        parent::build();

        $radius = $this->stripeHeight() / 7;

        $middleX = $this->getWidth() / 2;
        $middleY = $this->getHeight() / 2;

        $star1 = new Star($middleX, $middleY, $radius);

        $stripeQ = $this->stripeHeight() / 4;
        $widthHQ = $this->getWidth() / 7;

        $star2 = new Star($middleX - $widthHQ, $middleY - $stripeQ, $radius);
        $star3 = new Star($middleX - $widthHQ, $middleY + $stripeQ, $radius);
        $star4 = new Star($middleX + $widthHQ, $middleY - $stripeQ, $radius);
        $star5 = new Star($middleX + $widthHQ, $middleY + $stripeQ, $radius);

        $this->image()->addPolygon($star1->getCoordinates(), $this->blue());
        $this->image()->addPolygon($star2->getCoordinates(), $this->blue());
        $this->image()->addPolygon($star3->getCoordinates(), $this->blue());
        $this->image()->addPolygon($star4->getCoordinates(), $this->blue());
        $this->image()->addPolygon($star5->getCoordinates(), $this->blue());
    }

    protected function calculateHeight($w) {
        return Integer::init($w / 2)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());

        $stripes->add($this->blue());
        $stripes->add($this->white());

        return $stripes;
    }

    protected function getStripeCount() {
        return 3;
    }

}
