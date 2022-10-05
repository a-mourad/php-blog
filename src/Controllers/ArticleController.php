<?php
namespace MouradA\Blog\Controllers;

use MouradA\Blog\App;
use MouradA\Blog\Controller;
use MouradA\Blog\Model;
use MouradA\Blog\Models\ArticleModel;
use MouradA\Blog\Requests\Request;

class ArticleController extends Controller
{
    private Model $articleModel;
    public function __construct(App $app)
    {
        parent::__construct($app);
        $this->articleModel = new ArticleModel($app->getDb());
    }

    public function getIndex()
    {

    }

    public function getShow(int $articleId)
    {
        $data= [];


        return $this->app->view('article_index', $data);
    }

    public function deleteDestroy()
    {

    }

    public function postCreate(Request $request )
    {

    }

    public function postUpdate(int $articleId , Request $request)
    {

    }
}