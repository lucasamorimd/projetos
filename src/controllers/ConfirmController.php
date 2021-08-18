<?php

namespace src\controllers;

use \core\Controller;

use \src\models\Usuario;

use ClanCats\Hydrahon\Query\Sql\Func as F;

use \src\handlers\handlerLogin;

class ConfirmController extends Controller
{
    //Atributo que recebe os dados do usuário logado
    private $loggedUser;

    //Função que é rodada quando algum método dessa classe é utilizado
    public function __construct()
    {
        //insere no atributo os dados do usuário, caso haja um usuário loggado
        $this->loggedUser = handlerLogin::checkLogin();
    }


    //Método de envio do email para confirmação de cadastro
    public function sendConfirm($id)
    {
        //seleciona o usuário no banco de dados e insere as informações na variável
        $dados_usuario = Usuario::select()->where(new F('MD5', 'id_usuario'), $id['id'])->one();
        //gerando o link para o usuário clicar e confirmar
        //o link vai para a rota de confirmação
        $link = 'https://clinicasite.lad566.com.br/usuarios/confirmar/' . $id['id'];

        //assunto do Email
        $assunto = "Confirmação de conta";
        //Função para gerar o email com HTML
        $msg = $this->createEmail([
            'nome' => $dados_usuario['nome'],
            'link' => $link
        ]);

        //configuração do Charset
        $encoding = "utf-8";
        // Algumas configurações do Assunto do email
        $subject_preferences = array(
            "input-charset" => $encoding,
            "output-charset" => $encoding,
            "line-length" => 76,
            "line-break-chars" => "\r\n"
        );

        // Configurações do cabeçalho do email
        $headers = "Content-type: text/html; charset=" . $encoding . " \r\n";
        $headers .= "From: " . "Teste Clínica" . " <clinica@lad566.com.br> \r\n";
        $headers .= "MIME-Version: 1.0 \r\n";
        $headers .= "Content-Transfer-Encoding: 8bit \r\n";
        $headers .= "Date: " . date("r (T)") . " \r\n";
        $headers .= iconv_mime_encode("Subject", $assunto, $subject_preferences);

        //após gerado todas as configurações o email é enviado
        $email = mail($dados_usuario['email'], $assunto, $msg, $headers);

        //verifica se o email foi enviado
        if ($email == true) {
            // gera a mensagem de sucesso no envio do email
            $_SESSION['swal'] = "Email enviado para: " . $dados_usuario['email'];
            $_SESSION['icon'] = 'success';
        } else {
            $_SESSION['swal'] = "Erro ao enviar email";
            $_SESSION['icon'] = 'error';
        }
        $this->redirect('/');
    }

    //Método de confirmação
    //Ao clicar no link enviado no email, essa função é executada
    public function confirm($id)
    {

        //Seleciona o usuário no banco de dados pelo id contido no link enviado no email
        $dados_usuario = Usuario::select()->where(new F('MD5', 'id_usuario'), $id['id'])->one();
        //verifica se o id é o mesmo do que está loggado
        if ($dados_usuario['id_usuario'] === $this->loggedUser->id_usuario) {
            //verifica se a conta ainda não está confirmada
            if ($dados_usuario['status'] == 0) {
                //caso não esteja confirmada, é realizado o update do status para 1
                $confirmar = Usuario::update(['status' => 1])->where(new F('MD5', 'id_usuario'), $id['id'])->execute();
                //gerando na sessão uma Mensagem de sucesso 
                $_SESSION['swal'] = "Conta confirmada com sucesso";
                $_SESSION['icon'] = 'success';
            } else {
                //caso já tenha sido confirmado, o link é expirado e não é feito nenhum update no banco
                $_SESSION['swal'] = "Link expirado, você já está confirmado";
                $_SESSION['icon'] = 'warning';
            }
        } else {
            //Caso o id loggado não seja o mesmo do link enviado
            //gera essa mensagem de erro solicitando o login
            $_SESSION['swal'] = "Faça login com sua conta para confirmar";
            $_SESSION['icon'] = 'warning';
        }
        //após a execução é redirecionado para a home
        $this->redirect('/');
    }

    //método que é usado para criar o HTML do email a ser enviado
    private function createEmail(array $dados)
    {

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
