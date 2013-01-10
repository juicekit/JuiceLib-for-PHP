<?php

namespace JuiceLib\Graphic;

use JuiceLib\Integer;

class Image extends Graphic {

    public function __construct($width, $height) {
        $this->setWidth($width);
        $this->setHeight($height);

        $this->resource = imagecreate($this->getWidth()->toInt(), $this->getHeight()->toInt());
    }

    public function embed() {
        return 'data:image/png;base64,' . base64_encode($this->generate());
    }

    protected function generate() {
        ob_start();
        imagepng($this->resource);
        imagedestroy($this->resource);

        $image = ob_get_contents();
        ob_end_clean();

        return $image;
    }

    public function add(Graphic $image, $x, $y) {
        imagecopy($this->resource, $image->getResource(), Integer::init($x)->toInt(), Integer::init($y)->toInt(), 0, 0, $image->getWidth()->toInt(), $image->getHeight()->toInt());
    }

}