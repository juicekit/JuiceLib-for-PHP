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
    JuiceLib\Session,
    JuiceLib\HttpRequest\Post,
    JuiceLib\Graphic\Color\Hex,
    JuiceLib\Graphic\Color\RGB,
    JuiceLib\Graphic\Image,
    JuiceLib\Plugin\Juice\Barcode\UPC;

$juice = new String("JuiceLib");

Output::context(Output::HTML);

Output::showline($juice);
Output::showline($juice->reverse());
Output::showline($juice->toLowerCase());
Output::showline($juice->toUpperCase());
Output::showline();

$get = new Get();

$post = new Post();


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

Output::showline();

$post->handle("var1", function($s) {
    Output::showline(json_encode($s));
})->send("http://workspace/", array("var1" => "Hello", "var2" => "World"), function($response) {
    Output::showline($response);
})->send("http://workspace/", "var1=Hello&var2=World&var3=Finally", function($response) {
    Output::showline($response);
});


Output::showline();

$get->handle("var1", function($s) {
    Output::showline(json_encode($s));
})->send("http://workspace/", array("var1" => "Hello", "var2" => "World"), function($response) {
    Output::showline($response);
})->send("http://workspace/", "var1=Hello&var2=World&var3=Finally", function($response) {
    Output::showline($response);
});

$red = new Hex("#F00");
Output::showline("Red Box 200 x 200px");
$box = new Image(200, 200);
$box->setBackGround($red);
Output::showHTML("<img src=\"{$box->embed()}\" />");
Output::showline();
Output::showline();

$RGB_red = new RGB(255, 0, 0);
Output::showline("Red Box 200 x 200px - Using RGB");
$box1 = new Image(200, 200);
$box1->setBackGround($RGB_red);
Output::showHTML("<img src=\"{$box1->embed()}\" />");
Output::showline();
Output::showline();

$green = new RGB(0, 255, 0);
$blue = new Hex("0000ff");
$white = new RGB(255, 255, 255);

Output::showline("Multiple Boxes 600 x 200px - Using RGB and Hex");
$bigbox = new Image(600, 200);
$bigbox->setBackGround($white);

$box_a = new Image(200, 200);
$box_a->setBackGround($red);

$bigbox->add($box_a, 0, 0);

$box_b = new Image(200, 200);
$box_b->setBackGround($green);
$bigbox->add($box_b, 200, 0);


$box_c = new Image(200, 200);
$box_c->setBackGround($blue);
$bigbox->add($box_c, 400, 0);

Output::showHTML("<img src=\"{$bigbox->embed()}\" />");
Output::showline();
Output::showline();


$upc = new UPC("235635632265");
$upc->setBarWidth(2);
$upc->setHeight(60);

Output::showline("UPC barcode code = " . $upc->getCode());
Output::showHTML("<img src=\"{$upc->embed()}\" />");
Output::showline();
Output::showline();

