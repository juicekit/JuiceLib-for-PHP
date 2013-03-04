<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Coordinate,
    JuiceLib\Graphic\CoordinateList,
    JuiceLib\Collections\ArrayList;

class Guyana extends Flag {

    protected function green() {
        return new Hex("#009E49");
    }

    protected function yellow() {
        return new Hex("#FCD116");
    }

    protected function red() {
        return new Hex("#CE1126");
    }

    protected function build() {

        $this->image()->setBackGround($this->green());

        $h = $this->getHeight();
        $middleY = $h / 2;
        $middleX = $this->getWidth() / 2;
        $offset = $h * 18 / 150;


        $white = new CoordinateList();
        $white->add(new Coordinate(0, 0));
        $white->add(new Coordinate($this->getWidth(), $middleY));
        $white->add(new Coordinate(0, $h));
        $this->image()->addPolygon($white, $this->white());

        $yellow = new CoordinateList();
        $yellow->add(new Coordinate(0 - $offset, 0));
        $yellow->add(new Coordinate($this->getWidth() - $offset, $middleY));
        $yellow->add(new Coordinate(0 - $offset, $h));
        $this->image()->addPolygon($yellow, $this->yellow());

        $black = new CoordinateList();
        $black->add(new Coordinate(0, 0));
        $black->add(new Coordinate($middleX, $middleY));
        $black->add(new Coordinate(0, $h));
        $this->image()->addPolygon($black, $this->black());

        $red = new CoordinateList();
        $red->add(new Coordinate(0 - $offset, 0));
        $red->add(new Coordinate($middleX - $offset, $middleY));
        $red->add(new Coordinate(0 - $offset, $h));
        $this->image()->addPolygon($red, $this->red());
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 3 / 5)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 5 / 3)->toInt();
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
