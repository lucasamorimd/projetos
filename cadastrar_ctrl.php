<?php
require 'config.php';
require 'models/Auth.php';

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$senha = filter_input(INPUT_POST,'senha');
$apelido = filter_input(INPUT_POST, 'apelido');

if($nome && $email && $senha){

    $auth = new Auth($pdo, $base);
    if($auth->emailExists($email) === false){

        $auth->registerUser($nome, $email, $senha, $apelido);
        $_SESSION['aviso'] = "Seja bem-vindo";
        $_SESSION['cor'] = 3;
        header("Location:".$base);
        exit;
    }else{
        $_SESSION['aviso'] = "Email já existe, tente outro email";
        $_SESSION['cor'] = 2;
        header("Location:".$base."/cadastrar.php");
        exit;
    }
}