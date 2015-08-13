<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Custo{
	public $id;
	public $valor_hora;
	


	public function add_custo($valor_hora)
	{		
		$this->valor_hora = $valor_hora;		
	}

	public function add_custo_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO custo (valor_hora) VALUES ('%s')";

		$result = $g->tratar_query($query, $this->valor_hora); //inserindo no banco de dados
		
		$query = "SELECT * FROM custo order by id desc";
		$result = $g->tratar_query($query); //pegando id da ultima insersão
		 
		 if(@mysql_num_rows($result) == 0){
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$id = $row['id'];
	     	return $id;
	     }
	}


	 public function atualiza_valor($valor_hora, $id){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE custo SET valor_hora = '%s' WHERE id = '%s' ";

		return $g->tratar_query($query, $valor_hora, $id);
	}
	
	public function get_valor_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM custo WHERE id= '%s'";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->valor_hora = $row['valor_hora'];          	

	     	return $this;
	     }

	}
}
	
 ?>