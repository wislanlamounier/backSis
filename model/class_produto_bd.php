<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Produto{

	public $id;
	public $nome;
	public $id_empresa;


	public function add_produtos($nome, $id_empresa)
	{		
		$this->nome = $nome;
		$this->id_empresa = $id_empresa;
	}

	public function add_produto_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO produtos (nome, id_empresa) VALUES ('%s','%s')";

		$result = $g->tratar_query($query, $this->nome, $this->id_empresa); //inserindo no banco de dados
		
		$query = "SELECT * FROM produtos order by id desc";
		$result = $g->tratar_query($query); //pegando id da ultima insersão
		 
		 if(@mysql_num_rows($result) == 0){
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$id = $row['id'];
	     	return $id;
	     }
	}

	

}
 ?>