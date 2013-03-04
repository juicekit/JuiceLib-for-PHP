<?php

namespace JuiceLib\Collections;

use JuiceLib\Integer,
    \JuiceLib\Exception\IllegalArgumentException;

class ArrayList implements GenericList {

    private $collection = array();
    private $typeStrict = false;
    private $type = null;

    public function __construct($type = null) {
        if (is_object($type)) {
            $this->type = $type;
            $this->typeStrict = true;
        }
    }

    public function getType() {
        return $this->type;
    }

    private function checkType($e) {
        if ($this->isTypeStrict() && !($e instanceof $this->type)) {
            throw new IllegalArgumentException();
        }
    }

    public function isTypeStrict() {
        return $this->typeStrict;
    }

    public function add($e) {

        $this->checkType($e);

        $this->collection[] = $e;
    }

    public function addAll(GenericList $c) {
        $this->collection = array_merge($this->collection, $c->toArray());
    }

    public function clear() {
        $this->collection = array();
    }

    public function contains($e) {
        $this->checkType($e);

        return in_array($e, $this->collection);
    }

    public function containsAll(GenericList $c) {
        throw new \JuiceLib\Exception\UnsupportedOperationException();
    }

    public function equals(GenericList $c) {
        return $this == $c;
    }

    public function get($i) {
        $i = Integer::init($i)->toInt();

        if ($i < $this->size() && isset($this->collection[$i])) {
            return $this->collection[$i];
        }

        return null;
    }

    public function indexOf($e) {
        $this->checkType($e);

        return array_search($e, $this->collection, true);
    }

    public function isEmpty() {
        return $this->size() == 0;
    }

    public function iterator() {
        return new ListIterator($this);
    }

    public function lastIndexOf($e) {
        throw new \JuiceLib\Exception\UnsupportedOperationException();
    }

    public function offsetExists($offset) {
        return isset($this->collection[$offset]);
    }

    public function offsetGet($offset) {
        return $this->get($offset);
    }

    public function offsetSet($offset, $value) {
        $this->set($offset, $value);
    }

    public function offsetUnset($offset) {
        unset($this->collection[$offset]);
    }

    public function remove($e) {
        if (($i == array_search($e, $this->collection)) != false) {
            return $this->collection[$i];
        }

        return null;
    }

    public function removeAll(GenericList $c) {
        throw new \JuiceLib\Exception\UnsupportedOperationException();
    }

    public function retainAll(GenericList $c) {
        throw new \JuiceLib\Exception\UnsupportedOperationException();
    }

    public function set($index, $e) {
        $this->checkType($e);
        $this->collection[$index] = $e;
    }

    public function size() {
        return count($this->collection);
    }

    private function setCollection(array $array) {
        $this->collection = $array;
    }

    public function subList($from, $to) {

        $list = new ArrayList();
        $list->setCollection(array_slice($this->collection, $from, $to - $from));

        return $list;
    }

    public function toArray() {
        return $this->collection;
    }

}