<?php
namespace MouradA\Blog\Helpers;
use MouradA\Blog\Router;

class RouteParser
{


    public static function parse(string $url): array
    {
        $url = substr($url, strrpos($url, '.php'));
        $segments = explode('/', $url);
        $controller = $segments[1] ?? null;
        $func = $segments[2] ?? null;
        $params = $segments[3] ?? null;


        return [$controller, $func, $params];
    }

}