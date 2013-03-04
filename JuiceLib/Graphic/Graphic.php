<?php

namespace JuiceLib\Graphic;

use JuiceLib\Object,
    JuiceLib\Integer,
    JuiceLib\Graphic\Color\RGB,
    JuiceLib\IO\FileWriter,
    JuiceLib\IO\File,
    JuiceLib\Graphic\Color\Alpha,
    JuiceLib\Graphic\Color\Color;

abstract class Graphic extends Object implements GD, Embeddable {

    protected $width;
    protected $height;
    protected $background;
    protected $resource;
    protected $source;
    protected $type;

    const PNG = 0x00000;
    const JPEG = 0x00001;
    const GIF = 0x00010;

    public function setType($type) {
        $this->type = $type;
    }

    public function getType() {
        return $this->type;
    }

    public function setWidth($width) {
        $this->width = Integer::init($width)->toInt();
    }

    public function getWidth() {
        return $this->width;
    }

    public function setHeight($height) {
        $this->height = Integer::init($height)->toInt();
    }

    public function source() {
        return $this->generate();
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

    public function addEllipse($x, $y, $width, $height, Color $background) {

        $x = Integer::init($x)->toInt();
        $y = Integer::init($y)->toInt();

        $width = Integer::init($width)->toInt();
        $height = Integer::init($height)->toInt();

        imagefilledellipse($this->resource(), $x, $y, $width, $height, $this->allocateColor($background));
    }

    public function addPolygon(CoordinateList $coords, Color $background) {
        imagefilledpolygon($this->resource(), $coords->toArray(), $coords->size(), $this->allocateColor($background));
    }

    public function addCircle($x, $y, $width, Color $background) {
        $this->addEllipse($x, $y, $width, $width, $background);
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

        $color->setResource($bg);

        $this->background = $color;

        imagefill($this->resource(), 0, 0, $bg);
    }

    /**
     * 
     * @return \JuiceLib\Graphic\Color\Color
     */
    public function getBackground() {
        return $this->background;
    }

    public function resource() {
        return $this->resource;
    }

    protected function toAlpha(Alpha $color) {
        $alpha = $color->getAlpha() / 100 * 127;

        return 127 - $alpha;
    }

    public function allocateColor(Color $color) {
        $color = $color->asRGB();

        if ($color instanceof Alpha) {
            return imagecolorallocatealpha($this->resource(), $color->getR(), $color->getG(), $color->getB(), $this->toAlpha($color));
        }

        return imagecolorallocate($this->resource(), $color->getR(), $color->getG(), $color->getB());
    }

    abstract protected function generate();

    abstract public function add(Graphic $image, $x, $y);

    public function rotate($angle) {
        $this->resource = imagerotate($this->resource(), $angle, $this->getBackground()->resource());

        $this->setWidth(imagesx($this->resource()));
        $this->setHeight(imagesy($this->resource()));
    }

    public function getColorAt($x, $y) {
        $rgb = imagecolorat($this->resource(), Integer::init($x)->toInt(), Integer::init($y)->toInt());

        list($r, $g, $b, $a) = array_values(imagecolorsforindex($this->resource(), $rgb));

        return new RGB($r, $g, $b, $a);
    }

    public function save($name) {
        $fw = new FileWriter(new File($name));
        $fw->write($this->source());
        $fw->close();
    }

}
