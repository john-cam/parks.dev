<?php

class Model
{
    private $attribute = [];

    public function __set($name, $value) {
        $this->attribute[$name] = $value;
    }

    public function __get($name) {
        if(array_key_exists($name, $this->attribute)) {
            return $this->attribute[$name];
        }
        return null;
    }
}
