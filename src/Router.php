<?php
declare(strict_types=1);

namespace MouradA\Blog;


use MouradA\Blog\Helpers\ControllerHelper;
use MouradA\Blog\Helpers\RouteParser;

class Router
{
    public function __construct(private string $url, private string $method)
    {
    }

    public function getUrl():string
    {
        return $this->url;
    }

    public function resolveRoute()
    {
        [$controller, $func, $params] = RouteParser::parse($this->url);
        $parse = ControllerHelper::check(name: $controller, func: $func ,method: $this->method);

        if (!$parse){
            throw new \Exception('Route not found');
        }
        return ControllerHelper::resolve(name: $controller, func: $func ,method: $this->method,params:$params);
    }

}