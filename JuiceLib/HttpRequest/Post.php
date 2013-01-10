<?php

namespace JuiceLib\HttpRequest;

use JuiceLib\String;

class Post extends HttpRequest {

    public function __construct() {
        $this->method = self::POST;

        $this->values = $_POST;
    }

    public function send($url, $query = NULL, $callback = NULL, $type = NULL, $params = array()) {

        $query = is_array($query) ? http_build_query($query) : $query;

        if ($this->propagated($query)) {
            return false;
        }

        $request = $this->request($url, $query);

        if (is_callable($callback)) {

            $params = is_array($params) ? $params : array();

            switch (String::init($type)->toLowerCase()) {
                case "json":
                    array_unshift($params, json_decode($request));
                    break;
                default:
                    array_unshift($params, $request);
            }

            $this->callback($callback, $params);
        }

        return $this;
    }

}

