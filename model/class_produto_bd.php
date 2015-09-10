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
		return true;
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
	public function get_produto_by_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM produtos WHERE nome LIKE '%%%s%%' ";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum produto encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}
	public function get_produto_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM produtos WHERE id = '%s' && id_empresa=".$_SESSION['id_empresa'];
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$produto = new Produto();
	     	$produto->id = $row['id'];
	     	$produto->nome = $row['nome'];

	     	return $produto;
	     }

	}
	

}
 ?>