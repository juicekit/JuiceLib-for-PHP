<?php

namespace JuiceLib\Enviroment;

use JuiceLib\Object;

class Client extends Object {

    private $vars = array();

    public function __construct() {
        $this->vars = $_SERVER;
    }

    public function getIP() {
        return $this->vars["REMOTE_ADDR"];
    }

    public function getLanguage() {
        return $this->vars["HTTP_ACCEPT_LANGUAGE"];
    }

    public function getUserAgent() {
        return $this->vars["HTTP_USER_AGENT"];
    }

    public function getEncoding() {
        return $this->vars["HTTP_ACCEPT_ENCODING"];
    }

    public function getCharset() {
        return $this->vars["HTTP_ACCEPT_CHARSET"];
    }

    public function getConnection() {
        return $this->vars["HTTP_CONNECTION"];
    }

    public function getCacheControl() {
        return $this->vars["HTTP_CACHE_CONTROL"];
    }

    public function getAccepts() {
        return $this->vars["HTTP_ACCEPT"];
    }

    public function getPort() {
        return $this->vars["REMOTE_PORT"];
    }

}