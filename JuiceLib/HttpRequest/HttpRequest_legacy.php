<?php

namespace JuiceLib\HttpRequest;

use \JuiceLib\Object,
    \JuiceLib\Exception\FileNotFoundException;

abstract class HttpRequest_original extends Object {

    protected $values;

    public function handle($key, $handler, $params = array()) {
        if (!empty($this->values[$key]) && is_callable($handler)) {

            array_unshift($params, $this->values);

            $this->callback($handler, $params);
        }

        return $this;
    }

    protected function request($url, $context = NULL, $query = NULL) {

        $handle = NULL;

        if (is_null($context)) {
            $handle = @fopen($url . (is_null($query) ? null : "?" . $query), "r", true);
        } else {
            $handle = @fopen($url . (is_null($query) ? null : "?" . $query), "r", true, $context);
        }

        if ($handle == FALSE) {
            throw new FileNotFoundException();
        }

        $contents = "";
        while (!feof($handle)) {
            $contents .= fread($handle, 8192);
        }
        fclose($handle);

        return $contents;
    }

    abstract public function send($url, $options, $callback, $type, $params);
}