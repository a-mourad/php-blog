<?php
namespace MouradA\Blog\Controllers;

use MouradA\Blog\App;
use MouradA\Blog\Controller;
use MouradA\Blog\Model;
use MouradA\Blog\Models\UserModel;

class UserController extends Controller
{
    private Model $user;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->user = new UserModel($app->getDb());
    }


    public function postLogin($params = [], $data = [])
    {

    }

    public function getLogout()
    {

    }
}