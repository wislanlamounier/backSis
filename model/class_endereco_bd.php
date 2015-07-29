<?php

include_once("class_sql.php");
include_once("../global.php");

class Endereco{ 

	public $bairro;
	public $rua;
	public $numero;
	public $cidade_id;
	public $cep;
	
	

	public function add_endereco($bairro, $rua, $numero, $cidade_id, $cep){

		$this->bairro = $bairro;
		$this->rua = $rua;
		$this->numero = $numero;
		$this->cidade_id = $cidade_id;
		$this->cep = $cep;
		
	}

	public function add_endereco_bd(){
		$sql= new Sql();
		$sql->conn_bd();

		$g = new Glob();

		$query = "INSERT INTO endereco (bairro, rua, numero, id_cidade, cep) 
		VALUES ('%s','%s','%s','%s','%s')";
		$g->tratar_query($query, $this->bairro, $this->rua, $this->numero, $this->cidade_id,$this->cep);
		$query = "SELECT * FROM  endereco ORDER BY  id DESC";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		return $row['id'];

		
	}
}


?>