<?php

namespace App\routes;


use App\Controllers\Home;
use App\Controllers\User;

class Router
{
    private $className = "Home";
    private $methodName = "index";
    private $params = [];

    public function __construct()
    {
        $this->startRouting();
    }

    public function startRouting()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "";

        $urlAry = explode("/", rtrim($url, "/"));

        if (!empty($urlAry[0])) {
            $this->className = $urlAry[0];
            unset($urlAry[0]);
        }

        if (!empty($urlAry[1])) {
            $this->methodName = $urlAry[1];
            unset($urlAry[1]);
        }

        $this->className = "\App\Controllers\\" . $this->className;

        $params = array_values($urlAry);


        call_user_func([$this->className, $this->methodName], $params);


    }
}