<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer,
    JuiceLib\Graphic\Polygon,
    JuiceLib\Graphic\Star;

class EU extends Flag {

    protected function build() {
        $this->image()->setBackGround(new Hex("#003399"));

        $x = $this->getWidth() / 2;
        $y = $this->getHeight() / 2;

        $sr = $y / 9;

        $poly = new Polygon($x, $y, $y * 2 / 3, 12);

        $coordinates = $poly->getCoordinates()->toArray();

        for ($i = 0; $i < $poly->getP(); $i++) {
            $t = $i * 2;
            $ix = $coordinates[$t];
            $iy = $coordinates[$t + 1];

            $star = new Star($ix, $iy, $sr);

            $this->image()->addPolygon($star->getCoordinates(), new Hex("#FFCC00"));
        }
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

}