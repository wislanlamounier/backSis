<?php

include_once("class_sql.php");
include_once("../global.php");


class Epi { 

	public $id;
	public $nome_epi;
	public $descricao;
	public $id_empresa;

	public function add_epi($nome_epi, $descricao, $id_empresa){

		$this->nome_epi = $nome_epi;
		$this->descricao = $descricao;
		$this->id_empresa = $id_empresa;
	}
	public function add_epi_bd(){
		$sql= new Sql();
		$sql->conn_bd();

		$g = new Glob();

		$query = "INSERT INTO epi (nome_epi, descricao, id_empresa)
		                        VALUES ( '%s', '%s', %s)";
		
		if($g->tratar_query($query, $this->nome_epi, $this->descricao, $this->id_empresa)){
			return true; 
		}else{
			return false;
		} 
	}

		public function atualiza_epi($nome_epi, $descricao, $id_empresa, $id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		
		$query = "UPDATE epi SET nome_epi='%s', descricao='%s', id_empresa='%s' WHERE id = '%s'";
		
		// printf($query, $nome, $cpf, $data_nasc, $telefone, $email, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $id);
		
		$query_tra = $g->tratar_query($query, $nome_epi, $descricao, $id_empresa, $id);
		
		if($query_tra){
			return $query_tra;
		}else{
			return false;
		}
		
	}
	public function get_epi_by_name($nome_epi){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM epi WHERE nome_epi LIKE '%%%s%%'";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome_epi'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum cliente encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}

	 	public function get_epi_by_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM epi WHERE id= '%s'";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->nome_epi = $row['nome_epi'];
	     	$this->descricao = $row['descricao'];
	     	$this->id_empresa = $row['id_empresa'];     	

	     	return $this;
	     }

	}
	public function get_name_all_epi(){
		$sql = new Sql();
		$sql->conn_bd();
		$aux=0;
		$query = mysql_query("SELECT * FROM epi");

		while($result = mysql_fetch_array($query)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome_epi'];
			$aux++;
		}
		return $return;
	}

	public function get_epi_by_id_nome($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM epi WHERE id= '%s'";
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




<!-- 

// 		public function get_cli_jur_by_name($name){
// 		$sql = new Sql();
// 		$sql->conn_bd();
// 		$g = new Glob();
// 		$aux=0;
// 		$query = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%%%s%%' && tipo = 1";
// 		$query_tra = $g->tratar_query($query, $name);

// 		while($result =  mysql_fetch_array($query_tra)){
// 			$return[$aux][0] = $result['id'];
// 			$return[$aux][1] = $result['nome_razao_soc'];
// 			$aux++;
// 		}
// 		if($aux == 0){
// 			$sql->close_conn();
// 			echo '<div class="msg">Nenhum cliente encontrado!</div>';
// 		}else{
// 			$sql->close_conn();
// 			return $return;
// 		}
// 	}

// 	public function get_cli_jur_id($id){
// 		 $sql = new Sql();
// 		 $sql->conn_bd();
// 		 $g = new Glob();

// 		 $query = "SELECT * FROM clientes WHERE id= '%s' && tipo != 0";
// 		 $result = $g->tratar_query($query, $id);
		 
// 		 if(@mysql_num_rows($result) == 0){
     
//             return false;            
// 	     }else{

// 	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
// 	     	$this->id = $row['id'];
// 	     	$this->nome = $row['nome_razao_soc'];
// 	     	$this->data_nasc = $row['data_nasc_data_fund'];
// 	     	$this->cpf = $row['cpf_cnpj'];
// 	     	$this->telefone_cel = $row['telefone_cel'];	
// 	     	$this->telefone_com = $row['telefone_com'];
// 	     	$this->inscricao_estadual = $row['inscricao_estadual'];
// 	     	$this->inscricao_municipal=$row['inscricao_municipal'];  
// 	     	$this->id_endereco = $row['id_endereco'];
// 	     	$this->tipo = $row['tipo'];	 
// 	     	$this->responsavel = $row['responsavel'];
// 	     	$this->cpf_responsavel = $row['cpf_responsavel'];
// 	     	$this->data_nasc_responsavel = $row['data_nasc_responsavel'];
// 	     	$this->email_resp= $row['email_responsavel'];
// 	     	$this->observacao = $row['observacao'];
// 	     	$this->site = $row['site'];
// 	     	$this->fornecedor= $row['fornecedor'];
// 	     	return $this;
// 	     }

// 	}

// }


 -->