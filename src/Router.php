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
        $resolve = ControllerHelper::parse(name: $controller, func: $func ,method: $this->method);
        if (!$resolve){
            throw new \Exception('');
        }
        return ControllerHelper::resolve(name: $controller, func: $func ,method: $this->method,params:$params);
    }

}