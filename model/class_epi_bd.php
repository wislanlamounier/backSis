<?php
include_once("class_sql.php");
include_once("../global.php");


class Epi{ 

	public $id;
	public $codigo;
	public $nome_epi;
	public $descricao;
	public $id_empresa;
	public $is_epi;

	//$is_epi, $_POST['codigo'], $_POST['nome'], $_POST['desc'],  $_POST['empresa'])

	public function add_epi($is_epi, $codigo, $nome_epi, $descricao, $id_empresa){
		$this->codigo = $codigo;
		$this->nome_epi = $nome_epi;
		$this->descricao = $descricao;
		$this->id_empresa = $id_empresa;
		$this->is_epi = $is_epi;
	}
	public function add_epi_bd(){
		$sql= new Sql();
		$sql->conn_bd();

		$g = new Glob();

		$query = "INSERT INTO equipamentos_func (epi, codigo, nome_epi, descricao, id_empresa)
		                        VALUES ( %d, '%s' ,'%s', '%s', '%s')";
		
		if($g->tratar_query($query, $this->is_epi, $this->codigo, $this->nome_epi, $this->descricao, $this->id_empresa)){
			return true; 
		}else{
			return false;
		} 
	}
	
	public function atualiza_epi($is_epi, $codigo, $nome_epi, $descricao, $id_empresa, $id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		
		$query = "UPDATE equipamentos_func SET epi = '%s', codigo = '%s', nome_epi='%s', descricao='%s', id_empresa='%s' WHERE id = '%s'";
		
		// printf($query, $nome, $cpf, $data_nasc, $telefone, $email, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $id);
		
		$query_tra = $g->tratar_query($query, $is_epi, $codigo, $nome_epi, $descricao, $id_empresa, $id);
		
		if($query_tra){
			return true;
		}else{
			return false;
	}
		
	}
	public function get_epi_by_name($nome_epi){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$return = array();
		$aux=0;
		$query = "SELECT * FROM equipamentos_func WHERE nome_epi LIKE '%%%s%%' && id_empresa = %s";
		$query_tra = $g->tratar_query($query, $nome_epi, $_SESSION['id_empresa']);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome_epi'];
			$aux++;
		}
		
		
		$sql->close_conn();
		return $return;
		
	}

	public function get_epi_by_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM equipamentos_func WHERE id= '%s'";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->codigo = $row['codigo'];
	     	$this->nome_epi = $row['nome_epi'];
	     	$this->descricao = $row['descricao'];
	     	$this->id_empresa = $row['id_empresa'];     	
	     	$this->is_epi = $row['epi'];
	     	return $this;
	}

	}
	public function get_name_all_epi(){
		$sql = new Sql();
		$sql->conn_bd();
		$aux=0;
		$return = array();
		$query = mysql_query("SELECT * FROM equipamentos_func");

		while($result = mysql_fetch_array($query)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome_epi'];
			$aux++;
		}
		return $return;
	}

	public function get_epi_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM equipamentos_func WHERE nome_epi LIKE '%%%s%%'";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
 			$return[$aux][1] = $result['nome_epi'];
			$return[$aux][2] = $result['descricao'];
			
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum EPI encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}
	public function printEpi(){
		
		echo "<table class='table_pesquisa'>";
		echo "<tr><td>ID: </td><td>".$this->id."</td></tr>";
		echo "<tr><td>Nome: </td><td>".$this->nome_epi."</td></tr>";
		echo "<tr><td>Descricao: </td><td>".$this->descricao."</td></tr>";
		if($this->is_epi == 1){
			echo"<tr><td>Equipamento de Proteção</td><td><input type='checkbox' disabled checked>";
		}
		if($this->is_epi == 0){
			echo"<tr><td>Equipamento de Proteção</td><td><input type='checkbox' disabled>";
		}		
		echo "</table>";		
		}



	public function get_epi_by_id_nome($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM equipamentos_func WHERE id= '%s'";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	
	     	$this->nome_epi = $row['nome_epi'];	     	
	     	    	

	     	return $this;
	     }

	}

}

?>


