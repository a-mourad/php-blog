<?php

class Router
{
    public function __construct(
        private string $uri,
        private string $method
    )
    {
    }
}