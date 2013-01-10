<?php

namespace JuiceLib;

abstract class Object {

    public function equals(Object $object) {
        return $this->hashCode() == $object->hashCode();
    }

    public function hashCode() {
        return md5(serialize($this));
    }

    public function toString() {
        return $this->hashCode();
    }

    public function __toString() {
        return $this->toString();
    }

    protected function callback($function, $params) {

        if (is_callable($function)) {

            call_user_func_array($function, $params);
        }
    }

}

