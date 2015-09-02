<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Material{
	public $id;
	public $nome;
	public $id_unidade_medida;
	public $id_empresa;

	


	public function add_material($nome, $id_unidade_medida, $id_empresa)
	{		
		$this->nome = $nome;
		$this->id_unidade_medida = $id_unidade_medida;
		$this->id_empresa = $id_empresa;

	}

	public function add_material_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO materiais (nome, id_unidade_medida, id_empresa) VALUES ('%s','%s','%s')";

		if($g->tratar_query($query, $this->nome, $this->id_unidade_medida, $this->id_empresa)){
					return true; 
		}else{
				return false;
		} 
	}
	
	 public function atualiza_material($nome, $id){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE materiais SET nome = '%s' WHERE id = '%s' ";

		return $g->tratar_query($query, $nome, $id);
	}
	
	public function get_material_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM materiais WHERE id= '%s' && id_empresa=".$_SESSION['id_empresa'];
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->nome = $row['nome'];
	     	$this->id_unidade_medida = $row['id_unidade_medida'];          	

	     	return $this;
	     }

	}
	public function get_material_by_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM materiais WHERE nome LIKE '%%%s%%' ";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$return[$aux][2] = $result['id_unidade_medida'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum material encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}
	
	public function get_all_material(){
		$sql = new Sql();
		$sql->conn_bd();
		$aux=0;
		$query = mysql_query("SELECT * FROM materiais");

		while($result = mysql_fetch_array($query)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$return[$aux][2] = $result['id_unidade_medida'];
			$aux++;
		}
		return $return;
	}

}
	
 ?>