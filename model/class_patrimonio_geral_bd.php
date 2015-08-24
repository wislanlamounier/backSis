<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Patrimonio_geral{
	public $id;
	public $nome;
	public $matricula;
	public $marca;
	public $descricao;
	public $quantidade;
	public $id_empresa;
	public $oculto;

	
	
	public function add_patrimonio_geral($nome, $matricula, $marca, $descricao, $quantidade, $id_empresa)
	{		
		
		$this->nome = $nome;
		$this->matricula = $matricula;
		$this->marca = $marca;
		$this->descricao = $descricao;
		$this->quantidade = $quantidade;
		$this->id_empresa = $id_empresa;

	}

	public function add_patrimonio_geral_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO patrimonio_geral (nome, matricula, marca, descricao, quantidade, id_empresa) 
					VALUES  	( '%s',  '%s',   '%s',   '%s', 	  		'%s',	'%s')";

		if($g->tratar_query($query, $this->nome, $this->matricula, $this->marca, $this->descricao, $this->quantidade, $this->id_empresa)){
				return true; 
		}else{
				return false;
		} 

	}


}
	
 ?>