<?php

namespace src\controllers;

use \core\Controller;
use \src\models\Usuario;
use \src\models\Medico;
use \src\handlers\handlerLogin;
use src\models\Servico;

class LoginController extends Controller
{

    public function signup()
    {
        $this->render('cadastrar');
    }

    public function signupAction()
    {
        $params = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        $verifica_dado = Usuario::select()
            ->where('email', $params['email'])
            ->orWhere('login', $params['login'])
            ->execute();

        if (!$verifica_dado) {
            $token = md5(time() . rand(0, 9999) . time());
            $_SESSION['token'] = $token;
            $senha = password_hash($params['senha'], PASSWORD_DEFAULT);
            Usuario::insert(
                [
                    'nome' => $params['nome'],
                    'rg' => $params['rg'],
                    'data_nascimento' => $params['data_nascimento'],
                    'telefone' => $params['telefone'],
                    'email' => $params['email'],
                    'endereco' => $params['endereco'],
                    'cep' => $params['cep'],
                    'cidade' => $params['cidade'],
                    'estado' => $params['estado'],
                    'login' => $params['login'],
                    'senha' => $senha,
                    'sexo' => $params['sexo'],
                    'token' => $token
                ]
            )->execute();
            $_SESSION['swal'] = "Seja bem-vindo!";
            $this->redirect('/');
        } else {
            $this->redirect('/signup');
        }
    }

    public function signin()
    {
        $login =  filter_input(INPUT_POST, 'login');
        $senha =  filter_input(INPUT_POST, 'senha');
        if ($login && $senha) {
            $token = handlerLogin::verifyLogin($login, $senha);
            if ($token) {
                $_SESSION['token'] = $token;
                $_SESSION['swal'] = "Seja bem-vindo!";
                $_SESSION['icon'] = 'success';
                $this->redirect('/');
            } else {
                $_SESSION['swal'] = "Email, Login ou Senha não conferem";
                $_SESSION['icon'] = 'error';
                $this->redirect('/unsigned');
            }
        } else {
            $this->redirect('/unsigned');
        }
    }

    public function signout()
    {
        $_SESSION['token'] = '';
        $_SESSION['swal'] = 'Logout feito';
        $this->redirect('/unsigned');
    }

    public function unsigned()
    {
        $lista_medicos = Medico::select()->execute();
        $lista_servicos = Servico::select()->execute();
        $lista_exames = [];
        $lista_consultas = [];
        $lista_procedimentos = [];
        foreach ($lista_servicos as $servico) {
            switch ($servico['tipo_servico']) {
                case 'exames':
                    $lista_exames[] = $servico;
                    break;
                case 'consultas':
                    $lista_consultas[] = $servico;
                    break;
                case 'procedimentos':
                    $lista_procedimentos[] = $servico;
                    break;
            }
        }
        $array = array(

            'lista_medicos' => $lista_medicos,
            'lista_servicos' => $lista_servicos,
            'lista_exames' => $lista_exames,
            'lista_consultas' => $lista_consultas,
            'lista_procedimentos' => $lista_procedimentos
        );

        $this->render('home_unsigned', $array);
    }
}
