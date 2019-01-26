<?php

namespace App\classes;


class Session
{
    public static function add($key, $value)
    {
        if (!self::has($key)) {
            $_SESSION[$key] = $value;
        }
    }

    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    public static function remove($key)
    {
        if (self::has($key)) {
            unset($_SESSION[$key]);
        }
    }

    public static function replace($key, $value)
    {
        if (self::has($key)) {
            self::remove($key);
            self::add($key, $value);
        }
    }

    public static function get($key)
    {
        if (self::has($key)) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function flash($key, $value = "")
    {
        if (!empty($value)) {
            self::add($key, $value);
        } else {
            echo self::get($key);
            self::remove($key);
        }
    }

}