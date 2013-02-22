<?php

namespace JuiceLib\Graphic;

use JuiceLib\Integer,
    JuiceLib\Math,
    JuiceLib\Graphic\Color\Color,
    JuiceLib\Graphic\Color\RGB,
    JuiceLib\Graphic\Color\Gradient\Gradient,
    JuiceLib\Graphic\Color\Gradient\Horizontal;

class Image extends Graphic {

    public function __construct($width, $height) {
        $this->setWidth($width);
        $this->setHeight($height);

        $this->resource = imagecreatetruecolor($this->getWidth(), $this->getHeight());
    }

    public function embed() {
        return 'data:image/png;base64,' . base64_encode($this->generate());
    }

    public function setBackGround(Color $color) {
        parent::setBackGround($color);

        if ($color instanceof Gradient) {
            $span = $color->minimumSpan() == 0 ? $this->getHeight() : $color->minimumSpan();

            $ratio = $this->getWidth() / $span;

            $w = $this->getWidth();
            $h = $this->getHeight();

            if ($color instanceof Horizontal) {

                $width = $span;
                $height = ($span * $h) / $w;

                if ($width < $w) {

                    $width *= $ratio;

                    $width = $ratio * $span;

                    $height = $width * $h / $w;
                }
            } else {

                $ratio = $h / $span;

                $width = ($span * $w) / $h;
                $height = $span;

                if ($height < $h) {
                    $f = $h / $height + 1;

                    $height *= $f;

                    $ratio = Math::ceil($height / $span)->toInt();

                    $height = $ratio * $span;

                    $width = $height * $w / $h;
                }
            }

            if ($ratio < 1) {
                $ratio = 1;
            }

            $bg = new Image($width, $height);
            $bg->setBackGround(new RGB(255, 255, 255));

            $sR = $color->getStart()->getR();
            $sG = $color->getStart()->getG();
            $sB = $color->getStart()->getB();

            $eR = $color->getEnd()->getR();
            $eG = $color->getEnd()->getG();
            $eB = $color->getEnd()->getB();

            for ($x = 0; $x < $span; $x++) {

                $rgb = new RGB($sR, $sG, $sB);

                if ($color instanceof Horizontal) {
                    $bg->addRectangle($x * $ratio, 0, $ratio, $h, $rgb);
                } else {
                    $bg->addRectangle(0, $x * $ratio, $width, $ratio, $rgb);
                }

                $sR != $eR ? ($sR < $eR ? $sR++ : $sR--) : null;

                $sG != $eG ? ($sG < $eG ? $sG++ : $sG--) : null;

                $sB != $eB ? ($sB < $eB ? $sB++ : $sB--) : null;
            }


            $bg->resize($w, $h);


            $this->add($bg, 0, 0);
        }
    }

    protected function generate() {
        ob_start();

        imagepng($this->resource());
        imagedestroy($this->resource());

        $image = ob_get_contents();
        ob_end_clean();

        return $image;
    }

    public function add(Graphic $image, $x, $y) {

        $x = Integer::init($x)->toInt();
        $y = Integer::init($y)->toInt();

        imagecopymerge($this->resource(), $image->resource(), $x, $y, 0, 0, $image->getWidth(), $image->getHeight(), 100);
    }

}