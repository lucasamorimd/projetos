<?php

require_once 'usuario.php';

class morador extends usuario
{
	private $id_morador;
	private $id_condominio;


	public function setIdmorador($id_morador){
		$this->id_morador = $id_morador;
	}
	public function getIdmorador(){
		return $this->id_morador;
	}

	public function setIdCond($id_condominio){
		$this->id_condominio = $id_condominio;
	}
	public function getIdCond(){
		return $this->id_condominio;
	}

}