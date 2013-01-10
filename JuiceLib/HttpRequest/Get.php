<?php

namespace JuiceLib\HttpRequest;

class Get extends HttpRequest {

    public function __construct() {
        $this->values = $_GET;
    }

}
