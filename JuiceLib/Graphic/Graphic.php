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
        $this->width = Integer::init($width)->toInt();
    }

    public function getWidth() {
        return $this->width;
    }

    public function setHeight($height) {
        $this->height = Integer::init($height)->toInt();
    }

    public function getHeight() {
        return $this->height;
    }

    public function addRectangle($x, $y, $width, $height, Color $background) {

        $x = Integer::init($x)->toInt();
        $y = Integer::init($y)->toInt();

        $width = Integer::init($width)->toInt();
        $height = Integer::init($height)->toInt();

        imagefilledrectangle($this->resource, $x, $y, $x + $width, $y + $height, $this->allocateColor($background));
    }

    public function resize($width, $height) {
        $width = Integer::init($width)->toInt();
        $height = Integer::init($height)->toInt();

        $resized = imagecreatetruecolor($width, $height);

        imagecopyresized($resized, $this->resource(), 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight());

        $this->resource = $resized;

        $this->setWidth($width);
        $this->setheight($height);
    }

    public function setBackGround(Color $color) {

        $bg = $this->allocateColor($color);

        imagefill($this->resource(), 0, 0, $bg);
    }

    public function getBackground() {
        return $this->background;
    }

    public function resource() {
        return $this->resource;
    }

    public function allocateColor(Color $color) {
        $color = $color->asRGB();

        return imagecolorallocate($this->resource(), $color->getR(), $color->getG(), $color->getB());
    }

    abstract protected function generate();

    abstract public function embed();

    abstract public function add(Graphic $image, $x, $y);
}
