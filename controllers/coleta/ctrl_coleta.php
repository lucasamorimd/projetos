<?php

require_once '../../models/coleta.php';
require_once '../../models/DAO/bd_coleta.php';
//require_once '../../models/DAO/bd_pesquisa_estoque.php';


//essa função filtra todas as informações passadas pelo formulário e coloca como array em $params
$params = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$nova_coleta = new coleta();
$bd_coleta = new bd_coleta();

$nova_coleta->setDataColeta($params['data_coleta']);
$nova_coleta->setHoraColeta($params['hora']);
$nova_coleta->setLocalColeta($params['local_coleta']);
$nova_coleta->setId_empresa($params['id_empresa']);
$nova_coleta->setId_residuo($params['id_residuo']);
$nova_coleta->setId_condominio($params['id_condominio']);




$resultado = $bd_coleta->cadastrarcoleta($nova_coleta);



if($resultado == true){
	$resultado = "Coleta cadastrada";
}else {
	$resultado = "Erro no cadastro!";
}
Header("Location:../../painel_empresa/index.php?mensagem={$resultado}");