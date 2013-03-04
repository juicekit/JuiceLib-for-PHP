<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer,
    JuiceLib\Graphic\Star;

class Vietnam extends Flag {

    protected function build() {

        $this->image()->setBackGround(new Hex("#DA251D"));

        $star = new Star($this->getWidth() / 2, $this->getHeight() / 2, $this->getHeight() * 0.3);

        $this->image()->addPolygon($star->getCoordinates(), new Hex("#FFFF00"));
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 2 / 3)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 3 / 2)->toInt();
    }

}
