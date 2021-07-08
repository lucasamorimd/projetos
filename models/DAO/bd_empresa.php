<?php
require_once 'conexao.php';
class bd_empresa
{
	  public function cadastrarEmpresa(empresa $novaEmpresa){
	      try{
	      $pdo=  conexao::getinstance();
	      $sql= "INSERT INTO empresa(nome,email,senha,telefone,cnpj,emp_local,perfil) values(?,?,?,?,?,?,?);";
	      $stmt=$pdo->prepare($sql);
	      $stmt->bindValue(1, $novaEmpresa->getNome());
	      $stmt->bindValue(2, $novaEmpresa->getEmail());
	      $stmt->bindValue(3, $novaEmpresa->getSenha());
	      $stmt->bindValue(4, $novaEmpresa->getTelefone());
	      $stmt->bindValue(5, $novaEmpresa->getCnpj());
	      $stmt->bindValue(6, $novaEmpresa->getLocal());
	      $stmt->bindValue(7, $novaEmpresa->getPerfil());
	      return $stmt->execute(); 
	      
	      }catch(PDOException $exc){
	          echo $exc->getMessage();
	  }
	}
}