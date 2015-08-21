<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Maquinario{
	public $id;
	public $matricula;
	public $chassi_nserie;
	public $modelo;
	public $tipo;
	public $tipo_consumo;
	public $ano;	
	public $cor;
	public $fabricante;
	public $data_compra;
	public $seguro;	
	public $horimetro_inicial;
	public $horimetro_final;
	public $id_empresa;
	public $id_fornecedor;
	public $id_responsavel;
	public $observacao;
	public $oculto;
	public $valor;
	
	public function add_maquinario($matricula, $chassi_nserie, $modelo, $tipo, $tipo_consumo, $ano, $cor,
									 $fabricante, $data_compra, $seguro, $horimetro_inicial, $horimetro_final, $id_empresa,
									 							 $id_fornecedor, $id_responsavel, $observacao,  $valor)
	{		
		
		$this->matricula = $matricula;
		$this->chassi_nserie = $chassi_nserie;
		$this->modelo = $modelo;
		$this->tipo = $tipo;
		$this->tipo_consumo = $tipo_consumo;
		$this->ano	 = $ano;	
		$this->cor = $cor;
		$this->fabricante = $fabricante;
		$this->data_compra = $data_compra;
		$this->seguro = $seguro;	
		$this->horimetro_inicia = $horimetro_inicial;
		$this->horimetro_final = $horimetro_final;
		$this->id_empresa = $id_empresa;
		$this->id_fornecedor = $id_fornecedor;
		$this->id_responsavel = $id_responsavel;
		$this->observacao = $observacao;
		
		$this->valor = $valor;
	}

	public function add_maquinario_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO maquinario (matricula, chassi_nserie, modelo, tipo, tipo_consumo, ano, cor,
 											fabricante, data_compra, seguro, horimetro_inicial, horimetro_final, id_empresa,
 												 id_fornecedor, id_responsavel, observacao,  valor) 
						VALUES 				( '%s',       '%s',       '%s',   '%s',   '%s',          '%s', '%s',
											'%s',			'%s',		'%s',  			'%s',		'%s',			'%s',
													'%s',			'%s',			'%s',			'%s')";

		if($g->tratar_query($query, $this->matricula, $this->chassi_nserie, $this->modelo, $this->tipo, $this->tipo_consumo,  $this->ano,  $this->cor, $this->fabricante, $this->data_compra, $this->seguro, $this->horimetro_inicia, $this->horimetro_final, $this->id_empresa, $this->id_fornecedor, $this->id_responsavel, $this->observacao, $this->valor)){
				return true; 
		}else{
				return false;
		} 

	}


}
	
 ?>