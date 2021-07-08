<?php
require_once 'usuario.php';

class empresa extends usuario
{
	private $id_empresa;
	private $cnpj;
	private $local;
	
	

	public function setId_empresa($id_empresa){
		$this->id_empresa = $id_empresa;
	}
	public function getId_empresa(){
		return $this->id_empresa;
	}
	
	public function setCnpj($cnpj){
		$this->cnpj = $cnpj;
	}
	public function getCnpj(){
		return $this->cnpj;
	}

	public function setLocal($local){
		$this->local = $local;
	}
	public function getLocal(){
		return $this->local;
	}




}