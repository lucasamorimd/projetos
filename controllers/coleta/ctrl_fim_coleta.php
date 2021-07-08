<?php

require_once '../../models/coleta.php';
require_once '../../models/DAO/bd_coleta.php';
//require_once '../../models/DAO/bd_pesquisa_estoque.php';


//essa função filtra todas as informações passadas pelo formulário e coloca como array em $params
if(isset($_GET['id_coleta'])){
	$id_coleta = $_GET['id_coleta'];
} else{
	$id_coleta = null;
}

$nova_coleta = new coleta();
$bd_coleta = new bd_coleta();



$nova_coleta->setIdColeta($id_coleta);




$resultado = $bd_coleta->concluicoleta($nova_coleta);

if($resultado == true){

	$resultado = "Coleta Concluida";
}else {

	$resultado = "Erro na conclusão!!!";
}
Header("Location:../../painel_empresa/index.php?mensagem={$resultado}");