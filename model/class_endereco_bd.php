<?php

include_once("class_sql.php");
include_once("../global.php");

class Endereco{
	public $id;
	public $rua;
	public $numero;
	public $id_cidade;
	public $bairro;
	public $cep;
	

	public function verifica_endereco($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "SELECT * FROM endereco WHERE id = '%s'";
		$result = $g->tratar_query($query, $id);

		if(@mysql_num_rows($result) == 0){
			return false;
		}else{
			return true;
		}
	}

	public function get_endereco($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = 'SELECT * FROM endereco WHERE id = %d';
		$result = $g->tratar_query($query, $id);

		if(@mysql_num_rows($result) == 0){
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$endereco[0][0] = $row['rua'];
	     	$endereco[0][1] = $row['numero'];
	     	$endereco[0][4] = $row['bairro'];
	     	$endereco[0][5] = $row['cep'];

	     	$query = 'SELECT * FROM cidade WHERE id = '.$row['id_cidade'];
	     	$result = mysql_query($query);
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$endereco[0][2] = $row['id']; //id cidade
	     	
	     	$query = 'SELECT * FROM estado WHERE id = '.$row['estado'];
	     	$result = mysql_query($query);
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$endereco[0][3] = $row['id'];// id estado
	     	return $endereco;
	     }
	}

	public function add_endereco($rua, $numero, $id_cidade, $bairro, $cep){
		$this->rua = $rua;
		$this->numero = $numero;
		$this->id_cidade = $id_cidade;
		$this->bairro = $bairro;
		$this->cep = $cep;
	}

	public function add_endereco_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO endereco (rua, numero, id_cidade, bairro, cep) VALUES ('%s', %d, %d,'%s','%s')";

		$result = $g->tratar_query($query, $this->rua, $this->numero, $this->id_cidade, $this->bairro, $this->cep); //inserindo no banco de dados
		
		$query = "SELECT * FROM endereco order by id desc";
		$result = $g->tratar_query($query); //pegando id da ultima insersão
		 
		 if(@mysql_num_rows($result) == 0){
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$id = $row['id'];
	     	return $id;
	     }
	}

	public function atualiza_endereco($rua, $numero, $id_cidade, $id_endereco, $bairro, $cep){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE endereco SET rua='%s', numero='%s', id_cidade='%s', bairro = '%s', cep = '%s' WHERE id='%s' ";

		if($g->tratar_query($query, $rua, $numero, $id_cidade,$bairro, $cep, $id_endereco)){
			return true;
		}else{
			return false;
		}
	}

	public function printEndereco(){
		return "Rua: ".$this->rua."<br /> Numero: ".$this->numero."<br />Id_cidade: ".$this->id_cidade;
	}

	
}


 ?>