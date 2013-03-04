<?php

namespace JuiceLib\Graphic;

use JuiceLib\Integer,
    JuiceLib\Math,
    JuiceLib\String,
    JuiceLib\Graphic\Color\Color,
    JuiceLib\Graphic\Color\RGB,
    JuiceLib\Graphic\Color\Gradient\Gradient,
    JuiceLib\Graphic\Color\Gradient\Circular,
    JuiceLib\Graphic\Color\Gradient\Rectangular,
    JuiceLib\Graphic\Color\Gradient\Diamond,
    JuiceLib\Graphic\Color\Gradient\Horizontal,
    JuiceLib\Exception\IllegalArgumentException;

class Image extends Graphic {

    public function __construct($width, $height) {
        $this->setWidth($width);
        $this->setHeight($height);

        $this->resource = imagecreatetruecolor($this->getWidth(), $this->getHeight());
    }

    public static function load($location) {

        $w = $h = 50;

        $img = new Image($w, $h);
        $img->setBackGround(new RGB(255, 255, 255));
        $img->setType(Image::PNG);


        $info = array();

        if (preg_match("/^data:image\/(.*);base64,(.*)/", $location, $info)) {
            $info = getimagesizefromstring(base64_decode($info[2]));
        } else {
            $info = getimagesize($location);
        }

        if (is_array($info)) {

            $w = $info[0];
            $h = $info[1];

            $img->resize($w, $h);

            $mime = explode("/", $info['mime']);

            $type = array_pop($mime);

            switch (strtolower($type)) {
                case "jpeg":
                    $source = imagecreatefromjpeg($location);
                    $img->setType(Image::JPEG);
                    break;
                case "png":
                    $source = imagecreatefrompng($location);
                    $img->setType(Image::PNG);
                    break;
                case "gif":
                    $source = imagecreatefromgif($location);
                    $img->setType(Image::GIF);
                    break;
                default:
                    $img->setType(Image::PNG);
                    return $img;
            }


            $img->resource = $source;
            $img->width = $w;
            $img->height = $h;

            return $img;
        }

        return $img;
    }

    public function embed() {

        $type = "";

        switch ($this->getType()) {
            case self::GIF:
                $type = "gif";
                break;
            case self::JPEG:
                $type = "jpg";
                break;
            default :
                $type = "png";
        }

        return "data:image/{$type};base64," . base64_encode($this->generate());
    }

    public function setBackGround(Color $color) {
        parent::setBackGround($color);

        if ($color instanceof Gradient) {
            $span = $color->minimumSpan() == 0 ? $this->getHeight() : $color->minimumSpan();

            $ratio = $this->getWidth() / $span;

            $w = $this->getWidth();
            $h = $this->getHeight();

            $bg_color = new RGB(255, 255, 255);

            if ($color instanceof Horizontal) {

                $width = $span;
                $height = ($span * $h) / $w;

                if ($width < $w) {

                    $width *= $ratio;

                    $width = $ratio * $span;

                    $height = $width * $h / $w;
                }
            } else if ($color instanceof Circular) {
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

                $ratiox = $width / $height * $ratio;

                $start = $color->getStart();
                $color->setStart($color->getEnd());
                $color->setEnd($start);

                $bg_color = $color->getStart();
            } else if ($color instanceof Rectangular) {

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

                $ratiox = $width / $height * $ratio;

                $start = $color->getStart();
                $color->setStart($color->getEnd());
                $color->setEnd($start);

                $bg_color = $color->getStart();
            } else if ($color instanceof Diamond) {

                $d = Math::max(Integer::init($w), Integer::init($h))->toInt();

                $ratio = $d / $span;

                $width = $height = $d;


                $start = $color->getStart();
                $color->setStart($color->getEnd());
                $color->setEnd($start);

                $bg_color = $color->getStart();
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
            $bg->setBackGround($bg_color);

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
                } else if ($color instanceof Circular) {
                    $bg->addEllipse($width / 2, $height / 2, ($span - $x) * $ratiox, ($span - $x) * $ratio, $rgb);
                } else if ($color instanceof Rectangular) {
                    $bg->addRectangle(($x * $ratiox) / 2, ($x * $ratio) / 2, ($span - $x) * $ratiox, ($span - $x) * $ratio, $rgb);
                } else if ($color instanceof Diamond) {
                    $bg->addRectangle(($x * $ratio) / 2, ($x * $ratio) / 2, ($span - $x) * $ratio, ($span - $x) * $ratio, $rgb);
                } else {
                    $bg->addRectangle(0, $x * $ratio, $width, $ratio, $rgb);
                }

                $sR != $eR ? ($sR < $eR ? $sR++ : $sR--) : null;

                $sG != $eG ? ($sG < $eG ? $sG++ : $sG--) : null;

                $sB != $eB ? ($sB < $eB ? $sB++ : $sB--) : null;
            }

            if ($color instanceof Diamond) {
                $bg->rotate(45);
            }


            $bg->resize($w, $h);




            $this->add($bg, 0, 0);
        }
    }

    protected function resourceType() {
        return String::init(get_resource_type($this->resource))->toLowerCase();
    }

    protected function generate() {
        if (!String::init("gd")->equals($this->resourceType())) {
            return $this->source;
        }

        ob_start();

        switch ($this->getType()) {
            case self::GIF:
                imagegif($this->resource());
                break;
            case self::JPEG:
                imagejpeg($this->resource());
                break;
            default :
                imagepng($this->resource());
        }


        imagedestroy($this->resource());

        $this->source = ob_get_contents();
        ob_end_clean();

        return $this->source;
    }

    public function add(Graphic $image, $x, $y) {

        $x = Integer::init($x)->toInt();
        $y = Integer::init($y)->toInt();

        imagecopymerge($this->resource(), $image->resource(), $x, $y, 0, 0, $image->getWidth(), $image->getHeight(), 100);
    }

    public function addTransparent(Graphic $image, $x, $y) {

        $x = Integer::init($x)->toInt();
        $y = Integer::init($y)->toInt();

        imagecolortransparent($image->resource(), $image->getBackground()->resource());
        imagesavealpha($image->resource(), true);

        imagecopymerge($this->resource(), $image->resource(), $x, $y, 0, 0, $image->getWidth(), $image->getHeight(), 100);
    }

    public function setResource($resource) {
        if (is_bool($resource)) {
            throw new IllegalArgumentException();
        }
    }

}