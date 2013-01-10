<?php

namespace JuiceLib\HttpRequest;

class Post extends HttpRequest {

    public function __construct() {
        $this->values = $_POST;
    }

}
