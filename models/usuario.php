<?php

abstract class usuario
{
	private $nome;
	private $email;
	private $senha;
	private $telefone;
	private $perfil;

	public function setNome($nome){
		$this->nome = $nome;
	}
	public function getNome(){
		return $this->nome;
	}

	public function setEmail($email){
		$this->email = $email;
	}
	public function getEmail(){
		return $this->email;
	}

	public function setTelefone($telefone){
		$this->telefone = $telefone;
	}
	public function getTelefone(){
		return $this->telefone;
	}

	public function setSenha($senha){
		$this->senha = $senha;
	}
	public function getSenha(){
		return $this->senha;
	}
	public function setPerfil($perfil){
		$this->perfil = $perfil;
	}
	public function getPerfil(){
		return $this->perfil;
	}
}