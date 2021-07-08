<?php

require_once '../../models/morador.php';
require_once '../../models/DAO/bd_morador.php';
//require_once '../../models/DAO/bd_pesquisa_estoque.php';


//essa função filtra todas as informações passadas pelo formulário e coloca como array em $params
$params = filter_input_array(INPUT_POST, FILTER_DEFAULT); 

$novo_morador = new morador();
$bd_morador = new bd_morador();

$novo_morador->setNome($params['nome']);
$novo_morador->setEmail($params['email']);
$novo_morador->setSenha($params['senha']);
$novo_morador->setTelefone($params['telefone']);
$novo_morador->setIdCond($params['id_condominio']);
$novo_morador->setPerfil($params['perfil']);



$resultado = $bd_morador->cadastrarmorador($novo_morador);

if($resultado == true){
	$resultado = "morador cadastrado";
}else {
	$resultado = "Erro no cadastro!";
}
Header("Location: ../../index.php?mensagem={$resultado}");
/*echo "<pre>";
var_dump($resultado);
die("eae fera");
echo "</pra>";
*/
