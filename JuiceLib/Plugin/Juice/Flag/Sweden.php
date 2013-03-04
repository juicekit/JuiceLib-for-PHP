<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Graphic\Color\Hex,
    JuiceLib\Integer;

class Sweden extends Flag {

    private function blue() {
        return new Hex("#005293");
    }

    private function yellow() {
        return new Hex("#FECB00");
    }

    protected function build() {

        $this->image()->setBackGround($this->blue());

        $hh = $this->getHeight() * 2 / 10;
        $vw = $this->getWidth() * 2 / 16;

        $x = $this->getWidth() * 5 / 16;
        $y = $this->getHeight() * 4 / 10;

        $this->image()->addRectangle(0, $y, $this->getWidth(), $hh, $this->yellow());
        $this->image()->addRectangle($x, 0, $vw, $this->getHeight(), $this->yellow());
    }

    protected function calculateHeight($w) {
        return Integer::init($w * 5 / 8)->toInt();
    }

    protected function calculateWidth($h) {
        return Integer::init($h * 8 / 5)->toInt();
    }

}