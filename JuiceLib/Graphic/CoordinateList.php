<?php

namespace JuiceLib\Graphic;

use JuiceLib\Collections\ArrayList,
    JuiceLib\Exception\IllegalArgumentException;

class CoordinateList extends ArrayList {

    private $minX = 0;
    private $minY = 0;
    private $maxX = 0;
    private $maxY = 0;

    public function __construct() {
        parent::__construct();
    }

    public function add($e) {
        if (!($e instanceof Coordinate)) {
            throw new IllegalArgumentException();
        }

        if ($e->getX() < $this->minX) {
            $this->minX = $e->getX();
        }
        if ($e->getX() > $this->maxX) {
            $this->maxX = $e->getX();
        }

        if ($e->getY() < $this->minY) {
            $this->minY = $e->getY();
        }
        if ($e->getY() > $this->maxY) {
            $this->maxY = $e->getY();
        }


        parent::add($e->getX());
        parent::add($e->getY());
    }

    public function size() {
        return parent::size() / 2;
    }

    public function getWidth() {
        return $this->maxX - $this->minX;
    }

    public function getHeight() {
        return $this->maxY - $this->minY;
    }

}