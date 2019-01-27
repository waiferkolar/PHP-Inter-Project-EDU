<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-26
 * Time: 17:44
 */

namespace App\Controllers;


use App\classes\FileUpload;
use App\classes\Request;
use App\classes\RequestValidation;
use App\Core\BaseController;


class User extends BaseController
{
    public function login($params = [])
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $request = new Request();

            $policies = [
                'email' => ['required' => true, 'unique' => 'users', 'minLength' => 7],
                'password' => ['required' => true, 'minLength' => 7]
            ];
            $data = [
                'email' => 'waifer@gmail.com',
                'password' => '123',
                'created_at' => '20-20=109'
            ];


            RequestValidation::startValidate($request->all(true)['post'], $policies);
            if (RequestValidation::hashError()) {
                beautify(RequestValidation::getErrors());
            }


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