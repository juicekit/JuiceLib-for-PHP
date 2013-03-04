<?php

namespace JuiceLib\Enviroment;

use JuiceLib\Object;

class Server extends Object {

    private $vars = array();

    public function __construct() {
        $this->vars = $_SERVER;
    }

    public function getHeaders() {
        return headers_list();
    }

    public function removeHeader($name) {
        header_remove($name);
    }

    public function addHeader($key, $value) {
        header("{$key}:{$value}");
    }

    public function getHost() {
        return $this->vars['HTTP_HOST'];
    }

    public function getIP() {
        return $this->vars['SERVER_ADDR'];
    }

    public function getSignature() {
        return $this->vars['SERVER_SIGNATURE'];
    }

    public function getName() {
        return $this->vars['SERVER_NAME'];
    }

    public function getSoftware() {
        return $this->vars['SERVER_SOFTWARE'];
    }

    public function getProtocol() {
        return $this->vars['SERVER_PROTOCOL'];
    }

    public function getRequestMethod() {
        return $this->vars['REQUEST_METHOD'];
    }

    public function getRequestTime() {
        return $this->vars['REQUEST_TIME'];
    }

    public function getDocumentRoot() {
        return $this->vars['DOCUMENT_ROOT'];
    }

    public function getReferer() {
        return $this->vars['HTTP_REFERER'];
    }

    public function getCurrentPath() {
        return $this->vars['SCRIPT_FILENAME'];
    }

    public function getAdmin() {
        return $this->vars['SERVER_ADMIN'];
    }

    public function getPort() {
        return $this->vars['SERVER_PORT'];
    }

    public function getScriptName() {
        return $this->vars['SCRIPT_NAME'];
    }

    public function getURI() {
        return $this->vars['REQUEST_URI'];
    }

    public function getAuthUser() {
        return $this->vars['PHP_AUTH_USER'];
    }

    public function getAuthPassword() {
        return $this->vars['PHP_AUTH_PW'];
    }

    public function getAuthType() {
        return $this->vars['AUTH_TYPE'];
    }

}

?>
