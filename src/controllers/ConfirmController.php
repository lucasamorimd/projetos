<?php

namespace src\controllers;

use \core\Controller;

use \src\models\Usuario;

use ClanCats\Hydrahon\Query\Sql\Func as F;

use \src\handlers\handlerLogin;

class ConfirmController extends Controller
{
    private $loggedUser;
    public function __construct()
    {
        $this->loggedUser = handlerLogin::checkLogin();
    }

    public function sendConfirm($id)
    {
        $dados_usuario = Usuario::select()->where(new F('MD5', 'id_usuario'), $id['id'])->one();
        $link = 'https://clinicasite.lad566.com.br/usuarios/confirmar/' . $id['id'];
        $assunto = "Confirmação de conta";
        $msg = "Olá " . $dados_usuario['nome'] . ", Seja bem-vindo(a). Clique no link abaixo para confirmar e acessar sua conta.\n\n" . $link;

        $encoding = "utf-8";
        // Preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );

        // Mail header
        $headers = "Content-type: text/plain; charset=" . $encoding . " \r\n";
        $headers .= "From: " . "Teste Clínica" . " <clinica@lad566.com.br> \r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-Transfer-Encoding: 8bit \r\n";
        $headers .= "Date: " . date("r (T)") . " \r\n";
        $headers .= iconv_mime_encode("Subject", $assunto, $subject_preferences);
        $email = mail($dados_usuario['email'], $assunto, $msg, $headers);
        if ($email == true) {
            $_SESSION['swal'] = "Email enviado para: " . $dados_usuario['email'];
            $_SESSION['icon'] = 'success';
        } else {
            die('deu erro');
        }
        $this->redirect('/');
    }

    public function confirm($id)
    {

        $dados_usuario = Usuario::select()->where(new F('MD5', 'id_usuario'), $id['id'])->one();
        if ($dados_usuario['id_usuario'] === $this->loggedUser->id_usuario) {
            if ($dados_usuario['status'] == 0) {
                $confirmar = Usuario::update(['status' => 1])->where(new F('MD5', 'id_usuario'), $id['id'])->execute();
                $_SESSION['swal'] = "Conta confirmada com sucesso";
                $_SESSION['icon'] = 'success';
            } else {
                $_SESSION['swal'] = "Conta confirmada com sucesso";
                $_SESSION['icon'] = 'success';
            }
        } else {
            $_SESSION['swal'] = "Faça login com sua conta para confirmar";
            $_SESSION['icon'] = 'warning';
        }
        $this->redirect('/');
    }
}
