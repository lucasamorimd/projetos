<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\models\Post;
use \src\handlers\handlerPost;

class PostController extends Controller
{
    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }

    public function post()
    {
        $body = filter_input(INPUT_POST, 'body');
        $date = date('Y-m-d H:i:s');
        if ($body) {
            Post::insert([
                'body' => $body,
                'id_usuario' => $this->loggedUser->id_usuario,
                'data_criacao' => $date,
                'type' => 'text'
            ])->execute();
        }
        $post = handlerPost::getLastPost($date);
        print_r(json_encode($post));
        exit;
        //$this->redirect('/');
        //var_dump($post);
    }
}
