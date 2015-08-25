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
		$query = "SELECT * FROM patrimonio_geral WHERE nome LIKE '%%%s%%' &&  oculto = 0";
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

}
	
 ?>