<?php


namespace App\Controllers;


use App\Core\BaseController;

class Home extends BaseController
{
    public function index($params = [])
    {
        self::view("index", $params);

    }

    public function show()
    {
    }

}