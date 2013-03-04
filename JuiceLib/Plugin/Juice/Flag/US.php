<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Integer,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Collections\ArrayList,
    JuiceLib\Graphic\Star;

class US extends HorizontalStripes {

    protected function calculateHeight($w) {
        return Integer::init($w / 1.9)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 1.9)->toInt();
    }

    protected function build() {

        parent::build();

        $blue = new Hex("#3C3B6E");

        $d = $this->getWidth() * 2 / 5;
        $c = 7 * $this->stripeHeight();

        $this->image()->addRectangle(0, 0, $d, $c - 1, $blue);

        $sr = $this->stripeHeight() * 2 / 5;

        for ($i = 0; $i < 9; $i++) {
            for ($j = 0; $j < 6; $j++) {

                $ith = $i % 2;
                $x = ($j * 2 + 1 + $ith) * ($d / 12);
                $y = ($i + 1) * ($c / 10);

                if ($ith == 1 && $j == 5) {
                    continue;
                }

                $star = new Star($x, $y, $sr);
                $this->image()->addPolygon($star->getCoordinates(), $this->white());
            }
        }
    }

    protected function getStripeCount() {
        return 13;
    }

    protected function getStripes() {
        $stripes = new ArrayList($this->white());
        $stripes->add(new Hex("#B22234"));
        $stripes->add($this->white());

        return $stripes;
    }

}