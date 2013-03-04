<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Math,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Coordinate,
    JuiceLib\Graphic\CoordinateList,
    JuiceLib\Collections\ArrayList;

class Bahamas extends HorizontalStripes {

    protected function blue() {
        return new Hex("#00ABC9");
    }

    protected function yellow() {
        return new Hex("#FAE042");
    }

    protected function build() {

        parent::build();

        $coords = new CoordinateList();

        $coords->add(new Coordinate(0, 0));
        $coords->add(new Coordinate((Math::tan(Math::deg2rad(60)) * 10) * $this->getHeight() / 20, $this->getHeight() / 2));
        $coords->add(new Coordinate(0, $this->getHeight()));

        $this->image()->addPolygon($coords, $this->black());
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
        $stripes->add($this->yellow());

        return $stripes;
    }

    protected function getStripeCount() {
        return 3;
    }

}
