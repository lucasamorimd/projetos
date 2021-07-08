<?php

require_once '../models/DAO/bd_login.php';

$loginDAO = new bd_login();

//var_dump($_POST); die;

if (isset($_GET['logout']) && ($_GET['logout'] == true)) {
    $loginDAO->fazerLogout();
     $resultado = 'LOGOUT FEITO!';
    Header("Location:../index.php?mensagem={$resultado}");
    
} else {
    $emailEmpresa = $_POST["emailEmpresa"];
    $senha = $_POST["senhaEmpresa"];
    //$pefil = $_POST["perfilUsuarioLogado"];
}


$usuario = $loginDAO->fazerLogin($emailEmpresa, $senha);


if($_GET['logout']==TRUE) {

    $resultado = 'LOGOUT FEITO! ';
    Header("Location: ../index.php?mensagem={$resultado}");

}elseif (!isset($usuario)) {

    $resultado = 'ERRO NO LOGIN!!! ';
    Header("Location: ../index.php?mensagem={$resultado}");

} else {

    $resultado = 'SEJA BEM VINDO ';
    Header("Location: ../painel_empresa/index.php?mensagem={$resultado}");

}  

?>