<?php 
         
include_once("class_sql.php");
include_once("class_turno_bd.php");
include_once("class_endereco_bd.php");
include_once("class_cidade_bd.php");
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

	public function ocultar_by_id($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE filiais SET oculto = 1 WHERE id = %s";
		$result = $g->tratar_query($query, $id);
		if($result){
			echo '<div class="msg">Filial excluida com sucesso!</div>';
		}
	}

	public function printFilial(){
		$endereco = new Endereco();
		$endereco = $endereco->get_endereco_id($this->id_endereco);
		$cidade = new Cidade();
        $cidade = $cidade->get_city_by_id($endereco->id_cidade);
		echo "<table class='table_pesquisa'>";
		echo "<tr><td>Nome: </td><td>".$this->nome."</td></tr>";
		echo "<tr><td>Telefone: </td><td>".$this->telefone."</td></tr>";
		echo "<tr><td>Codigo do posto: </td><td>".$this->cod_posto."</td></tr>";
		echo "<tr><td>Rua: </td><td>".$endereco->rua."</td></tr>";
		echo "<tr><td>Bairro: </td><td>".$endereco->bairro."</td></tr>";
		echo "<tr><td>Cidade: </td><td>".$cidade->nome."</td></tr>";
		echo "</table>";
	}
	
	
}

 ?>