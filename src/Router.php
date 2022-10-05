<?php
declare(strict_types=1);

namespace MouradA\Blog;


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

    public function resolve()
    {
        
    }

}