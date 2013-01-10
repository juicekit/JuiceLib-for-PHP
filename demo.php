<?php

set_include_path(get_include_path() . PATH_SEPARATOR . 'JuiceLib/');

require_once("Autoloader.php");

use JuiceLib\Autoloader;

Autoloader::init();

use JuiceLib\String,
    JuiceLib\Output,
    JuiceLib\HttpRequest\Get,
    JuiceLib\Integer,
    JuiceLib\Decimal,
    JuiceLib\Math,
    JuiceLib\Session;

$juice = new String("JuiceLib");


Output::context(Output::HTML);

Output::showline($juice);
Output::showline($juice->reverse());
Output::showline($juice->toLowerCase());
Output::showline($juice->toUpperCase());
Output::showline();

$get = new Get();
$get->handle("test", function($g) {
            Output::showObject($g);
            Output::showline();

            Output::showline("test = " . $g['test']);
            Output::showline();
        });

$int5 = new Integer(5);
$int1 = new Integer(1);
$int10 = new Integer(10);
$int16 = new Integer(16);

$decimal5 = new Decimal(5.36);
$decimal6 = new Decimal(6.41);
$decimal2 = new Decimal(2.12);
$decimal0 = new Decimal(0.9);


Output::showline("Smallest (5, 16) = " . Math::min($int5, $int16));
Output::showline("Largest (5, 16) = " . Math::max($int5, $int16));
Output::showline();

Output::showline("Smallest (5, 16, 1, 10, 0.9, 2.12, 6.41, 5.36) = " . Math::min($int5, $int16, $int1, $int10, $decimal0, $decimal2, $decimal6, $decimal5));
Output::showline("Largest (5, 16, 1, 10, 0.9, 2.12, 6.41, 5.36) = " . Math::max($int5, $int16, $int1, $int10, $decimal0, $decimal2, $decimal6, $decimal5));
Output::showline();

$sessionA = new Session("A");

$sessionA->getValue() == null ? $sessionA->setValue("64") : null;

$get->handle("session", function($g, $a) {
            Output::showObject($g);
            $a->setValue($g['session']);
        }, $sessionA);

Output::showline("SessionA = " . $sessionA->getValue());
