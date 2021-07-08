<?php

class residuo 
{
	private $id_residuo;
	private $tipo;
	private $descricao;
	private $id_empresa;

	public function setId_residuo($id_residuo){
		$this->id_residuo = $id_residuo;
	}
	public function getId_residuo(){
		return $this->id_residuo;
	}

		public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	public function getTipo(){
		return $this->tipo;
	}

		public function setDescricao($descricao){
		$this->descricao = $descricao;
	}
	public function getDescricao(){
		return $this->descricao;
	}		

	public function setId_empresa($id_empresa){
		$this->id_empresa = $id_empresa;
	}
	public function getId_empresa(){
		return $this->id_empresa;
	}
}