<?php

namespace MouradA\Blog\Helpers;

class ControllerHelper
{
    public static function parse(string $name,string $func, string $method )
    {
        $controller = 'MouradA\Blog\Controllers\\' . ucfirst($name) . 'Controller';
        if (!class_exists($controller)) {
            return false;
        }

        $class =  new $controller();
        $func = ucfirst(strtolower($method)) . ucfirst($func);
        if (!method_exists($class, $func)) {
            return false;
        }

        return true;
    }

    public static function resolve(string $name, string $func, string $method, $params)
    {
        $controller = 'MouradA\Blog\Controllers\\' . ucfirst($name) . 'Controller';
        if (!class_exists($controller)) {
            return false;
        }

        $class =  new $controller();
        $func = ucfirst(strtolower($method)) . ucfirst($func);
        if (!method_exists($class, $func)) {
            return false;
        }

        return [$class, $func,$method, $params];
    }
}