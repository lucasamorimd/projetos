<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\handlers\handlerFollow;
use \src\handlers\handlerUser;

class UserController extends Controller
{
    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
        if ($this->loggedUser === false) {
            $this->redirect('/login');
        }
    }
    public function profile($id)
    {

        $followings = handlerFollow::getFollowings($this->loggedUser->id_usuario);
        $followers = handlerFollow::getFollowers($this->loggedUser->id_usuario);
        $user = handlerUser::getPerfil($id);
        $array = [
            'dados' => [
                'usuario' => $this->loggedUser,
                'followings' => $followings,
                'followers' => $followers,
                'title' => 'Home',
                'activeMenu' => 'perfil'
            ],
            'user_profile' => $user
        ];
        $this->render('user/perfil', $array);
    }
}
