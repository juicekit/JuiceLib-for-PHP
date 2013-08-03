<?php

namespace JuiceLib\Graphic;

use JuiceLib\Math,
    JuiceLib\Integer;

class Star implements Shape {

    private $x;
    private $y;
    private $r;
    private $p;
    private $initialAngle = 0;

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

    public function __construct($x, $y, $r) {

        $this->x = $x;
        $this->y = $y;
        $this->r = $r;

        $this->p = new Polygon($x, $y, $r, 5);
    }

    public function setInitialAngle($angle) {
        $angle = Integer::init($angle)->toInt();

        $this->initialAngle = $angle;
    }

    public function getInitialAngle() {
        return $this->initialAngle;
    }

    public function getCoordinates() {
        $angle = 360 / $this->p->getP();

        $this->p->setInitialAngle($this->getInitialAngle());

        $ec = $this->p->getCoordinates()->iterator();

        $coords = new CoordinateList();

        for ($i = 1; $i <= $this->p->getP(); $i++) {
            //golden ratio = 1.618
            //$ix = .389 * Math::sin(deg2rad(($i - .5) * $angle + $this->getInitialAngle())) * $this->r;
            $ix = .382 * Math::sin(deg2rad(($i - .5) * $angle + $this->getInitialAngle())) * $this->r;
            //$iy = .389 * Math::cos(deg2rad(($i - .5) * $angle + $this->getInitialAngle())) * - 1 * $this->r;
            $iy = .382 * Math::cos(deg2rad(($i - .5) * $angle + $this->getInitialAngle())) * - 1 * $this->r;


            $coords->add(new Coordinate($ec->next(), $ec->next()));
            $coords->add(new Coordinate($this->x + $ix, $this->y + $iy));
        }

        return $coords;
    }

}
