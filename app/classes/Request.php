<?php

namespace App\classes;


class Request
{
    public static function all($isArray = false)
    {
        $result = [];
        if (count($_GET) > 0) $result['get'] = $_GET;
        if (count($_POST) > 0) $result['post'] = $_POST;
        if (count($_FILES) > 0) $result['files'] = $_FILES;

        return json_decode(json_encode($result), $isArray);
    }
}