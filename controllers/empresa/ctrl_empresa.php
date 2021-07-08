<?php

require_once '../../models/empresa.php';
require_once '../../models/DAO/bd_empresa.php';
//require_once '../../models/DAO/bd_pesquisa_estoque.php';

$params = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$nova_empresa = new empresa();
$bd_empresa = new bd_empresa();

$nova_empresa->setNome($params['nome']);
$nova_empresa->setEmail($params['email']);
$nova_empresa->setSenha($params['senha']);
$nova_empresa->setTelefone($params['telefone']);
$nova_empresa->setCnpj($params['cnpj']);
$nova_empresa->setLocal($params['local']);
$nova_empresa->setPerfil($params['perfil']);


$resultado = $bd_empresa->cadastrarEmpresa($nova_empresa);

if($resultado == true){
	$resultado = "Empresa cadastrada";
}else {
	$resultado = "Erro no cadastro!";
}
Header("Location: ../../index.php?mensagem={$resultado}");
/*echo "<pre>";
var_dump($resultado);
die("eae fera");
echo "</pra>";
*/
