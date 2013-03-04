<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList,
    JuiceLib\Graphic\CoordinateList,
    JuiceLib\Graphic\Coordinate;

class CzechRepublic extends HorizontalStripes {

    protected function build() {

        parent::build();

        $coords = new CoordinateList();

        $coords->add(new Coordinate(0, 0));
        $coords->add(new Coordinate($this->getWidth() / 2, $this->getHeight() / 2));
        $coords->add(new Coordinate(0, $this->getHeight()));

        $this->image()->addPolygon($coords, new Hex("#11457E"));
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
        $stripes->add(new Hex("#D7141A"));

        return $stripes;
    }

    protected function getStripeCount() {
        return 2;
    }

}
