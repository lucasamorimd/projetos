<?php
session_start();
require_once('../models/DAO/bd_usuario.php');
require_once('../models/usuario.php');
$params = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$objUsuario = new usuario();
$bdUsuario = new bd_usuario();

$objUsuario->setNome($params['nome']);
$objUsuario->setEmail($params['email']);
$objUsuario->setSenha($params['senha']);
$objUsuario->setToken(md5($params['nome']));

$cadastro = $bdUsuario->cadastrar($objUsuario);

if($cadastro == true){
    
    $_SESSION['aviso'] = "Cadastro realizado";

}else{
    $_SESSION['aviso'] = "Houve algum erro ao Realizar Cadastro!";
}
header('Location: ../index.php');
die();