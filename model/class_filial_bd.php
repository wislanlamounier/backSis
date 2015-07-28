<?php 
         
include_once("class_sql.php");
include_once("class_turno_bd.php");
require_once(dirname(__FILE__) . "/../global.php");

class Filial{
	public $id;
	public $nome;
	// public $cnpj;
	public $cod_posto;
	public $telefone;
	public $id_endereco;
	public $id_responsavel;
	public $id_empresa;
	
	public function add_filial($nome, $cod_posto, $telefone, $id_endereco, $id_responsavel, $id_empresa){
			$this->nome = $nome;
			// $this->cnpj = $cnpj;
			$this->cod_posto = $cod_posto;
			$this->telefone = $telefone;
			$this->id_endereco = $id_endereco;
			$this->id_responsavel = $id_responsavel;
			$this->id_empresa = $id_empresa;
	}
	public function add_filial_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO filiais (nome, cod_posto, telefone, id_endereco, id_responsavel, id_empresa) VALUES ( '%s', '%s', '%s', '%s', '%s', '%s')";
		
		if($g->tratar_query($query, $this->nome,  $this->cod_posto, $this->telefone, $this->id_endereco, $this->id_responsavel, $this->id_empresa)){
			return true;
		}else{
			return false;
		}
	}
	
	public function atualiza_filial($id, $nome,  $cod_posto, $telefone, $id_endereco, $id_responsavel, $id_empresa){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "UPDATE filiais SET nome = '%s',  cod_posto = '%s', telefone = '%s', id_endereco = '%s', id_responsavel = '%s', id_empresa = '%s' WHERE id =  '%s'";

		if($g->tratar_query($query, $nome,  $cod_posto, $telefone, $id_endereco, $id_responsavel, $id_empresa, $id)){
			return true;
		}else{
			return false;
		}
	}

	public function get_filial_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM filiais WHERE id = '%s'";

		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->nome = $row['nome'];
	     	// $this->cnpj = $row['cnpj'];
	     	$this->cod_posto = $row['cod_posto'];
	     	$this->telefone = $row['telefone'];
	     	$this->id_endereco = $row['id_endereco'];
	     	$this->id_responsavel = $row['id_responsavel'];
	     	$this->id_empresa = $row['id_empresa'];
	     	
	     	return $this;
	     }
	}
	public function get_filial_by_cnpj_and_nome($nome){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = $g->tratar_query("SELECT * FROM filiais WHERE oculto = 0 && nome LIKE '%%%s%%'", $nome);

		while($result =  mysql_fetch_array($query)){
		 	$return[$aux][0] = $result['id'];
		 	$return[$aux][1] = $result['nome'];
		    $return[$aux][2] = $result['cod_posto'];
		 	$aux++;
		 }
		 
		 return $return;
	}
	public function get_name_all_filial(){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $return = array(array());
		 $aux=0;

		 $query = mysql_query("SELECT * FROM filiais");
		 
		 while($result =  mysql_fetch_array($query)){
		 	$return[$aux][0] = $result['id'];
		 	$return[$aux][1] = $result['nome'];
		 	$aux++;
		 }
		 
		 return $return;
	}

	public function get_filial_by_empresa($id_empresa){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux = 0;
		$query = "SELECT * FROM filiais WHERE id_empresa = %s";
		$query = $g->tratar_query($query, $id_empresa);

		while($result = mysql_fetch_array($query)){
			
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['cod_posto'];
			$return[$aux][2] = $result['nome'];
			$return[$aux][3] = $result['id_responsavel'];
			$aux++;
		}
		return $return;
	}
	public function printFilial(){
		echo "Nome: ".$this->nome."<br />";

	}
	
	
}

 ?>