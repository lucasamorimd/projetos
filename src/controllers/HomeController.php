<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\handlers\handlerFollow;

class HomeController extends Controller
{
    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }
    public function index()
    {

        $followings = handlerFollow::getFollowings($this->loggedUser->id_usuario);
        $followers = handlerFollow::getFollowers($this->loggedUser->id_usuario);
        $array = [
            'dados' => [
                'usuario' => $this->loggedUser,
                'followings' => $followings,
                'followers' => $followers,
                'title' => 'Home',
                'activeMenu' => 'home'
            ]
        ];
        $this->render('home', $array);
    }
}
