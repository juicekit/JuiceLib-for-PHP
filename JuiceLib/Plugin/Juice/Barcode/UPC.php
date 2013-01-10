<?php

namespace JuiceLib\Plugin\Juice\Barcode;

use JuiceLib\Plugin\Plugin,
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
            echo $code->length();
            throw new IllegalArgumentException();
        }

        $this->normalize($code);

        $this->barWidth = new Integer(1);
        $this->height = new Integer(50);
    }

    public function setHeight($height) {
        $this->height = new Integer($height);
    }

    public function setBarWidth($width) {
        $this->barWidth = new Integer($width);
    }

    private function codeMap($i, $key) {
        $map = array(
            '0' => '0001101', '1' => '0011001', '2' => '0010011', '3' => '0111101',
            '4' => '0100011', '5' => '0110001', '6' => '0101111', '7' => '0111011',
            '8' => '0110111', '9' => '0001011', '#' => '01010', '*' => '101'
        );

        if ($i >= 7) {
            $map = array(
                '0' => '1110010', '1' => '1100110', '2' => '1101100', '3' => '1000010',
                '4' => '1011100', '5' => '1001110', '6' => '1010000', '7' => '1000100',
                '8' => '1001000', '9' => '1110100', '#' => '01010', '*' => '101'
            );
        }

        if (isset($map[$key])) {
            return new String($map[$key]);
        }

        throw new IllegalArgumentException();
    }

    private function normalize(String $code) {
        $code = $code->substring(0, 11);

        $accumulator = 0;
        foreach ($code->toArray() as $i => $digit) {
            $digit = new Integer($digit);

            if ($i % 2 == 0) {
                $accumulator += $digit() * 3;
            } else {
                $accumulator += $digit();
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

        $this->width = new Integer(95 * $this->barWidth->toInt());
        $this->barcode = new Image($this->width, $this->height);

        $white = new RGB(255, 255, 255);
        $black = new RGB(0, 0, 0);

        $this->barcode->setBackGround($white);

        $x = 0;
        foreach ($this->hash->toArray() as $i => $symbol) {
            $code = $this->codeMap($i, $symbol);

            foreach ($code->toArray() as $bit) {
                $color = $bit == "0" ? $white : $black;

                $bar = new Image($this->barWidth, $this->height);
                $bar->setBackGround($color);

                $this->barcode->add($bar, $x, 0);

                $x += $this->barWidth->toInt();
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