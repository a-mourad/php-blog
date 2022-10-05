<?php
declare(strict_types=1);
namespace MouradA\Blog;

abstract class Controller
{
    public function __construct(protected App $app)
    {
    }
}