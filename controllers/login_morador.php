<?php

require_once '../models/DAO/bd_login_morador.php';

$loginDAO = new bd_login_morador();

//var_dump($_POST); die;

if (isset($_GET['logout']) && ($_GET['logout'] == true)) {
    $loginDAO->fazerLogout();
     $resultado = 'LOGOUT FEITO!';
    Header("Location:../index.php?mensagem={$resultado}");
    
} else {
    $emailMorador = $_POST["emailMorador"];
    $senha = $_POST["senhaMorador"];
    //$pefil = $_POST["perfilUsuarioLogado"];
}


$usuario = $loginDAO->fazerLogin($emailMorador, $senha);


if($_GET['logout']==TRUE) {

    $resultado = 'LOGOUT FEITO!';
    Header("Location: ../index.php?mensagem={$resultado}");

}elseif (!isset($usuario)) {

    $resultado = 'ERRO NO LOGIN!!!';
    Header("Location: ../index.php?mensagem={$resultado}");

} else {
    $resultado = 'SEJA BEM VINDO';
    Header("Location: ../index.php?mensagem={$resultado}");

}  

?>
