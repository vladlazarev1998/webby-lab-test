<?php

namespace System;

class App
{

    public static function run()
    {
        $path = $_SERVER['REQUEST_URI'];
        $pathParts = explode('/', $path);
        $controller = $pathParts[1];
        $action = $pathParts[2];
        if(!$action){
            $action = 'index';
        }else{
            if(strripos($action, '?') != false){
                $parts = preg_split('/\?.*/', $action);
                $action = $parts[0];
            }
            $action = 'action' . ucfirst($action);
        }

        if(!$controller){
            $controller = 'App\\Controllers\\HomeController';
        }else{
            if(strripos($controller, '?') != false){
                $parts = preg_split('/\?.*/', $controller);
                $controller = $parts[0];
            }
            $controller = 'App\\Controllers\\' . $controller . 'Controller';
        }

        if (!file_exists(ROOT_DIR . "\\" . $controller . '.php')) {
            $controller = 'App\\Controllers\\ErrorController';
        }

        $objController = new $controller;

        if (!method_exists($objController, $action)) {
            $action = 'index';
        }

        $objController->$action();
    }
}

