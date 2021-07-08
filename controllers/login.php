<?php
require_once('../models/DAO/bd_login.php');
$logout = $_GET['logout'];

if ($logout == "true") {
    // limpe tudo que for necessário na saída.
    // Eu geralmente não destruo a seção, mas invalido os dados da mesma
    // para evitar algum "necromancer" recuperar dados. Mas simplifiquemos:

    $_SESSION = null;
    $_SESSION['aviso'] = "Logout Feito";
    header("Location: ../index.php");
    die();

}


$usuario = filter_input(INPUT_POST, 'nome');
$senha = addslashes($_POST['senha']);

$login = new bd_login();
$logado = $login->logar($usuario, $senha);

if($logado == true){
    $_SESSION['aviso'] = "Seja Bem-vindo, ".$usuario;
}else{
    $_SESSION['aviso'] = "Houve algum erro no Login";
}

header("Location:../index.php");
die();
