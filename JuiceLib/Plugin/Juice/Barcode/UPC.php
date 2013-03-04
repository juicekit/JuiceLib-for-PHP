<?php

namespace JuiceLib\Plugin\Juice\Barcode;

use JuiceLib\Plugin,
    JuiceLib\String,
    JuiceLib\Integer,
    JuiceLib\Exception\IllegalArgumentException,
    JuiceLib\Graphic\Image,
    JuiceLib\Graphic\Color\RGB;

class UPC extends Plugin {

    private $hash;
    private $code;
    private $barcode;
    private $barWidth;
    private $height;
    private $width;

    public function __construct($code) {

        $code = new String($code);

        if ($code->length() != 12 && $code->length() != 11) {
            throw new IllegalArgumentException();
        }

        $this->normalize($code);

        $this->barWidth = 1;
        $this->height = 50;
    }

    public function setHeight($height) {
        $this->height = Integer::init($height)->toInt();
    }

    public function setBarWidth($width) {
        $this->barWidth = Integer::init($width)->toInt();
    }

    private function codeMap($i, $key) {
        $map = array(
            '0' => array(0, 0, 0, 1, 1, 0, 1),
            '1' => array(0, 0, 1, 1, 0, 0, 1),
            '2' => array(0, 0, 1, 0, 0, 1, 1),
            '3' => array(0, 1, 1, 1, 1, 0, 1),
            '4' => array(0, 1, 0, 0, 0, 1, 1),
            '5' => array(0, 1, 1, 0, 0, 0, 1),
            '6' => array(0, 1, 0, 1, 1, 1, 1),
            '7' => array(0, 1, 1, 1, 0, 1, 1),
            '8' => array(0, 1, 1, 0, 1, 1, 1),
            '9' => array(0, 0, 0, 1, 0, 1, 1),
            '#' => array(0, 1, 0, 1, 0),
            '*' => array(1, 0, 1)
        );

        if ($i >= 7) {
            $map['0'] = array(1, 1, 1, 0, 0, 1, 0);
            $map['1'] = array(1, 1, 0, 0, 1, 1, 0);
            $map['2'] = array(1, 1, 0, 1, 1, 0, 0);
            $map['3'] = array(1, 0, 0, 0, 0, 1, 0);
            $map['4'] = array(1, 0, 1, 1, 1, 0, 0);
            $map['5'] = array(1, 0, 0, 1, 1, 1, 0);
            $map['6'] = array(1, 0, 1, 0, 0, 0, 0);
            $map['7'] = array(1, 0, 0, 0, 1, 0, 0);
            $map['8'] = array(1, 0, 0, 1, 0, 0, 0);
            $map['9'] = array(1, 1, 1, 0, 1, 0, 0);
        }

        if (isset($map[$key])) {
            return $map[$key];
        }

        throw new IllegalArgumentException();
    }

    private function normalize(String $code) {

        $code = $code->substring(0, 11);

        $accumulator = 0;
        foreach ($code->toArray() as $i => $digit) {
            $digit = Integer::init($digit)->toInt();

            if ($i % 2 == 0) {
                $accumulator += $digit * 3;
            } else {
                $accumulator += $digit;
            }
        }

        $check = 10 - $accumulator % 10;

        $this->code = new String($code . $check);

        $this->hash = new String("*" . $this->code->substring(0, 6) . "#" . $this->code->substring(6, 6) . "*");
    }

    public function getCode() {
        return $this->code;
    }

    protected function generate() {

        $this->width = 95 * $this->barWidth;
        $this->barcode = new Image($this->width, $this->height);

        $white = new RGB(255, 255, 255);
        $black = new RGB(0, 0, 0);

        $this->barcode->setBackGround($white);

        $x = 0;

        foreach ($this->hash->toArray() as $i => $symbol) {

            foreach ($this->codeMap($i, $symbol) as $bit) {
                $color = $bit == 0 ? $white : $black;

                $this->barcode->addRectangle($x, 0, $this->barWidth, $this->height, $color);

                $x += $this->barWidth;
            }
        }

        return $this->barcode;
    }

    public function embed() {
        $this->generate();

        return $this->barcode->embed();
    }

    private $author = "Yoel Nunez <www.yoelnunez.com>";
    private $release = "Jan 9, 2012";
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

}