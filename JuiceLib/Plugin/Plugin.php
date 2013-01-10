<?php

namespace JuiceLib\Plugin;

use JuiceLib\Object;

abstract class Plugin extends Object {

    abstract public function getVersion();

    abstract public function getAuthor();

    abstract public function getReleaseDate();
}
