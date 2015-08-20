<?php
session_start();
include_once("../model/class_sql.php");
require_once("../global.php");

class Veiculo{

								public $id;
								public $matricula;
								public $chassi;
								public $placa;
								public $marca;
								public $modelo;
								public $ano;
								public $cor;
								public $assegurado;
								public $quilometragem;
								public $km_inicial;
								public $tipo_combustivel;
								public $id_empresa;
								public $id_fornecedor;
								public $id_responsavel;
								public $oculto;

	public function add_veiculo($matricula, $chassi, $placa, $marca, $modelo, $ano, $cor, $assegurado, $quilometragem, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel, $oculo){
		
			$this->matricula =$matricula;
			$this->chassi =$chassi;
			$this->placa =$placa;
			$this->marca =$marca;
			$this->modelo =$modelo;
			$this->ano =$ano;
			$this->cor =$cor;
			$this->assegurado =$assegurado;
			$this->quilometragem =$quilometragem;
			$this->km_inicial =$km_inicial;
			$this->tipo_combustivel =$tipo_combustivel;
			$this->id_empresa =$id_empresa;
			$this->id_fornecedor =$id_fornecedor;
			$this->id_responsavel=$id_responsavel;
			$this->oculto = $oculto;

	}

	public function add_veiculo_bd(){
			$sql = new Sql();
			$sql->conn_bd();
			$g = new Glob();
			$query = "INSERT INTO veiculo(matricula, chassi, placa, marca, modelo, ano, cor, assegurado, quilometragem, km_inicial, tipo_combustivel, id_empresa, id_fornecedor, id_responsavel, oculto)
									VALUES ('%s',	'%s',	 '%s',	'%s',	'%s',  '%s','%s',	'%s',		'%s',			'%s',		'%s',			'%s',		'%s',			'%s'			'%s')");
			return $g->tratar_query($query, $this->matricula, $this->chassi, $this->placa, $this->marca, $this->modelo, $this->ano, $this->cor, $this->assegurado, $this->quilometragem, $this->km_inicial, $this->tipo_combustivel,$this->id_empresa, $this->id_fornecedor, $this->id_responsavel, $oculto);
	}
	
	public function get_veiculo_chassi($chassi){
			$sql = new Sql();
	        $sql->conn_bd();
	        $g = new Glob();
	        $aux=0;
	        $return = array();
	        $query = $g->tratar_query("SELECT * FROM veiculo WHERE oculto = 0 && chassi LIKE '%%%s%%'",$chassi);

	        while($result = mysql_fetch_array($query)){
	          $return[$aux][0] = $result['matricula'];
	          $return[$aux][1] = $result['chassi'];
	          $return[$aux][2] = $result['modelo'];
	          $return[$aux][3] = $result['marca'];
	          $return[$aux][4] = $result['cor'];
	          $aux++;
	        }
	        if($aux == 0){
	          echo "<div class='msg'> nao encontrou veiculos !</div>";
	        }else{
	        return $return;
	        }
		}
	public function get_all_veiculo(){
		$sql = new Sql();
		$sql = conn_bd();
		$g = new Glob();
		$query = "SELECT * FROM veiculo WHERE oculto = 0 and id_empresa='".$_SESSION['id_empresa']."'";

		while($result = mysql_fetch_array($query)){
	          $return[$aux][0] = $result['matricula'];	          
	          $return[$aux][1] = $result['modelo'];
	          $return[$aux][2] = $result['marca'];
	          $return[$aux][3] = $result['cor'];
	          $aux++;
	        }
	        if($aux == 0){
	          echo "<div class='msg'>Nenhum veiculo cadastrado !</div>";
	        }else{
	        return $return;
	        }
		}

	public function printVeiculo(/*$id_grupo*/){
		// $empresa = new Empresa();
		// $empresa = $empresa->get_empresa_by_id($this->id_empresa);		
		// $responsavel = new Funcionario();
  		// $responsavel = $responsavel->get_func_id($this->id_responsavel);
  		// $grupo = new Grupo();
  		// $grupo = $grupo->get_grupo_id($id_grupo);
      	$texto = "";
		$texto .= "<table class='table_pesquisa'><tr>";
		$texto .= "<td colspan='2'><b><span>Matricula: <span></b></td><td colspan='2'><span><span>".$this->matricula."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Modelo: <span></b></td><td><span>".$this->modelo."</span> <td><span>Cor: <span></b></td> <td><span>".$this->cor."</span></td></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Marca: <span></b></td><td><span><span>".$this->marca."</span> <td><span>Marca: <span></b></td> <td><span><span>".$this->marca."</span></td></td>";
		$texto .= "</tr>";	
		$texto .= "</table>";
		return $texto;	}

}
 ?>