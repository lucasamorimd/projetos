<?php

class coleta 
{
	private $id_coleta;
	private $data_coleta;
	private $hora_coleta;
	private $local_coleta;
	private $id_empresa;
	private $id_residuo;
	private $id_condominio;

	public function setIdColeta($id_coleta){
		$this->id_coleta = $id_coleta;
	}
	public function getIdColeta(){
		return $this->id_coleta;
	}

	public function setDataColeta($data_coleta){
		$this->data_coleta = $data_coleta;
	}
	public function getDataColeta(){
		return $this->data_coleta;
	}

	public function setHoraColeta($hora_coleta){
		$this->hora_coleta = $hora_coleta;
	}
	public function getHoraColeta(){
		return $this->hora_coleta;
	}

	public function setLocalColeta($local_coleta){
		$this->local_coleta = $local_coleta;
	}
	public function getLocalColeta(){
		return $this->local_coleta;
	}

	public function setId_empresa($id_empresa){
		$this->id_empresa = $id_empresa;
	}
	public function getId_empresa(){
		return $this->id_empresa;
	}

	public function setId_residuo($id_residuo){
		$this->id_residuo = $id_residuo;
	}
	public function getId_residuo(){
		return $this->id_residuo;
	}

	public function setId_condominio($id_condominio){
		$this->id_condominio = $id_condominio;
	}
	public function getId_condominio(){
		return $this->id_condominio;
}
}