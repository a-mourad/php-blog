<?php
declare(strict_types=1);
namespace MouradA\Blog;

use MouradA\Blog\Database\Database;
use MouradA\Blog\Helpers\Response;
use MouradA\Blog\Helpers\RouteParser;
use MouradA\Blog\Requests\Request;

class App
{
    public function __construct(
        private Router $router,
        private View $view,
        private Database $database
    )
    {}

    public function run(): void
    {

        try {
            [$controller, $action,$params] = $this->router->resolveRoute();
            $response = $this->handleController($controller, $action,  $params);

            echo $response;
        } catch ( \Exception $exception) {

        }


    }

    private function handleController(string $controller, string $action,$params)
    {

        $class = new $controller($this);

        return $class->$action(new Request($_REQUEST, $params));

    }

    public function getDb()
    {
        return $this->database;
    }

    public function view(string $viewName, array $data=[])
    {
        return $this->view->render($viewName, $data);
    }


}