<?php
namespace MouradA\Blog\Helpers;
use MouradA\Blog\Router;

class RouteParser
{


    public static function parse(string $url): array
    {
        $segments = explode('/', $url);
        $controller = $segments[1] ?? null;
        $func = $segments[2] ?? null;

        return [$controller, $func];
    }

}