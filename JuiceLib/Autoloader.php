<?php

namespace JuiceLib;

class Autoloader {

    public static function init() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    private static function autoload($class) {
        $path = str_replace(array(__NAMESPACE__, "\\"), array(NULL, "/"), $class) . ".php";
        include_once($path);
    }

}