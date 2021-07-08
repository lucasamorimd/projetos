<?php
require_once 'conexao.php';
class bd_residuo
{
	  public function cadastrarresiduo(residuo $novoresiduo){
	      try{
	      $pdo=  conexao::getinstance();
	      $sql= "INSERT INTO residuo(tipo,descricao,id_empresa) values(?,?,?);";
	      $stmt=$pdo->prepare($sql);
	      $stmt->bindValue(1, $novoresiduo->getTipo());
	      $stmt->bindValue(2, $novoresiduo->getDescricao());
	      $stmt->bindValue(3, $novoresiduo->getId_empresa());

	      
	      return $stmt->execute(); 
	      
	      }catch(PDOException $exc){
	          echo $exc->getMessage();
	  }
	}

	public function pesquisarResiduo($id_empresa){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM residuo WHERE id_empresa = :id_empresa";
	        $stmt=$pdo->prepare($sql);
			$stmt->bindValue(':id_empresa', $id_empresa);
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
	public function pesquisarresiduoid($id_residuo){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM residuo WHERE id_empresa = ?";
	        $stmt=$pdo->prepare($sql);
	        $stmt->bindValue(1,$id_residuo);
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