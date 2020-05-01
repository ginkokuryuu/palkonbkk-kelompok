<?php

namespace Its\Example\Dashboard\Presentation\Web\Controller;

use Phalcon\Mvc\Controller;
use Models\Users;
use Models\Posts;
use Models\Comments;

class CommentController extends Controller
{
    public function indexAction()
    {

    }

    public function createAction($postid){
        if($this->session->has('auth')){
            if($this->request->isPost()){
                $data = $_POST;
                $data['postid'] = $postid;
                $data['username'] = $this->session->get('auth')['username'];

                $newComment = new Comments();
                $newComment->registerData($data);

                $newComment->save();
            }
        }

        $keyParam = [];
        $keyParam['postid'] = $postid;

        $this->dispatcher->forward([
            'controller' => 'post',
            'action'     => 'show',
            'params' => $keyParam
        ]);
    }

    public function deleteAction($commentid){
        if($this->session->has('auth')){
            $comment = Comments::findFirstById($commentid);
            if($comment){
                $keyParam = [];
                $keyParam['postid'] = $comment->postid;

                if($comment->username == $this->session->get('auth')['username']){
                    $comment->delete();
                }

                $this->dispatcher->forward([
                    'controller' => 'post',
                    'action'     => 'show',
                    'params' => $keyParam
                ]);

                return;
            }
        }

        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index'
        ]);
    }

    public function upvoteAction($commentid){
        if($this->session->has('auth')){
            $comment = Comments::findFirstById($commentid);
            if($comment){
                $keyParam = [];
                $keyParam['postid'] = $comment->postid;
                
                $comment->upvote = $comment->upvote + 1;

                $comment->save();

                $this->dispatcher->forward([
                    'controller' => 'post',
                    'action'     => 'show',
                    'params' => $keyParam
                ]);

                return;
            }
        }

        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index'
        ]);
    }
}