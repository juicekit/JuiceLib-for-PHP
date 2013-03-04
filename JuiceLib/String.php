<?php

namespace JuiceLib;

use JuiceLib\Exception\IllegalArgumentException;

class String extends Object implements Comparable, Initializer {

    private $string;

    public static function init($string) {
        return new String($string);
    }

    public function __construct($string = "") {

        if ($string instanceof $this) {
            $this->string = $string->toString();
        } else if (!is_object($string)) {
            $this->string = "{$string}";
        } else {
            throw new IllegalArgumentException();
        }
    }

    public function hashCode() {
        return md5($this->string);
    }

    public function indexOf($char, $case_sensitive = TRUE) {
        if ($case_sensitive) {
            return strpos($this->string, $char);
        }

        return stripos($this->string, $char);
    }

    public function lastIndexOf($char, $case_sensitive = TRUE) {
        if ($case_sensitive) {
            return strrpos($this->string, $char);
        }

        return strripos($this->string, $char);
    }

    public function substring($start, $count) {
        return new String(substr($this->string, $start, $count));
    }

    public function toUpperCase() {
        return new String(strtoupper($this->string));
    }

    public function toLowerCase() {
        return new String(strtolower($this->string));
    }

    public function replace($pattern, $replacement) {
        return new String(preg_replace("/{$pattern}/", $replacement, $this->string));
    }

    public function length() {
        return strlen($this->string);
    }

    public function asHtml() {
        return new String(htmlentities($this->string));
    }

    public function charAt($pos) {
        return new String(substr($this->string, $pos, 1));
    }

    public function equalsIgnoreCase(String $str) {
        return $this->toLowerCase()->equals($str->toLowerCase());
    }

    public function compareTo(Comparable $str) {
        return strcmp($this, $str);
    }

    public function compareToIgnoreCase(String $str) {
        return strcasecmp($this->toLowerCase(), $str->toLowerCase());
    }

    public function trim($str = NULL) {
        if (!empty($str)) {
            return new String(trim($this->string, $str));
        }

        return new String(trim($this->string));
    }

    public function split($pattern) {
        return preg_split("/{$pattern}/", $this->string);
    }

    public function toArray() {
        return str_split($this->string);
    }

    public function reverse() {
        return new String(strrev($this->string));
    }

    public function toString() {
        return $this->string;
    }

}