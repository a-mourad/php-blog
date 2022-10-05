<?php
namespace MouradA\Blog\Controllers;

use MouradA\Blog\App;
use MouradA\Blog\Controller;
use MouradA\Blog\Model;
use MouradA\Blog\Models\ArticleModel;

class ArticleController extends Controller
{
    private Model $articleModel;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->articleModel = new ArticleModel($app->getDb());
    }

    public function getIndex($params = [])
    {

    }

    public function getShow($params = [])
    {
        echo 'test';
    }

    public function deleteDestroy()
    {

    }

    public function postCreate($params = [], $data = [])
    {

    }

    public function postUpdate($params = [], $data = [])
    {

    }
}