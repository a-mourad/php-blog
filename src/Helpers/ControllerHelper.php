<?php

namespace MouradA\Blog\Helpers;

class ControllerHelper
{
    public static function check(string $name,string $func, string $method )
    {
        $controller = 'MouradA\\Blog\Controllers\\' . ucfirst($name) . 'Controller';
        if (!class_exists($controller)) {
            return false;
        }

        $func =  strtolower($method). ucfirst($func);

        if (!method_exists($controller, $func)) {
            return false;
        }

        return true;
    }

    public static function resolve(string $name, string $func, string $method, $params)
    {

        $controller = 'MouradA\Blog\Controllers\\' . ucfirst($name) . 'Controller';

        $func =  strtolower($method) . ucfirst($func);

        return [$controller, $func, $params];
    }
}