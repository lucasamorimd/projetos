<?php

namespace src\handlers;

use \src\models\Usuario;

class handlerLogin
{
    public static function checkLogin()
    {
        if (!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];

            $data = Usuario::select()->where('token', $token)->one();
            if (count($data) > 0) {

                $loggedUser = new Usuario();
                $loggedUser->id_usuario = $data['id_usuario'];
                $loggedUser->nome = $data['nome'];
                $loggedUser->descricao = $data['descricao'];
                $loggedUser->data_nascimento = $data['data_nascimento'];
                $loggedUser->telefone = $data['telefone'];
                $loggedUser->email = $data['email'];
                $loggedUser->endereco = $data['endereco'];
                $loggedUser->cep = $data['cep'];
                $loggedUser->cidade = $data['cidade'];
                $loggedUser->estado = $data['estado'];
                $loggedUser->apelido = $data['apelido'];
                $loggedUser->avatar = $data['avatar'];
                $loggedUser->sexo = $data['sexo'];
                $loggedUser->token = $data['token'];

                return $loggedUser;
            }
        }
        return false;
    }
    public static function verifyLogin($login, $senha)
    {
        $usuario = Usuario::select()
            ->where('email', $login)
            ->orWhere('apelido', $login)
            ->one();

        if ($usuario) {
            if (password_verify($senha, $usuario['senha'])) {
                $token = md5(time() . rand(0, 9999) . time());
                Usuario::update()->set('token', $token)
                    ->where('email', $login)
                    ->orWhere('apelido', $login)
                    ->execute();

                return $token;
            }
        }
    }
}
