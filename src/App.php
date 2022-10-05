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

    public function run(): void
    {
        try {
            [$controller, $action,$method,$params] = $this->router->resolveRoute();
            $response = $this->handleController($controller, $action);

            echo $response;
        } catch ( \Exception $exception) {
        }


    }

    private function handleController(string $controller, string $action,$params)
    {
        return call_user_func_array([$controller, $action], [$params, $_POST]);
    }

}