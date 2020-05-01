<?php

namespace Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $id;
    public $username;
    public $password;

    public function checkDupp($data){
        foreach ($data as $user){
            if($user->username == $this->username){
                return false;
            }
        }
        return true;
    }

    public function registration($data){
        $this->username = $data['username'];
        $this->password = $data['password'];
    }
}