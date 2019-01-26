<?php

namespace App\classes;


class CSRFToken
{
    public static function _token()
    {
        if (Session::has("token")) {
            return Session::get("token");
        } else {
            $token = base64_encode(openssl_random_pseudo_bytes(16));
            Session::add("token", $token);
            return $token;
        }
    }

    public static function checkToken($token)
    {
        if (Session::has("token")) {
            if (Session::get("token") === $token) {
                Session::remove("token");
                return true;
            }
        } else {
            return false;
        }
    }
}