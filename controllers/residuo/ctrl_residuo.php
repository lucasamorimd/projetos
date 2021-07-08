<?php

require_once '../../models/residuo.php';
require_once '../../models/DAO/bd_residuo.php';
//require_once '../../models/DAO/bd_pesquisa_estoque.php';


//essa função filtra todas as informações passadas pelo formulário e coloca como array em $params
$params = filter_input_array(INPUT_POST, FILTER_DEFAULT); 

$novo_residuo = new residuo();
$bd_residuo = new bd_residuo();

$novo_residuo->setTipo($params['tipo']);
$novo_residuo->setDescricao($params['descricao']);
$novo_residuo->setId_empresa($params['id_empresa']);




$resultado = $bd_residuo->cadastrarresiduo($novo_residuo);

if($resultado == true){
	$resultado = "Residuo cadastrado";
}else {
	$resultado = "Erro no cadastro!";
}
Header("Location:../../painel_empresa/index.php?mensagem={$resultado}");
/*echo "<pre>";
var_dump($resultado);
die("eae fera");
echo "</pra>";
*/
