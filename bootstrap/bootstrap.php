<?php

declare(strict_types=1);
const APP_DIRECTORY = __DIR__ . '/../';

$dotenv = Dotenv\Dotenv::createImmutable(APP_DIRECTORY);
$dotenv->load();

return new \MouradA\Blog\App(
    router: new \MouradA\Blog\Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']),
    view: new \MouradA\Blog\View(),
    model: new \MouradA\Blog\Model()
);