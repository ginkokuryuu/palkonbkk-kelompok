<?php

namespace Its\Example\Dashboard\Presentation\Web\Controller;

use Phalcon\Mvc\Controller;
use Models\Users;
use Models\Posts;
use Phalcon\Paginator\PaginatorFactory;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Paginator\Adapter\QueryBuilder;
use Phalcon\Paginator\Adapter\Model as PaginatorModel;

class SearchController extends Controller
{
    public function indexAction()
    {
        $searched = $_POST;

        $title = "%" . $searched['title'] . "%";

        $listSearched = $this
            ->modelsManager
            ->executeQuery(
                'SELECT * FROM Models\Posts WHERE title LIKE :title: ORDER BY created_at DESC',
                [
                    'title' => $title,
                ]
            );
        
        $this->view->posts = $listSearched;
    }
}