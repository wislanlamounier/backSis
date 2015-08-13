<?php
include_once("class_endereco_bd.php");
include_once("class_empresa_bd.php");
include_once("class_sql.php");
include_once("../global.php");
include_once("class_cidade_bd.php");

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
	public function get_cli_by_name($name, $tipo){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%%%s%%' && tipo = '%s' && id_empresa='%s' && oculto = 0";
		$query_tra = $g->tratar_query($query, $name, $tipo, $_SESSION['id_empresa']);

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

		 $query = "SELECT * FROM clientes WHERE id= '%s' && tipo = 0 && oculto=0" ;
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
	     	$this->fornecedor = $row['fornecedor'];
	     	$this->id_empresa = $row['id_empresa'];

	     	return $this;
	     }

	}


	public function atualiza_cli($id, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $rg, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		
		$query = "UPDATE clientes SET nome_razao_soc='%s', cpf_cnpj='%s', data_nasc_data_fund='%s', cpf_cnpj='%s', telefone_cel='%s', telefone_com='%s', tipo='%s', rg='%s', id_endereco='%s', responsavel='%s', cpf_responsavel ='%s', data_nasc_responsavel='%s', site='%s', observacao='%s', fornecedor='%s' WHERE id = '%s'";
		
		// printf($query, $nome, $cpf, $data_nasc, $telefone, $email, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $id);
		
		$query_tra = $g->tratar_query($query, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $rg, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor, $id);
		
		if($query_tra){
			return $query_tra;
		}else{
			return false;
		}
		
	}

	public function get_cli_jur_by_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%%%s%%' && tipo = 1 && oculto = 0";
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
	
	public function ocultar_by_id($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE clientes SET oculto = 1 WHERE id = %s";
		$result = $g->tratar_query($query, $id);
		if($result){
			echo '<div class="msg">Cliente excluido com sucesso!</div>';
		}
	}

	public function get_cli_jur_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM clientes WHERE id= '%s' && tipo =1";
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
	     	$this->fornecedor = $row['fornecedor'];
	     	$this->id_empresa = $row['id_empresa'];
	     	return $this;
	     }

	}

	public function atualiza_cli_jur($id, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $inscricao_estadual, $inscricao_municipal, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor, $email_resp ){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		
		$query = "UPDATE clientes SET nome_razao_soc='%s', cpf_cnpj='%s', data_nasc_data_fund='%s', cpf_cnpj='%s', telefone_cel='%s', telefone_com='%s', tipo='%s', inscricao_estadual='%s', inscricao_municipal='%s', id_endereco='%s', responsavel='%s', cpf_responsavel ='%s', data_nasc_responsavel='%s', site='%s', observacao='%s', fornecedor='%s', email_responsavel='%s' WHERE id = '%s'";
		
		// printf($query, $nome, $cpf, $data_nasc, $telefone, $email, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $id);
		
		$query_tra = $g->tratar_query($query, $nome, $cpf, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $inscricao_estadual, $inscricao_municipal, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_responsavel, $site, $observacao, $fornecedor,$email_resp, $id);
		if($query_tra){
			}
		return $query_tra;
	}

	public function pesquisa_cli_by_name($name_razao_soc ,$tipo ,$id_empresa){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%%%s%%' && tipo = '%s' && id_empresa='%s' && oculto=0";
		$query_tra = $g->tratar_query($query, $name_razao_soc, $tipo, $id_empresa);

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
	    public function get_all_cliente(){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        $aux=0;
      
        $query = $g->tratar_query("SELECT * FROM clientes WHERE oculto = 0 && fornecedor = 1");

        while($result = mysql_fetch_array($query)){
          $return[$aux][0] = $result['id'];
          $return[$aux][1] = $result['nome_razao_soc'];          
          $aux++;
        }
        return $return;
        
    }

	public function printCli_Jur(){	
	 	

		$endereco = new Endereco();
		$endereco = $endereco->get_endereco_id($this->id_endereco);
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa_by_id($this->id_empresa);
        $cidade = new Cidade();
        $cidade = $cidade->get_city_by_id($endereco->id_cidade);
	
		$texto ="";
		$texto .= "<table class='table_pesquisa'><tr>";
		$texto .= "<td><b>ID: </b></td><td>".$this->id."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Nome: </b></td><td>".$this->nome."</td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><b>Telefone Celular: </b></td><td>".$this->telefone_cel."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Telefone Comercial: </b></td><td>".$this->telefone_com."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>CNPJ: </b></td><td>".$this->cpf."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Inscricão Estadual: </b></td><td>".$this->inscricao_estadual."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Inscricao Municipal: </b></td><td>".$this->inscricao_municipal."</td>";		
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Site: </b></td><td>".$this->site."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Data de Fundação: </b></td><td>".$this->data_nasc."</td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><b>Rua: </b></td><td>".$endereco->rua."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>CEP: </b></td><td>".$endereco->cep."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Bairro: </b></td><td>".$endereco->bairro."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Numero </b></td><td>".$endereco->numero."</td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><b>Cidade: </b></td><td>".$cidade->nome."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Responsavel: </b></td><td>".$this->responsavel."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>CPF: </b></td><td>".$this->cpf_responsavel."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Email: </b></td><td>".$this->email_resp."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Observações: </b></td><td>".$this->observacao."</td>";
		$texto .= "</tr>";		
		if($this->fornecedor == 0){
			echo "";
		}elseif ($this->fornecedor==1){
			$texto .= "<tr>";
		$texto .= "<td><b>Forncedor: </b></td><td>".$this->fornecedor."</td>";	
		$texto .= "</tr>";	
		}									
		$texto .= "</table>";
	
 		return $texto;
	 }

	public function printCli(){
		

		$endereco = new Endereco();
		$endereco = $endereco->get_endereco_id($this->id_endereco);
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa_by_id($this->id_empresa);
        $cidade = new Cidade();
        $cidade = $cidade->get_city_by_id($endereco->id_cidade);

		$texto ="";
		$texto .= "<table class='table_pesquisa'><tr>";
		$texto .= "<td><b>ID: </b></td><td>".$this->id."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Empresa: </b></td><td>".$empresa->nome_fantasia."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Nome: </b></td><td>".$this->nome."</td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><b>Telefone: </b></td><td>".$this->telefone_cel."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Telefone: </b></td><td>".$this->telefone_com."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>CPF: </b></td><td>".$this->cpf."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Site: </b></td><td>".$this->site."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Data Nasc: </b></td><td>".$this->data_nasc."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Data Nasc: </b></td><td>".$this->rg."</td>";		
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Rua: </b></td><td>".$endereco->rua."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>CEP: </b></td><td>".$endereco->cep."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Bairro: </b></td><td>".$endereco->bairro."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Numero </b></td><td>".$endereco->numero."</td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><b>Cidade: </b></td><td>".$cidade->nome."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Responsavel: </b></td><td>".$this->responsavel."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>CPF: </b></td><td>".$this->cpf_responsavel."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Email: </b></td><td>".$this->email_resp."</td>";
		$texto .= "<tr>";		
		$texto .= "<td><b>Observações: </b></td><td>".$this->observacao."</td>";
		$texto .= "</tr>";		
		if($this->fornecedor == 0){
			echo "";
		}elseif ($this->fornecedor==1){
			$texto .= "<tr>";
		$texto .= "<td><b>Forncedor: </b></td><td>".$this->fornecedor."</td>";	
		$texto .= "</tr>";	
		}
									
		$texto .= "</table>";
	
 		return $texto;
	 }
}
	


?>