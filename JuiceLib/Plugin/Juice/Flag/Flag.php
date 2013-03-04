<?php

namespace JuiceLib\Plugin\Juice\Flag;

use JuiceLib\Plugin,
    JuiceLib\Integer,
    JuiceLib\Graphic\Image,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Embeddable;

abstract class Flag extends Plugin implements Embeddable {

    const WIDTH = 0x00000;
    const HEIGHT = 0x00001;

    protected $width;
    protected $height;
    private $image;

    public function __construct($s, $dimension = self::WIDTH) {
        $s = Integer::init($s)->toInt();

        switch ($dimension) {
            case self::HEIGHT:
                $this->height = $s;
                $this->width = $this->calculateWidth($s);
                break;
            default :
                $this->width = $s;
                $this->height = $this->calculateHeight($s);
        }

        $this->image = new Image($this->width, $this->height);
        $this->image->setBackGround($this->white());
    }

    /**
     * 
     * @return \JuiceLib\Graphic\Image
     */
    protected function image() {
        return $this->image;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getWidth() {
        return $this->width;
    }

    public function embed() {
        $this->build();

        return $this->image()->embed();
    }

    abstract protected function calculateWidth($h);

    abstract protected function calculateHeight($w);

    abstract protected function build();

    private $author = "Yoel Nunez <www.yoelnunez.com>";
    private $release = "March 4, 2012";
    private $version = "0.1";

    public function getAuthor() {
        return $this->author;
    }

    public function getReleaseDate() {
        return $this->release;
    }

    public function getVersion() {
        return $this->version;
    }

    protected function white() {
        return new Hex("#FFFFFF");
    }

    protected function black() {
        return new Hex("#000000");
    }

}