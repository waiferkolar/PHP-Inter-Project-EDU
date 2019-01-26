<?php
/**
 * Created by PhpStorm.
 * User: waiferkolar
 * Date: 2019-01-26
 * Time: 17:52
 */

namespace App\Core;


class BaseController
{

    public function view($name, $params = [])
    {
        require_once(APP_ROOT . "/views/" . $name . ".php");
    }
}