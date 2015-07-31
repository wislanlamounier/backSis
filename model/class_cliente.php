<?php

include_once("class_sql.php");
include_once("../global.php");


class Cliente { 

	public $id;
	public $data_nasc_data_fund;
	public $cpf_cnpj;
	public $nome_razao_soc;
	public $telefone_cel;
	public $telefone_com;
	public $id_endereco;
	public $tipo;
	public $rg;
	public $inscricao_estadual;
	public $inscricao_municipal;
	public $responsavel;
	public $cpf_responsavel;
	public $data_nasc_resp;
	public $email_resp;
	public $site;
	public $observacao;
	public $fornecedor;

	public function add_cliente($nome_razao_soc, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $id_endereco, $tipo, $rg, $inscricao_estadual, $inscricao_municipal, $responsavel, $cpf_responsavel, $data_nasc_resp, $email_resp, $site, $observacao, $fornecedor){

		$this->nome_razao_soc = $nome_razao_soc;
		$this->data_nasc_data_fund = $data_nasc_data_fund;
		$this->cpf_cnpj = $cpf_cnpj;
		$this->telefone_cel = $telefone_cel;
		$this->telefone_com = $telefone_com;
		$this->id_endereco = $id_endereco;
		$this->tipo = $tipo;
		$this->rg = $rg;
		$this->inscricao_estadual = $inscricao_estadual;
		$this->inscricao_municipal = $inscricao_municipal;
		$this->responsavel = $responsavel;
		$this->cpf_responsavel =$cpf_responsavel;
		$this->data_nasc_resp = $data_nasc_resp;
		$this->email_resp = $email_resp;
		$this->site = $site;
		$this->observacao = $observacao;
		$this->fornecedor = $fornecedor;

	}

	public function add_cliente_bd(){
		$sql= new Sql();
		$sql->conn_bd();

		$g = new Glob();

		$query = "INSERT INTO clientes (nome_razao_soc, data_nasc_data_fund, cpf_cnpj, telefone_cel, telefone_com, id_endereco, tipo, rg, inscricao_estadual, inscricao_municipal, responsavel, cpf_responsavel, data_nasc_responsavel, email_responsavel, site, observacao, fornecedor) 
		                        VALUES (    '%s',           '%s',                '%s',      '%s',         '%s',         '%s',    '%s','%s',       '%s',               '%s',             '%s',           '%s',               '%s',                 '%s',     '%s',    '%s',    '%s'     )";
		
		if($g->tratar_query($query, $this->nome_razao_soc, $this->data_nasc_data_fund, $this->cpf_cnpj, $this->telefone_cel,$this->telefone_com, $this->id_endereco, $this->tipo, $this->rg, $this->inscricao_estadual, $this->inscricao_municipal, $this->responsavel, $this->cpf_responsavel, $this->data_nasc_resp, $this->email_resp, $this->site, $this->observacao, $this->fornecedor)){
			return true; 
		}else{
			return false;
		} 
	}
	public function get_cli_by_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%%%s%%' && tipo = 0";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome_razao_soc'];
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


	public function get_cli_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM clientes WHERE id= '%s' && tipo = 0";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->nome = $row['nome_razao_soc'];
	     	$this->data_nasc = $row['data_nasc_data_fund'];
	     	$this->cpf = $row['cpf_cnpj'];
	     	$this->telefone_cel = $row['telefone_cel'];	
	     	$this->telefone_com = $row['telefone_com'];
	     	$this->rg = $row['rg'];  
	     	$this->id_endereco = $row['id_endereco'];
	     	$this->tipo = $row['tipo'];	 
	     	$this->responsavel = $row['responsavel'];
	     	$this->cpf_responsavel = $row['cpf_responsavel'];
	     	$this->data_nasc_responsavel = $row['data_nasc_responsavel'];
	     	$this->email_resp= $row['email_responsavel'];
	     	$this->observacao = $row['observacao'];
	     	$this->site = $row['site'];
	     	$this->fornecedor= $row['fornecedor'];

	     	return $this;
	     }

	}


	public function atualiza_cli($id, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $rg, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor ){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		
		$query = "UPDATE clientes SET nome_razao_soc='%s', cpf_cnpj='%s', data_nasc_data_fund='%s', cpf_cnpj='%s', telefone_cel='%s', telefone_com='%s', tipo='%s', rg='%s', id_endereco='%s', responsavel='%s', cpf_responsavel ='%s', data_nasc_responsavel='%s', site='%s', observacao='%s', fornecedor='%s' WHERE id = '%s'";
		
		// printf($query, $nome, $cpf, $data_nasc, $telefone, $email, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $id);
		
		$query_tra = $g->tratar_query($query, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $rg, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor, $id);
		if($query_tra){
			}
		return $query_tra;
	}

		public function get_cli_jur_by_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%%%s%%' && tipo = 1";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome_razao_soc'];
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

	public function get_cli_jur_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM clientes WHERE id= '%s' && tipo != 0";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->nome = $row['nome_razao_soc'];
	     	$this->data_nasc = $row['data_nasc_data_fund'];
	     	$this->cpf = $row['cpf_cnpj'];
	     	$this->telefone_cel = $row['telefone_cel'];	
	     	$this->telefone_com = $row['telefone_com'];
	     	$this->inscricao_estadual = $row['inscricao_estadual'];
	     	$this->inscricao_municipal=$row['inscricao_municipal'];  
	     	$this->id_endereco = $row['id_endereco'];
	     	$this->tipo = $row['tipo'];	 
	     	$this->responsavel = $row['responsavel'];
	     	$this->cpf_responsavel = $row['cpf_responsavel'];
	     	$this->data_nasc_responsavel = $row['data_nasc_responsavel'];
	     	$this->email_resp= $row['email_responsavel'];
	     	$this->observacao = $row['observacao'];
	     	$this->site = $row['site'];
	     	$this->fornecedor= $row['fornecedor'];
	     	return $this;
	     }

	}

	public function atualiza_cli_jur($id, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $inscricao_estadual, $inscricao_municipal, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor ){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		
		$query = "UPDATE clientes SET nome_razao_soc='%s', cpf_cnpj='%s', data_nasc_data_fund='%s', cpf_cnpj='%s', telefone_cel='%s', telefone_com='%s', tipo='%s', inscricao_estadual='%s', inscricao_municipal='%s', id_endereco='%s', responsavel='%s', cpf_responsavel ='%s', data_nasc_responsavel='%s', site='%s', observacao='%s', fornecedor='%s' WHERE id = '%s'";
		
		// printf($query, $nome, $cpf, $data_nasc, $telefone, $email, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $id);
		
		$query_tra = $g->tratar_query($query, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $inscricao_estadual, $inscricao_municipal, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor, $id);
		if($query_tra){
			}
		return $query_tra;
	}



}


?>