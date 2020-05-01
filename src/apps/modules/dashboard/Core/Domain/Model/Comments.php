<?php

namespace Models;

use Phalcon\Mvc\Model;

class Comments extends Model
{
    public $id;
    public $postid;
    public $username;
    public $comment;
    public $upvote;

    public function registerData($data){
        $this->postid = $data['postid'];
        $this->username = $data['username'];
        $this->comment = $data['comment'];
        $this->upvote = 0;
    }
}