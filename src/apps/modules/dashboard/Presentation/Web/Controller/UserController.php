<?php

namespace Its\Example\Dashboard\Presentation\Web\Controller;

use Phalcon\Mvc\Controller;
use Models\Users;

class UserController extends Controller
{
    public function indexAction()
    {

    }

    public function loginIndexAction(){
        if($this->session->has('auth')){
            $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }
    }

    public function loginAction(){
        if(!$this->session->has('auth')){
            if($this->request->isPost()){
                $request = $this->request->getPost();
                
                $user = Users::findFirst([
                    'username = :username: AND password = :password:',
                    'bind' => [
                        'username' => $request['username'],
                        'password' => sha1($request['password']),
                    ],
                ]);
                
                if($user){
                    $this->registerSession($user);

                    $this->dispatcher->forward([
                        'controller' => 'index',
                        'action'     => 'index',
                    ]);
                }
                else{
                    $this->dispatcher->forward([
                        'controller' => 'user',
                        'action'     => 'loginIndex',
                    ]);
                }
            }
        }
        else{
            $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }
    }

    public function logoutAction(){
        $this->session->remove('auth');

        $this->dispatcher->forward([
            'controller' => 'index',
            'action'     => 'index',
        ]);
    }

    public function signupIndexAction(){
        if($this->session->has('auth')){
            $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }
    }

    public function signupAction(){
        if(!$this->session->has('auth')){
            if($this->request->isPost()){
                $data = $_POST;
                $data['password'] = sha1($data['password']);
    
                $users = Users::find();
    
                $new_user = new Users();
                $new_user->registration($data);
                if($new_user->checkDupp($users)){
                    $new_user->save();
                }
    
                $this->dispatcher->forward([
                    'controller' => 'user',
                    'action'     => 'loginIndex',
                ]);
            }
        }
        else{
            $this->dispatcher->forward([
                'controller' => 'index',
                'action'     => 'index',
            ]);
        }
    }

    public function registerSession($user){
        $this->session->set('auth', [
            'id' => $user->id,
            'username' => $user->username
        ]);
    }
}