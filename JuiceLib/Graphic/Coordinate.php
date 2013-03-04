<?php

namespace JuiceLib\Graphic;

use JuiceLib\Object,
    JuiceLib\Integer;

class Coordinate extends Object {

    private $x;
    private $y;

    function __construct($x, $y) {
        $this->setX($x);
        $this->setY($y);
    }

    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = Integer::init($x)->toInt();
    }

    public function getY() {
        return $this->y;
    }

    public function setY($y) {
        $this->y = Integer::init($y)->toInt();
    }

}
