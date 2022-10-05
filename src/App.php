<?php
declare(strict_types=1);
namespace MouradA\Blog;

use MouradA\Blog\Helpers\Response;
use MouradA\Blog\Helpers\RouteParser;

class App
{
    public function __construct(
        private Router $router,
        private View $view,
        private Model $model
    )
    {}

    public function run()
    {
        try {
            $parsedRoute = RouteParser::parse($this->router->getUrl());
            $response = $this->executeController($parsedRoute);
            return  new Response($response);
        }catch (\Exception $exception ){
            //
        }


    }

}