<?php

namespace src\controllers;

use \core\Controller;

use \src\handlers\handlerLogin;

class HomeController extends Controller
{

    //Atributo que recebe os dados do usuário logado
    private $loggedUser;

    //Método esecutado antes de qualquer outro método dessa clase ser executada
    public function __construct()
    {
        // Fas a requisição dos dados do usuário loggado
        $this->loggedUser = handlerLogin::checkLogin();
        // Caso não haja nenhum usuário logado
        if ($this->loggedUser === false) {
            //Redireciona para a página inicial de usuário não logado
            $this->redirect('/unsigned');
        }
    }

    //Parâmetro que renderiza a página inicial de usuário loggado
    public function index()
    {
        $array = array(
            'usuario_dados' => ['usuario' => $this->loggedUser],
        );
        $this->render('home', $array);
    }
}
