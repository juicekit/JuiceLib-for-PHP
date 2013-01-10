<?php

namespace JuiceLib\Exception;

class UnsupportedOperationException extends Exception {

    public function __construct() {
        parent::__construct(__CLASS__, 8426);
    }

}