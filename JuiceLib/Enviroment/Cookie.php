<?php

namespace JuiceLib\Enviroment;

use JuiceLib\Object,
    JuiceLib\String,
    JuiceLib\Integer;

class Cookie extends Object {

    private $name;
    private $value;
    private $expires;

    public function __construct($name, $expires = 0) {
        $this->name = String::init($name)->toString();

        $this->expires = time() + $expires;
    }

    public function setExpires($s = 0, $m = 0, $h = 0) {
        $s = Integer::init($s)->toInt();
        $m = Integer::init($m)->toInt();
        $h = Integer::init($h)->toInt();

        $this->expires += $s * $m * $h;
    }

    public function getExpires() {
        return $this->expires;
    }

    public function getvalue() {
        return empty($_COOKIE[$this->name]) ? "{$this->value}" : $_COOKIE[$this->name];
    }

    public function __toString() {
        return $this->getvalue();
    }

    public function setValue($value) {
        $this->value = $value;

        setcookie($this->name, $value, $this->expires);
    }

}