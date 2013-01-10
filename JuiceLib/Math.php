<?php

namespace JuiceLib;

class Math {

    public static function max(Comparable $a, Comparable $b) {
        $size = func_num_args();

        if ($size == 2) {
            return $a->compareTo($b) > 0 ? $a : $b;
        }

        $max = $a;

        foreach (func_get_args() as $arg) {
            if ($arg instanceof Comparable) {
                if ($arg->compareTo($max) > 0) {
                    $max = $arg;
                }
            }
        }

        return $max;
    }

    public static function min(Comparable $a, Comparable $b) {
        $size = func_num_args();

        if ($size == 2) {
            return $a->compareTo($b) < 0 ? $a : $b;
        }

        $min = $a;

        foreach (func_get_args() as $arg) {
            if ($arg instanceof Comparable) {
                if ($arg->compareTo($min) < 0) {
                    $min = $arg;
                }
            }
        }

        return $min;
    }

}