<?php

namespace JuiceLib\HttpRequest;

use \JuiceLib\Object,
    \JuiceLib\Exception\FileNotFoundException;

abstract class HttpRequest extends Object {

    const POST = "POST";
    const GET = "GET";

    protected $values;
    protected $properties = array();
    protected $method;

    protected function isActive($key) {
        return !empty($this->values[$key]);
    }

    protected function propagated($query) {
        $current = array();
        parse_str($query, $current);

        foreach ($current as $k => $v) {
            if ($this->isActive($k)) {
                return true;
            }
        }

        return false;
    }

    public function handle($key, $handler, $params = array()) {
        if ($this->isActive($key) && is_callable($handler)) {

            array_unshift($params, $this->values);

            $this->callback($handler, $params);
        }

        return $this;
    }

    protected function request($url, $query = NULL) {

        $components = parse_url($url);

        $port = 80;
        if ($components['scheme'] == 'https') {
            $port = 443;
        }

        $handle = fsockopen($components['host'], $port);

        if (!$handle) {
            throw new FileNotFoundException();
        }

        if (!isset($components['path'])) {
            $path = "/";
        } else {
            $path = $components['path'];
        }

        fwrite($handle, "{$this->method} {$path}" . ($this->method == self::GET ? "?" . $query : "") . " HTTP/1.1\r\n");

        fwrite($handle, "Host: {$components['host']}\r\n");
        fwrite($handle, "Content-Type: application/x-www-form-urlencoded\r\n");
        fwrite($handle, "Content-Length: " . strlen($query) . "\r\n");
        fwrite($handle, "Connection: close\r\n");
        fwrite($handle, "\r\n");
        fwrite($handle, $query);

        $header = "";
        do {
            $header .= fgets($handle, 128);
        } while (strpos($header, "\r\n\r\n") === false);

        $contents = "";
        while (!feof($handle)) {
            $contents .= fgets($handle, 1024);
        }

        fclose($handle);

        return $contents;
    }

    abstract public function send($url, $query, $callback, $type, $params);

    public function __get($name) {
        return isset($this->values[$name]) ? $this->values[$name] : null;
    }

}

