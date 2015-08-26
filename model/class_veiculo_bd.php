<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Veiculo{

	public $id;
	public $matricula;
	public $chassi;
	public $renavam;
	public $placa;
	public $marca;
	public $modelo;
	public $ano;
	public $cor;
	public $valor;
	public $data_compra;
	public $seguro;	
	public $km_inicial;
	public $tipo_combustivel;
	public $id_empresa;
	public $id_fornecedor;
	public $id_responsavel;
	public $oculto;

	public function add_veiculo($matricula, $chassi, $renavam, $placa, $marca, $modelo, $ano, $cor, $valor, $data_compra, $seguro, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel){
			
			$this->matricula = $matricula;
			$this->chassi = $chassi;
			$this->renavam = $renavam;
			$this->placa = $placa;
			$this->marca = $marca;
			$this->modelo = $modelo;
			$this->ano = $ano;
			$this->cor = $cor;
			$this->valor = $valor;
			$this->data_compra = $data_compra;
			$this->seguro = $seguro;			
			$this->km_inicial = $km_inicial;
			$this->tipo_combustivel = $tipo_combustivel;
			$this->id_empresa = $id_empresa;
			$this->id_fornecedor = $id_fornecedor;
			$this->id_responsavel= $id_responsavel;
	}

	public function add_veiculo_bd(){
			$sql = new Sql();
			$sql->conn_bd();
			$g = new Glob();
			$query = "INSERT INTO veiculo(matricula, chassi, renavam, placa, marca, modelo, ano, cor, valor, data_compra, seguro, km_inicial, tipo_combustivel, id_empresa, id_fornecedor, id_responsavel)
									VALUES ('%s',	  '%s',	  '%s',   '%s',	'%s',	'%s',  '%s','%s',  '%s',  	'%s',         '%s',		'%s',		'%s',			'%s',		'%s',			'%s'	)";
			if($g->tratar_query($query, $this->matricula, $this->chassi, $this->renavam, $this->placa, $this->marca, $this->modelo, $this->ano, $this->cor, $this->valor, $this->data_compra, $this->seguro, $this->km_inicial, $this->tipo_combustivel, $this->id_empresa, $this->id_fornecedor, $this->id_responsavel)){
			return true; 
		}else{
			return false;
		} 
	}
	public function get_veiculo_nome($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM veiculo WHERE modelo LIKE '%%%s%%' &&  oculto = 0 && id_empresa=".$_SESSION['id_empresa'];
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['matricula'];
			$return[$aux][2] = $result['modelo'];
			$return[$aux][3] = $result['marca'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum veículo encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}

	public function get_veiculo_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM veiculo WHERE id = '%s' && oculto =0 && id_empresa=".$_SESSION['id_empresa'];
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            echo 'Nenhum veículo encontrado';
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id= $row['id'];
	     	$this->matricula= $row['matricula'];
			$this->renavam= $row['renavam'];
			$this->placa= $row['placa'];
			$this->chassi= $row['chassi'];
			$this->marca = $row['marca'];
			$this->modelo=  $row['modelo'];
			$this->cor= $row['cor'];
			$this->ano= $row['ano'];
			$this->tipo_combustivel= $row['tipo_combustivel'];
			$this->data_compra = $row['data_compra'];
			$this->valor = $row['valor'];
			$this->seguro= $row['seguro'];
			$this->km_inicial= $row['km_inicial'];
			$this->id_fornecedor= $row['id_fornecedor'];
			$this->id_empresa= $row['id_empresa'];
			$this->id_responsavel= $row['id_responsavel'];
	     	
	     	return $this;
	     }
	}	
	
	public function atualiza_veiculo($matricula, $chassi, $renavam, $placa, $marca, $modelo, $ano, $cor, $valor, $data_compra, $seguro, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel, $id){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE veiculo SET matricula='%s', chassi='%s', renavam='%s', placa='%s', marca='%s', modelo='%s', ano='%s', cor='%s', valor='%s', data_compra='%s', seguro='%s', km_inicial='%s', tipo_combustivel='%s', id_empresa='%s', id_fornecedor='%s', id_responsavel='%s' WHERE id ='%s' ";

		$query_tra = $g->tratar_query($query, $matricula, $chassi, $renavam, $placa, $marca, $modelo, $ano, $cor, $valor, $data_compra, $seguro, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel ,$id);
		
		if($query_tra){
			return $query_tra;
		}else{
			return false;
		}
		
	}
	
	// public function get_veiculo_chassi($chassi){
	// 		$sql = new Sql();
	//         $sql->conn_bd();
	//         $g = new Glob();
	//         $aux=0;
	//         $return = array();
	//         $query = $g->tratar_query("SELECT * FROM veiculo WHERE oculto = 0 && chassi LIKE '%%%s%%'",$chassi);

	//         while($result = mysql_fetch_array($query)){
	//           $return[$aux][0] = $result['matricula'];
	//           $return[$aux][1] = $result['chassi'];
	//           $return[$aux][2] = $result['modelo'];
	//           $return[$aux][3] = $result['marca'];
	//           $return[$aux][4] = $result['cor'];
	//           $aux++;
	//         }
	//         if($aux == 0){
	//           echo "<div class='msg'> nao encontrou veiculos !</div>";
	//         }else{
	//         return $return;
	//         }
	// 	}
	// public function get_all_veiculo(){
	// 	$sql = new Sql();
	// 	$sql = conn_bd();
	// 	$g = new Glob();
	// 	$query = "SELECT * FROM veiculo WHERE oculto = 0 and id_empresa='".$_SESSION['id_empresa']."'";

	// 	while($result = mysql_fetch_array($query)){
	//           $return[$aux][0] = $result['matricula'];	          
	//           $return[$aux][1] = $result['modelo'];
	//           $return[$aux][2] = $result['marca'];
	//           $return[$aux][3] = $result['cor'];
	//           $aux++;
	//         }
	//         if($aux == 0){
	//           echo "<div class='msg'>Nenhum veiculo cadastrado !</div>";
	//         }else{
	//         return $return;
	//         }
	// 	}

	// public function printVeiculo(/*$id_grupo*/){
	// 	// $empresa = new Empresa();
	// 	// $empresa = $empresa->get_empresa_by_id($this->id_empresa);		
	// 	// $responsavel = new Funcionario();
 //  		// $responsavel = $responsavel->get_func_id($this->id_responsavel);
 //  		// $grupo = new Grupo();
 //  		// $grupo = $grupo->get_grupo_id($id_grupo);
 //      	$texto = "";
	// 	$texto .= "<table class='table_pesquisa'><tr>";
	// 	$texto .= "<td colspan='2'><b><span>Matricula: <span></b></td><td colspan='2'><span><span>".$this->matricula."</span></td>";
	// 	$texto .= "</tr>";
	// 	$texto .= "<tr>";
	// 	$texto .= "<td colspan='2'><b><span>Modelo: <span></b></td><td><span>".$this->modelo."</span> <td><span>Cor: <span></b></td> <td><span>".$this->cor."</span></td></td>";
	// 	$texto .= "</tr>";
	// 	$texto .= "<tr>";
	// 	$texto .= "<td colspan='2'><b><span>Marca: <span></b></td><td><span><span>".$this->marca."</span> <td><span>Marca: <span></b></td> <td><span><span>".$this->marca."</span></td></td>";
	// 	$texto .= "</tr>";	
	// 	$texto .= "</table>";
	// 	return $texto;	}

}
 ?>