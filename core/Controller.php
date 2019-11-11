<?php

namespace App\Core;

class Controller

{

    public function callAction($controller, $action)
    {
        $controller = "App\\Controllers\\{$controller}";
        $controller = new $controller;
        if (method_exists($controller, $action)) {
            return $controller->$action();
        } else {
            return view('404');
        }
    }

}