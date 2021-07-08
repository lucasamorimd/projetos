<?php
require_once 'conexao.php';
class bd_coleta
{
	  public function cadastrarcoleta(coleta $novacoleta){
	      try{
	      $pdo=  conexao::getinstance();
	      $sql= "INSERT INTO coleta(data_coleta,hora,local_coleta,id_empresa,id_residuo,id_condominio,feito) values(?,?,?,?,?,?,0);";
	      $stmt=$pdo->prepare($sql);
	      $stmt->bindValue(1, $novacoleta->getDataColeta());
	      $stmt->bindValue(2, $novacoleta->getHoraColeta());
	      $stmt->bindValue(3, $novacoleta->getLocalColeta());
	      $stmt->bindValue(4, $novacoleta->getId_empresa());
	      $stmt->bindValue(5, $novacoleta->getId_residuo());
	      $stmt->bindValue(6, $novacoleta->getId_condominio());
	     
	      return $stmt->execute(); 
	      
	      }catch(PDOException $exc){
	          echo $exc->getMessage();
	  }
	}
	public function pesquisarcoleta(){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta ORDER BY id_coleta DESC LIMIT 4";
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
	public function pesquisarcoletaNot($id_empresa){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta WHERE id_empresa = :id_empresa AND feito = 0 ORDER BY id_coleta DESC LIMIT 4";
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
	public function pesquisarcoletaid($id_coleta){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta INNER JOIN condominio ON coleta.id_condominio = condominio.id_condominio WHERE id_empresa = ? ORDER BY feito ASC,data_coleta ASC LIMIT 4";
	        $stmt=$pdo->prepare($sql);
	        $stmt->bindValue(1,$id_coleta);
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
	public function pesquisarcoletaidUni($id_coleta){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta INNER JOIN condominio  ON coleta.id_condominio = condominio.id_condominio INNER JOIN residuo ON coleta.id_residuo = residuo.id_residuo WHERE coleta.id_empresa = ? ORDER BY id_coleta DESC LIMIT 1";
	        $stmt=$pdo->prepare($sql);
	        $stmt->bindValue(1,$id_coleta);
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
	public function listarcoletas($id_coleta){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta INNER JOIN condominio  ON coleta.id_condominio = condominio.id_condominio INNER JOIN residuo ON coleta.id_residuo = residuo.id_residuo WHERE coleta.id_empresa = ? ORDER BY id_coleta DESC";
	        $stmt=$pdo->prepare($sql);
	        $stmt->bindValue(1,$id_coleta);
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
	public function alteracoleta(coleta $novacoleta){
		    try{
		    $pdo=  conexao::getinstance();
		    $sql= "UPDATE coleta SET data_coleta = ?, hora = ?, local_coleta = ? WHERE id_coleta = ?;";
		    $stmt=$pdo->prepare($sql);
		    $stmt->bindValue(1, $novacoleta->getDataColeta());
		    $stmt->bindValue(2, $novacoleta->getHoraColeta());
		    $stmt->bindValue(3, $novacoleta->getLocalColeta());
		    $stmt->bindValue(4, $novacoleta->getIdColeta());
		   
		    return $stmt->execute(); 
		    
		    }catch(PDOException $exc){
		        echo $exc->getMessage();
		}
	}	
	public function concluicoleta(coleta $novacoleta){
		    try{
		    $pdo=  conexao::getinstance();
		    $sql= "UPDATE coleta SET feito = 1 WHERE id_coleta = ?;";
		    $stmt=$pdo->prepare($sql);
		    $stmt->bindValue(1, $novacoleta->getIdColeta());
		   
		    return $stmt->execute(); 
		    
		    }catch(PDOException $exc){
		        echo $exc->getMessage();
		}
	}
	public function pesquisarcoletaidAlt($id_coleta){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta INNER JOIN condominio  ON coleta.id_condominio = condominio.id_condominio INNER JOIN residuo ON coleta.id_residuo = residuo.id_residuo WHERE coleta.id_coleta = ?";
	        $stmt=$pdo->prepare($sql);
	        $stmt->bindValue(1,$id_coleta);
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
	public function excluicoleta($id_coleta){
	    try{
	        $pdo=  conexao::getinstance();
	        $sql="DELETE FROM coleta WHERE id_coleta=?";
	        $stmt= $pdo->prepare($sql);
	        $stmt->bindValue(1,$id_coleta);
	        $result=$stmt->execute();
	        return $result;
	    } catch (Exception $ex) {

	    }
	}
	public function pesquisarcoletaMorador($id_condominio,$pesq){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta INNER JOIN residuo on coleta.id_residuo = residuo.id_residuo WHERE data_coleta = ? AND id_condominio = ? ORDER BY data_coleta ASC ";
	        $stmt=$pdo->prepare($sql);
	        $stmt->bindValue(1,$pesq);
	        $stmt->bindValue(2,$id_condominio);
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
	public function pesquisarcoletaM($id_condominio){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM coleta inner join residuo on coleta.id_residuo = residuo.id_residuo WHERE id_condominio = ? ORDER BY id_coleta DESC LIMIT 4";
	        $stmt=$pdo->prepare($sql);
	        $stmt->bindValue(1,$id_condominio);
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