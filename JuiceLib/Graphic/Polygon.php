<?php

namespace JuiceLib\Graphic;

use JuiceLib\Math,
    JuiceLib\Integer;

class Polygon implements Shape {

    private $x;
    private $y;
    private $r;
    private $p;
    private $initialAngle = 0;

    function __construct($x, $y, $r, $p) {
        $this->x = $x;
        $this->y = $y;
        $this->r = $r;
        $this->p = $p;
    }

    public function setInitialAngle($angle) {
        $angle = Integer::init($angle)->toInt();

        $this->initialAngle = $angle;
    }

    public function getInitialAngle() {
        return $this->initialAngle;
    }

    public function getX() {
        return $this->x;
    }

    public function setX($x) {
        $this->x = $x;
    }

    public function getY() {
        return $this->y;
    }

    public function setY($y) {
        $this->y = $y;
    }

    public function getR() {
        return $this->r;
    }

    public function setR($r) {
        $this->r = $r;
    }

    public function getP() {
        return $this->p;
    }

    public function setP($p) {
        $this->p = $p;
    }

    public function getCoordinates() {
        $angle = 360 / $this->p;

        $coords = new CoordinateList();

        for ($i = 0; $i < $this->p; $i++) {
            $ix = Math::sin(deg2rad($i * $angle + $this->getInitialAngle())) * $this->r;
            $iy = Math::cos(deg2rad($i * $angle + $this->getInitialAngle())) * - 1 * $this->r;


            $coords->add(new Coordinate($this->x + $ix, $this->y + $iy));
        }

        return $coords;
    }

}