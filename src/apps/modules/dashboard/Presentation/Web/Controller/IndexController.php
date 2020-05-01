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

class IndexController extends Controller
{
    public function indexAction()
    {
        $currentPage = $this->request->getQuery('page', 'int', 1);
        
        $builder = $this
            ->modelsManager
            ->createBuilder()
            ->columns("id, username, title, content, comments, created_at")
            ->from(Posts::class)
            ->orderBy("created_at DESC");
    
        $paginator = new QueryBuilder(
            [
                "builder" => $builder,
                "limit"   => 10,
                "page"    => $currentPage,
            ]
        );

        $page = $paginator->paginate();
        
        $this->view->setVar('page', $page);
    }

    public function searchAction(){
        $searched = $this->request->getQuery('search', 'string', null);
        $listSearched = $this
            ->modelsManager
            ->executeQuery(
                'SELECT * FROM Models\Posts WHERE title LIKE :title: ORDER BY upvote DESC',
                [
                    'title' => $searched,
                ]
            );
        
        $this->view->posts = $listSearched;
    }
}