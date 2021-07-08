<?php

class condominio
{
	private$id_condominio;
	private $nome;
	private $cidade;
	private $estado;
	private $sindico;
	private $telefone;

	public function setId_condominio($id_condominio){
		$this->id_condominio = $id_condominio;
	}
	public function getId_condominio(){
		return $this->id_condominio;
	}	

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
	}

	public function setCidade($cidade){
		$this->cidade = $cidade;
	}
	public function getCidade(){
		return $this->cidade;
	}

	public function setEstado($estado){
		$this->estado = $estado;
	}
	public function getEstado(){
		return $this->estado;
	}

	public function setSindico($sindico){
		$this->sindico = $sindico;
	}
	public function getSindico(){
		return $this->sindico;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	public function getTelefone(){
		return $this->telefone;
	}
}