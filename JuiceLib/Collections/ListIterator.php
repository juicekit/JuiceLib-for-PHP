<?php

namespace JuiceLib\Collections;

class ListIterator implements Iterator {

    private $collection;
    private $position = 0;

    public function __construct(GenericList $list) {
        $this->collection = $list->toArray();
    }

    public function current() {
        return $this->collection[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        return $this->collection[$this->position++];
    }

    public function rewind() {
        $this->position = 0;
    }

    public function valid() {
        return isset($this->collection[$this->position]);
    }

    public function hasNext() {
        return $this->valid();
    }

}