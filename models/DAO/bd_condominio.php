<?php 
require_once 'conexao.php';
class bd_condominio 
{

public function pesquisarcondominioUni(){
    try{
        $pdo= conexao::getinstance();
        $sql="SELECT * FROM condominio ORDER BY id_condominio DESC LIMIT 1";
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
	public function pesquisarcondominio(){
	    try{
	        $pdo= conexao::getinstance();
	        $sql="SELECT * FROM condominio ORDER BY id_condominio DESC LIMIT 6 ";
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