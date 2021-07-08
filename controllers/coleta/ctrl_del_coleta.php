<?php

require_once '../../models/coleta.php';
require_once '../../models/DAO/bd_coleta.php';
//require_once '../../models/DAO/bd_pesquisa_estoque.php';


if(isset($_GET['id_coleta'])){
	$id_coleta = $_GET['id_coleta'];
}else{
	$id_coleta = null;
}


$bd_coleta = new bd_coleta();





$resultado = $bd_coleta->excluicoleta($id_coleta);


if($resultado == true){
	$resultado = "Coleta Deletada";
}else {

	$resultado = "Erro na alteração!!!";
}
Header("Location:../../painel_empresa/lista_coleta.php?mensagem={$resultado}");