<?php

namespace JuiceLib;

class Math {

    public static function sin($arg) {
        return sin($arg);
    }

    public static function cos($arg) {
        return cos($arg);
    }

    public static function tan($arg) {
        return tan($arg);
    }

    public static function deg2rad($arg) {
        return deg2rad($arg);
    }

    public static function pi() {
        return pi();
    }

    public static function round($number, $decimal = 0) {
        if ($decimal != 0) {
            return new Decimal(round($number, Integer::init($decimal)->toInt()));
        }

        return new Integer(round($number));
    }

    public static function floor($number) {
        if ($number instanceof Number) {
            return new Integer($number->toInt());
        }

        return new Integer(intval($number));
    }

    public static function ceil($number) {
        if ($number instanceof Number) {
            return new Integer($number->toInt() + 1);
        }

        return new Integer(intval($number) + 1);
    }

    public static function isDecimal($number) {
        if ($number instanceof Decimal) {
            return true;
        }

        return is_float($number);
    }

    public static function isInteger($number) {
        if ($number instanceof Integer) {
            return true;
        }
        return is_int($number);
    }

    public static function abs($number) {

        if ($number < 0) {
            $number *= -1;
        }

        if (self::isDecimal($number)) {
            return new Decimal($number);
        }

        return new Integer($number);
    }

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