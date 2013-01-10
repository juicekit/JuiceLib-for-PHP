<?php

namespace JuiceLib;

class Output extends Object {

    const STANDARD = 0x0000;
    const HTML = 0x0001;

    private static $context = self::STANDARD;

    public static function context($context) {
        self::$context = $context;
    }

    private static function out($source) {
        switch (self::$context) {
            case self::HTML:
                $source = String::init($source)->replace("\n", "<br/>")->replace("\s", "&nbsp;");
                break;
        }

        return $source;
    }

    public static function show($source) {
        echo self::out($source);
    }

    public static function showline($source = NULL) {
        echo self::show($source . "\n");
    }

    public static function showObject($object) {
        echo self::show(print_r($object, true));
    }

    public static function wrap($wrapper, $variables = array()) {
        ob_start();

        if (is_callable($wrapper)) {
            call_user_func_array($wrapper, $variables);
        }

        $content = ob_get_contents();
        ob_end_clean();

        return $content;
    }

    public static function dump() {
        $source = self::wrap(function() {
                            call_user_func_array('var_dump', func_get_args());
                        }, func_get_args());

        echo self::show($source . "\n");
    }

}
