<?php

namespace JuiceLib;

class Session extends Object {

    private $name;
    private $value = null;

    public function __construct($name) {
        $this->name = $name;

        $this->startSession();
    }

    private function startSession() {
        if (session_id() == "") {
            session_start();
        }

        if (isset($_SESSION[$this->name])) {
            $this->value = $_SESSION[$this->name];
        }
    }

    public function __destruct() {
        $this->saveState();
    }

    private function saveState() {
        $_SESSION[$this->name] = $this->value;
    }

    public function rename($name) {

        if (!String::init($name)->equalsIgnoreCase(new String($this->name))) {
            $_SESSION[$name] = $_SESSION[$this->name];
            unset($_SESSION[$this->name]);

            $this->name = $name;
        }
    }

    public function copy($name) {

        if (!String::init($name)->equalsIgnoreCase(new String($this->name))) {
            $_SESSION[$name] = $_SESSION[$this->name];

            return new Session($name);
        }

        return $this;
    }

    public function destroy() {
        if (isset($_SESSION[$this->name])) {

            $this->value = NULL;

            unset($_SESSION[$this->name]);
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getValue() {
        return $this->value;
    }

    public function toString() {
        return $this->getValue();
    }

    public function setValue($value) {
        $this->value = $value;
    }

}