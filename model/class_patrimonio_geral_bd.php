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
	public $valor;
	public $id_empresa;
	public $oculto;

	
	
	public function add_patrimonio_geral($nome, $matricula, $marca, $descricao, $quantidade, $valor, $id_empresa)
	{		
		
		$this->nome = $nome;
		$this->matricula = $matricula;
		$this->marca = $marca;
		$this->descricao = $descricao;
		$this->quantidade = $quantidade;
		$this->valor = $valor;
		$this->id_empresa = $id_empresa;

	}

	public function add_patrimonio_geral_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO patrimonio_geral (nome, matricula, marca, descricao, quantidade, valor, id_empresa) 
									VALUES  	( '%s',  '%s',   '%s',   '%s', 	  		'%s',	'%s',		'%s')";

		if($g->tratar_query($query, $this->nome, $this->matricula, $this->marca, $this->descricao, $this->quantidade, $this->valor, $this->id_empresa)){
				return true; 
		}else{
				return false;
		} 

	}
	
	public function get_patrimonio_geral_nome($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM patrimonio_geral WHERE nome LIKE '%%%s%%' &&  oculto = 0 && id_empresa=".$_SESSION['id_empresa'];
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['matricula'];
			$return[$aux][2] = $result['nome'];
			$return[$aux][3] = $result['descricao'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum patrimonio encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}

	public function get_patrimonio_geral_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM patrimonio_geral WHERE id = '%s' && oculto =0";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            echo 'Nenhum patrimonio encontrado';
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id= $row['id'];
	     	$this->nome= $row['nome'];
			$this->matricula= $row['matricula'];
			$this->marca= $row['marca'];
			$this->descricao= $row['descricao'];
			$this->quantidade= $row['quantidade'];
			$this->valor= $row['valor'];
			$this->id_empresa= $row['id_empresa'];
	     	
	     	
	     	return $this;
	     }
	}

	public function atualiza_patrimonio_geral($nome, $matricula, $marca, $descricao, $quantidade, $valor, $id_empresa, $id){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE patrimonio_geral SET nome='%s', descricao='%s', marca='%s', descricao='%s', quantidade='%s', valor='%s', id_empresa='%s' WHERE id ='%s' ";

		$query_tra = $g->tratar_query($query, $nome, $matricula, $marca, $descricao, $quantidade, $valor, $id_empresa, $id);
		
		if($query_tra){
			return $query_tra;
		}else{
			return false;
		}
		
	}

}
	
 ?>