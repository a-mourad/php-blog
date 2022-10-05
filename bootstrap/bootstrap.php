<?php

declare(strict_types=1);

use MouradA\Blog\App;
use MouradA\Blog\Database\Database;
use MouradA\Blog\Router;
use MouradA\Blog\View;

const APP_DIRECTORY = __DIR__ . '/../';

$dotenv = Dotenv\Dotenv::createImmutable(APP_DIRECTORY);
$dotenv->load();

return new App(
    router: new Router($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']),
    view: new View(),
    database: new Database()
);