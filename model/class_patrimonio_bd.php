<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Patrimonio{
	public $id;
	public $custo_id;
	public $grupo_id;
	public $cliente_id;	
	public $responsavel_id;
	public $empresa_id;
	public $fornecedor_id;
	public $valor_compra;
	public $nome;

	public function add_patrimonio($custo_id, $cliente_id, $grupo_id, $cliente_id, $cliente_id, $responsavel_id, $empresa_id, $fornecedor_id, $valor_compra, $nome){
		$this->id = $id;
		$this->custo_id = $custo_id;
		$this->grupo_id = $grupo_id;
		$this->cliente = $cliente_id;
		$this->responsavel_id = $responsavel_id;
		$this->empresa = $empresa_id;
		$this->fornecedor_id = $fornecedor_id;
		$this->valor_compra = $valor_compra;
		$this->nome = $nome;
	}
	
	public function add_patrimonio_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "INSERT INTO patrimonio (custo_id, grupo_id, cliente_id, responsavel_id, empresa_id, fornecedor_id, valor_compra, nome)
									VALUES ( '%s',		'%s',	'%s',			'%s',		'%s',		'%s',		    '%s',	   '%s' )";

		if($g->tratar_query($query, $this->custo_id, $this->grupo_id, $this->cliente_id, $this->responsavel_id, $this->empresa_id, $this->fornecedor_id, $this->valor_compra, $this->nome)){
		return true; 
		}else{
		return false;
		} 



	}		
	
 ?>