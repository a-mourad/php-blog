<?php
namespace MouradA\Blog\Models;


use MouradA\Blog\Database\Database;

class UserModel implements \MouradA\Blog\Model
{
    private string $tableName = 'users';
    public function __construct(private Database $database)
    {
    }




}