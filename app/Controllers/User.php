<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-26
 * Time: 17:44
 */

namespace App\Controllers;


use App\Core\BaseController;

class User extends BaseController
{
    public function login($params = [])
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            beautify($_POST);
            beautify($_FILES);
        } else {
            $user = new \App\Models\User();
            $obj = [
                "users" => $user->all(),
                "params" => $params
            ];
            $obj = json_decode(json_encode($obj));
            self::view('login', $obj);
        }

    }
}