<?php

namespace Models;

use Phalcon\Mvc\Model;

class Posts extends Model
{
    public $id;
    public $username;
    public $title;
    public $content;
    public $comments;
    public $type;

    public function registration($data){
        $this->username = $data['username'];
        $this->title = $data['title'];
        $this->content = $data['content'];
        $this->comments = $data['comments'];
        $this->type = $data['type'];
    }

    public function updateData($data){
        $this->title = $data['title'];
        $this->content = $data['content'];
    }
}