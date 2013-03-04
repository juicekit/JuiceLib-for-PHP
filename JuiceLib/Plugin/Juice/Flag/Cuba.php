<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Math,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Coordinate,
    JuiceLib\Graphic\Star,
    JuiceLib\Graphic\CoordinateList,
    JuiceLib\Collections\ArrayList;

class Cuba extends HorizontalStripes {

    protected function getTriangleColor() {
        return new Hex("#CF142B");
    }

    protected function getStripeColor() {
        return new Hex("#002A8F");
    }

    private function triangleWidth() {
        return (Math::tan(Math::deg2rad(60)) * 10) * $this->getHeight() / 20;
    }

    protected function triangle() {
        $coords = new CoordinateList();

        $coords->add(new Coordinate(0, 0));
        $coords->add(new Coordinate($this->triangleWidth(), $this->getHeight() / 2));
        $coords->add(new Coordinate(0, $this->getHeight()));

        $this->image()->addPolygon($coords, $this->getTriangleColor());
    }

    protected function build() {

        parent::build();

        $this->triangle();

        $radius = $this->getHeight() * 3 / 20;
        $cstar = new Star($this->triangleWidth() / 3, $this->getHeight() / 2, $radius);
        $this->image()->addPolygon($cstar->getCoordinates(), $this->white());
    }

    protected function calculateHeight($w) {
        return Integer::init($w / 2)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 2)->toInt();
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add($this->getStripeColor());
        $stripes->add($this->white());

        return $stripes;
    }

    protected function getStripeCount() {
        return 5;
    }

}
