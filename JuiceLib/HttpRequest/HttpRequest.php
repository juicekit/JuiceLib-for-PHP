<?php

namespace JuiceLib\HttpRequest;

abstract class HttpRequest {

    protected $values;

    public function handle($key, $handler) {
        if (!empty($this->values[$key]) && is_callable($handler)) {
            $parameters = array();
            if (func_num_args() > 2) {
                $parameters = func_get_args();

                array_shift($parameters);
            }
            $parameters[0] = $this->values;

            return call_user_func_array($handler, $parameters);
        }

        return false;
    }

}
