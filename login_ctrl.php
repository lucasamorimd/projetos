<?php
require 'config.php';
require 'models/Auth.php';

$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST, 'senha');

if ($email && $senha) {
    /**/
    $auth = new Auth($pdo, $base);
    $usuario = $auth->validateLogin($email, $senha);

    if ($usuario) {
        $_SESSION['aviso'] = 'Seja Bem-vindo';
        $_SESSION['cor'] = 3;
        header("Location:" . $base);
        exit;
    }
}
$_SESSION['aviso'] = "Erro no Login";
$_SESSION['cor'] = '';
header("Location:" . $base . "/login.php");
exit;
