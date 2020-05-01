<?php

namespace Its\Example\Dashboard\Presentation\Web\Controller;

use Phalcon\Mvc\Controller;
use Models\Users;
use Models\Posts;
use Models\Comments;
use Phalcon\Mvc\Model\Query;
use Phalcon\Mvc\Model\Query\Builder;
use Phalcon\Mvc\Model\Manager;

class PostController extends Controller
{
    public function indexAction()
    {

    }

    public function newAction(){

    }

    public function createAction(){
        if($this->session->has('auth')){
            if($this->request->isPost()){
                $data = $_POST;
                $data['username'] = $this->session->get('auth')['username'];
                $data['comments'] = 0;

                $newPost = new Posts();
                $newPost->registration($data);

                if($newPost->save()){
                    $this->dispatcher->forward([
                        'controller' => 'index',
                        'action'     => 'index',
                    ]);
                }
                else{
                    $message = "Sorry, the following problems were generated:<br>"
                    . implode('<br>', $newPost->getMessages());

                    $this->view->message = $message;
                }
            }
        }
    }

    public function editAction($postid){
        if($this->session->has('auth')){
            $post = Posts::findFirstById($postid);

            if($post){
                if($post->username == $this->session->get('auth')['username']){
                    $this->view->post = $post;
                }
            }
        }
    }

    public function saveAction($postid){
        if($this->session->has('auth')){
            $post = Posts::findFirstById($postid);

            if($post){
                if($post->username == $this->session->get('auth')['username']){
                    $data = $_POST;
                    $post->updateData($data);

                    $param = [];
                    $param['postid'] = $postid;

                    if($post->save()){
                        $this->dispatcher->forward([
                            'controller' => 'post',
                            'action'     => 'show',
                            'params'    => $param
                        ]);
                    }
                    else{
                        $message = "Sorry, the following problems were generated:<br>"
                        . implode('<br>', $post->getMessages());
    
                        $this->view->message = $message;
                    }
                }
            }
        }
    }

    public function showAction($postid){
        $post = Posts::findFirstById($postid);

        $listAllComment = $this
            ->modelsManager
            ->executeQuery(
                'SELECT * FROM Models\Comments WHERE postid = :id: ORDER BY upvote DESC',
                [
                    'id' => $postid,
                ]
            );

        if($post){
            $this->view->post = $post;
            $this->view->comments = $listAllComment;
        }
    }

    public function deleteAction($postid){
        if($this->session->has('auth')){
            $post = Posts::findFirstById($postid);

            if($post){
                if($post->username == $this->session->get('auth')['username']){
                    $listAllComment = $this
                        ->modelsManager
                        ->executeQuery(
                            'SELECT * FROM Models\Comments WHERE postid = :id: ORDER BY upvote DESC',
                            [
                                'id' => $postid,
                            ]
                        );

                    foreach($listAllComment as $comment){
                        $comment->delete();
                    }

                    if($post->delete()){
                        $this->dispatcher->forward([
                            'controller' => 'index',
                            'action'     => 'index',
                        ]);
                    }
                    else{
                        $message = "Sorry, the following problems were generated:<br>"
                        . implode('<br>', $post->getMessages());
    
                        $this->view->message = $message;
                    }
                }
            }
        }
    }
}