<?php

namespace src\controllers;

use \core\Controller;
use \src\handlers\handlerLogin;
use \src\models\Usuario;

class LoginController extends Controller
{


    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
    }

    public function unsigned()
    {
        if ($this->loggedUser != false) {
            $this->redirect('/');
        }

        $this->render('login');
    }
    public function signin()
    {
        $login =  filter_input(INPUT_POST, 'login');
        $senha =  filter_input(INPUT_POST, 'senha');
        if ($login && $senha) {
            $token = handlerLogin::verifyLogin($login, $senha);
            if ($token) {
                $_SESSION['token'] = $token;
                $_SESSION['aviso'] = "Seja Bem-vindo!";
                $_SESSION['cor'] = 3;
                $this->redirect('/');
            } else {
                $_SESSION['aviso'] = "Email, Login ou Senha não conferem";
                $this->redirect('/login');
            }
        } else {
            $_SESSION['aviso'] = "Preencha todos os campos";
            $this->redirect('/login');
        }
    }
    public function signup()
    {
        $this->render('signup');
    }

    public function signupAction()
    {
        $params = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $verifica_dado = Usuario::select()
            ->where('email', $params['email'])
            ->orWhere('apelido', $params['apelido'])
            ->execute();

        if (!$verifica_dado) {
            $token = md5(time() . rand(0, 9999) . time());
            $_SESSION['token'] = $token;
            $senha = password_hash($params['senha'], PASSWORD_DEFAULT);
            Usuario::insert(
                [
                    'nome' => $params['nome'],
                    'email' => $params['email'],
                    'senha' => $senha,
                    'token' => $token,
                    'apelido' => $params['apelido'],
                    'sexo' => $params['sexo']
                ]
            )->execute();
            $this->redirect('/');
        } else {
            $this->redirect('/signup');
        }
    }

    public function signout()
    {
        $_SESSION['token'] = '';
        $this->redirect('/login');
    }
}
