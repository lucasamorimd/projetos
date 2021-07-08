<?php
require_once 'conexao.php';
class bd_morador
{
	  public function cadastrarmorador(morador $novomorador){
	      try{
	      $pdo=  conexao::getinstance();
	      $sql= "INSERT INTO morador(nome,email,senha,telefone,perfil,id_condominio) values(?,?,?,?,?,?);";
	      $stmt=$pdo->prepare($sql);
	      $stmt->bindValue(1, $novomorador->getNome());
	      $stmt->bindValue(2, $novomorador->getEmail());
	      $stmt->bindValue(3, $novomorador->getSenha());
	      $stmt->bindValue(4, $novomorador->getTelefone());
	      $stmt->bindValue(5, $novomorador->getPerfil());
	      $stmt->bindValue(6, $novomorador->getIdCond());
	      
	      return $stmt->execute(); 
	      
	      }catch(PDOException $exc){
	          echo $exc->getMessage();
	  }
	}
	public function pesquisarCondominio(){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM condominio";
	        $stmt=$pdo->prepare($sql);
	        $stmt->execute();
	        $Clientes = array();
	        while($Cliente = $stmt->fetchObject(__CLASS__)){
	            $Clientes[] = $Cliente;
	        }
	        return $Clientes;
	        
	    } catch (Exception $exc) {
	         echo $exc->getTraceAsString();
	    }
	}
}