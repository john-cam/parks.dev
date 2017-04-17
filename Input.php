<?php

class Input
{
    public static function getNumber($key) {
        $value = self::getValue($key);
        if(!is_numeric($value)) {
            throw new Exception("Input must be a number.");
        }
        return $value;
    }

    public static function getString($key) {
        $value = self::getValue($key);
        if(!is_string($value)) {
            throw new Exception("Input must be a string.");
        }
        return $value;
    }

    public static function hasKey($key) {
        return isset($_REQUEST[$key]);
    }

    public static function getValue($key, $default = null) {
        if(self::hasKey($key)) {
            return $_REQUEST[$key];
        } else {
            return $default;
        }
    }
}