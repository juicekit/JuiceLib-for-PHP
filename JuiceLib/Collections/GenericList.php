<?php

namespace JuiceLib\Collections;

interface GenericList extends \ArrayAccess {

    public function toArray();

    public function add($e);

    public function addAll(GenericList $c);

    public function clear();

    public function contains($e);

    public function containsAll(GenericList $c);

    public function equals(GenericList $c);

    public function get($i);

    public function indexOf($e);

    public function isEmpty();

    public function iterator();

    public function lastIndexOf($e);

    public function remove($e);

    public function removeAll(GenericList $c);

    public function retainAll(GenericList $c);

    public function set($index, $e);

    public function size();

    public function subList($from, $to);
}
