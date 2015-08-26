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
	public $id_empresa;
	public $id_fornecedor;
	public $id_responsavel;
	public $observacao;
	public $oculto;
	public $valor;
	
	public function add_maquinario($matricula, $chassi_nserie, $modelo, $tipo, $tipo_consumo, $ano, $cor,
									 $fabricante, $data_compra, $seguro, $horimetro_inicial, $id_empresa,
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
 											fabricante, data_compra, seguro, horimetro_inicial, id_empresa,
 												 id_fornecedor, id_responsavel, observacao,  valor) 
						VALUES 				( '%s',       '%s',       '%s',   '%s',   '%s',          '%s', '%s',
											'%s',			'%s',		'%s',  			'%s',		'%s',			'%s',
													'%s',			'%s',			'%s',			'%s')";

		if($g->tratar_query($query, $this->matricula, $this->chassi_nserie, $this->modelo, $this->tipo, $this->tipo_consumo,  $this->ano,  $this->cor, $this->fabricante, $this->data_compra, $this->seguro, $this->horimetro_inicia,  $this->id_empresa, $this->id_fornecedor, $this->id_responsavel, $this->observacao, $this->valor)){
				return true; 
		}else{
				return false;
		} 

	}

	 public function get_maquinario_nome($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM maquinario WHERE modelo LIKE '%%%s%%' &&  oculto = 0 && id_empresa=".$_SESSION['id_empresa'];
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['matricula'];
			$return[$aux][2] = $result['modelo'];
			$return[$aux][3] = $result['fabricante'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum maquinario encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}

	public function get_maquinario_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM maquinario WHERE id = '%s' && oculto =0";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            echo 'Nenhum maquinario encontrado';
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id= $row['id'];
	     	$this->matricula = $row['matricula'];
			$this->chassi_nserie = $row['chassi_nserie'];
			$this->modelo = $row['modelo'];
			$this->tipo = $row['tipo'];
			$this->tipo_consumo = $row['tipo_consumo'];
			$this->ano = $row['ano'];	
			$this->cor = $row['cor'];
			$this->fabricante = $row['fabricante'];
			$this->data_compra = $row['data_compra'];
			$this->seguro = $row['seguro'];	
			$this->horimetro_inicial = $row['horimetro_inicial'];			
			$this->id_empresa = $row['id_empresa'];
			$this->id_fornecedor = $row['id_fornecedor'];
			$this->id_responsavel = $row['id_responsavel'];
			$this->observacao = $row['observacao'];		
			$this->valor = $row['valor'];
	     	
	     	return $this;
	     }
	}	

	public function atualiza_maquinario($matricula, $chassi_nserie, $modelo, $tipo, $tipo_consumo, $ano, $cor,
                   $fabricante, $data_compra, $seguro, $horimetro_inicial, $id_empresa,
                                 $id_fornecedor, $id_responsavel, $observacao,  $valor, $id){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE maquinario SET matricula='%s', chassi_nserie='%s', modelo='%s', tipo='%s', tipo_consumo='%s', ano='%s', cor='%s',
 											fabricante='%s', data_compra='%s', seguro='%s', horimetro_inicial='%s', id_empresa='%s',
 												 id_fornecedor='%s', id_responsavel='%s', observacao='%s',  valor='%s'  WHERE id ='%s' ";

		$query_tra = $g->tratar_query($query, $matricula, $chassi_nserie, $modelo, $tipo, $tipo_consumo, $ano, $cor,
									 $fabricante, $data_compra, $seguro, $horimetro_inicial, $id_empresa,
									 							 $id_fornecedor, $id_responsavel, $observacao,  $valor, $id);
		
		if($query_tra){
			return $query_tra;
		}else{
			return false;
		}
		
	}
}
	
 ?>