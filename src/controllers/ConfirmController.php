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
        $msg = $this->createEmail([
            'nome' => $dados_usuario['nome'],
            'link' => $link
        ]);        $encoding = "utf-8";
        // Preferences for Subject field
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );

        // Mail header
        $headers = "Content-type: text/html; charset=" . $encoding . " \r\n";
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
                $_SESSION['swal'] = "Link expirado, você já está confirmado";
                $_SESSION['icon'] = 'warning';
            }
        } else {
            $_SESSION['swal'] = "Faça login com sua conta para confirmar";
            $_SESSION['icon'] = 'warning';
        }
        $this->redirect('/');
    }
        private function createEmail(array $dados)
    {
        /*$email = '
        <style> 

        </style>
        <p>
        Olá, <strong>' . $dados['nome'] . '</strong>! Seja bem vindo ao nosso sistema.<br/>
        Para prosseguir utilizando nosso sistema clique no botão abaixo.<br/>
        </p>
        <a class="button" href="' . $dados['link'] . '"> Confirmar </a>
        ';*/
        $email = '
        <style>
.myButton {
	box-shadow:inset 0px 1px 0px 0px #cf866c;
	background:linear-gradient(to bottom, #d0451b 5%, #bc3315 100%);
	background-color:#d0451b;
	border-radius:3px;
	border:1px solid #942911;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:13px;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:0px 1px 0px #854629;
}
.myButton:hover {
	background:linear-gradient(to bottom, #bc3315 5%, #d0451b 100%);
	background-color:#bc3315;
}
.myButton:active {
	position:relative;
	top:1px;
}
</style>
    <body style="margin: 0; padding: 0;">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td>
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="50%">
                        <tr>
                            <td bgcolor="#ffffff">
                               <img src="https://prints.lad566.com.br/clinica_teste.jpg" alt="Clinica Teste" title="Clínica Teste">
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff">
                                Olá <strong>' . $dados['nome'] . '</strong> Seja bem-vindo(a) ao nosso sistema.
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff">
                                Clique no botão para concluir seu cadastro e seguir para a área do paciente!
                            </td>
                        </tr>
                        <tr>
                            <td bgcolor="#ffffff">
                                <a class="myButton" href="' . $dados['link'] . '">Confirmar</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
        ';
        return $email;
    }
}
