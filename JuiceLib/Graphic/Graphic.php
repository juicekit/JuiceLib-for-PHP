<?php

namespace JuiceLib\Graphic;

use JuiceLib\Object,
    JuiceLib\Integer,
    JuiceLib\Graphic\Color\Color;

abstract class Graphic extends Object {

    protected $width;
    protected $height;
    protected $background;
    protected $resource;

    public function setWidth($width) {
        $this->width = new Integer($width);
    }

    public function getWidth() {
        return $this->width;
    }

    public function setHeight($height) {
        $this->height = new Integer($height);
    }

    public function getHeight() {
        return $this->height;
    }

    public function setBackGround(Color $color) {
        $this->background = $color;

        imagefill($this->getResource(), 0, 0, $this->allocateColor($color));
    }

    protected function getResource() {
        return $this->resource;
    }

    protected function allocateColor(Color $color) {
        $color = $color->asRGB();
        return imagecolorallocate($this->getResource(), $color->getR(), $color->getG(), $color->getB());
    }

    abstract protected function generate();

    abstract public function embed();

    abstract public function add(Graphic $image, $x, $y);
}
