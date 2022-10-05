<?php
namespace MouradA\Blog\Models;


use MouradA\Blog\Database\Database;

class ArticleModel implements \MouradA\Blog\Model
{
    private string $tableName = 'articles';
    public function __construct(private Database $database)
    {
    }



}