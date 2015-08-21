<?php
include_once("class_sql.php");
include_once("class_turno_bd.php");
include_once("class_filial_bd.php");
include_once("class_empresa_bd.php");
include_once("class_cbo_bd.php");
include_once("class_epi_bd.php");
require_once(dirname(__FILE__) . "/../global.php");

class Funcionario{
	public $id;
	public $nome;
	public $cpf;
	public $rg;
	public $data_nasc;
	public $telefone;
	public $email;
	public $senha;
	public $id_cbo;
	public $id_endereco;
	public $id_empresa;
	public $id_empresa_filial;
	public $id_turno;
	public $is_admin;
	public $data_em_rg;
	public $org_em_rg;
	public $num_tit_eleitor;
	public $email_empresa;
	public $data_adm;
	public $salario_base;
	public $qtd_horas_sem;
	public $num_cart_trab;
	public $num_serie_cart_trab;
	public $uf_cart_trab;
	public $num_pis;
	public $id_supervisor;
	
	public function add_func($nome, $cpf, $rg, $data_nasc, $telefone, $email, $senha, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $data_em_rg, $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor){
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->data_nasc = $data_nasc;
		$this->telefone = $telefone;
		$this->email = $email;
		$this->senha = $senha;
	    $this->id_cbo = $id_cbo;
		$this->id_endereco = $id_endereco;
		$this->id_empresa = $id_empresa;
		$this->id_empresa_filial = $id_empresa_filial;
		$this->id_turno = $id_turno;
		$this->is_admin = $is_admin;

		$this->rg = $rg;
		$this->data_em_rg = $data_em_rg;
		$this->org_em_rg = $org_em_rg;
		$this->num_tit_eleitor = $num_tit_eleitor;
		$this->email_empresa = $email_empresa;
		$this->data_adm = $data_adm;
		$this->salario_base = $salario_base;
		$this->qtd_horas_sem = $qtd_horas_sem;
		$this->num_cart_trab = $num_cart_trab;
		$this->num_serie_cart_trab = $num_serie_cart_trab;
		$this->uf_cart_trab = $uf_cart_trab;
		$this->num_pis = $num_pis;
		$this->id_supervisor = $id_supervisor;
	}

	public function add_func_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();



		$query = "INSERT INTO funcionario (nome, cpf, rg, data_nasc, telefone, email, senha, id_turno, id_cbo, id_empresa, id_empresa_filial, is_admin, id_endereco, data_em_rg, org_em_rg, num_tit_eleitor, email_empresa, data_adm, salario_base, qtd_horas_sem, num_cart_trab, num_serie_cart_trab, id_uf_cart_trab, num_pis, id_supervisor) 
		                           VALUES ('%s','%s', '%s', '%s',      '%s',     '%s', '%s',    %d,       %d,      %d,             %d,        %d,        %d,        '%s',        '%s',         '%s',         '%s',         '%s',      '%s',          %d,          '%s',            '%s',                %d,           '%s',     '%s')";

		$result = $g->tratar_query($query, 
			                       $this->nome, $this->cpf, $this->rg, $this->data_nasc, $this->telefone, $this->email, $this->senha, $this->id_turno, $this->id_cbo, $this->id_empresa,
			                       $this->id_empresa_filial, $this->is_admin, $this->id_endereco, $this->data_em_rg, $this->org_em_rg, $this->num_tit_eleitor, $this->email_empresa, $this->data_adm, $this->salario_base, $this->qtd_horas_sem, $this->num_cart_trab, $this->num_serie_cart_trab, $this->uf_cart_trab, $this->num_pis, $this->id_supervisor);
		if($result){
			return true;
		}else{
			return false;
		}

	}

	public function get_func_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM funcionario WHERE id= '%s' && oculto = 0";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
     
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->nome = $row['nome'];
	     	$this->cpf = $row['cpf'];
	     	$this->email = $row['email'];
	     	$this->telefone = $row['telefone'];
	     	$this->data_nasc = $row['data_nasc'];
	     	$this->senha = $row['senha'];
	     	$this->id_cbo = $row['id_cbo'];
	     	$this->id_endereco = $row['id_endereco'];
	     	$this->id_empresa = $row['id_empresa'];
	     	$this->id_empresa_filial = $row['id_empresa_filial'];
	     	$this->telefone = $row['telefone'];
	     	$this->id_turno = $row['id_turno'];
	     	$this->is_admin = $row['is_admin'];
	     	$this->rg = $row['rg'];
			$this->data_em_rg = $row['data_em_rg'];
			$this->org_em_rg = $row['org_em_rg'];
			$this->num_tit_eleitor = $row['num_tit_eleitor'];
			$this->email_empresa = $row['email_empresa'];
			$this->data_adm = $row['data_adm'];
			$this->salario_base = $row['salario_base'];
			$this->qtd_horas_sem = $row['qtd_horas_sem'];
			$this->num_cart_trab = $row['num_cart_trab'];
			$this->num_serie_cart_trab = $row['num_serie_cart_trab'];
			$this->uf_cart_trab = $row['id_uf_cart_trab'];
			$this->num_pis = $row['num_pis'];
			$this->id_supervisor = $row['id_supervisor'];

	     	return $this;
	     }
	}
	public function get_admin(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux = 0;
		$query = "SELECT * FROM funcionario WHERE oculto = 0 && is_admin = 1 ORDER BY nome ASC";
		
		$query_tra = $g->tratar_query($query);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$aux++;
		}
		return $return;
	}
	public function aniversariantes_mes($data){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$mes = '-'.$data[3].$data[4].'-';
		$aux = 0;
		$query = "SELECT * FROM funcionario WHERE data_nasc LIKE '%%%s%%' && oculto = 0 ORDER BY data_nasc ASC";
		
		$query_tra = $g->tratar_query($query, $mes);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$return[$aux][2] = $result['data_nasc'];
			$aux++;
		}


		return $return;
	}
	public function verifica_func($id, $pass){
		
		$sql = new Sql();
		$sql->conn_bd();

		$g = new Glob();
		
		//criptografia md5() no campo senha
		$query = "SELECT * FROM funcionario WHERE id='%s' && senha = '%s' && oculto = 0";
		
		$result = $g->tratar_query($query,$id,$pass);// recebe query tratada
		
		if(@mysql_num_rows($result) == 0){
           
            return false;
            
        }else{
        	
        	return true;
        }
	}
	public function verifica_func_admin($id, $pass){
		
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		//criptografia md5() no campo senha
		$query = "SELECT * FROM funcionario WHERE id = '%s' && senha = '%s' && is_admin = 1 && oculto = 0";

		$result = $g->tratar_query($query,$id,$pass);// recebe query tratada

		if(@mysql_num_rows($result) == 0){
            return false;
        }else{
        	return true;
        }
	}
	public function get_ultimos_func($qtd){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$return = array();
		$aux=0;
		$query = "SELECT * FROM funcionario ORDER BY id DESC LIMIT $qtd";
		$query_tra = $g->tratar_query($query);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$aux++;
		}
		if($aux == 0){
			echo '<div class="msg">Nenhum funcionário encontrado!</div>';
		}else{
			return $return;
		}

	}

	// array(21) {
	// 	[0]=> string(1) "5" 
	// 	["id"]=> string(2) "15"
	// 	[1]=> string(3) "123"
	// 	["codigo"]=> string(3) "123" 
	// 	[2]=> string(7) "Óculos" 
	// 	["nome_epi"]=> string(7) "Óculos" 
	// 	[3]=> string(16) "Óculos de solda" 
	// 	["descricao"]=> string(16) "Óculos de solda" 
	// 	[4]=> string(1) "5" 
	// 	["id_empresa"]=> string(1) "5" 
	// 	[5]=> string(1) "1" 
	// 	["epi"]=> string(1) "1" 
	// 	[6]=> string(2) "15" 
	// 	[7]=> string(2) "18" 
	// 	["id_func"]=> string(2) "18" 
	// 	[8]=> string(1) "5" 
	// 	["id_epi"]=> string(1) "5" 
	// 	[9]=> string(10) "2015-08-10" 
	// 	["data_entrega"]=> string(10) "2015-08-10" 
	// 	[10]=> string(1) "1" 
	// 	["quantidade"]=> string(1) "1" 
	// } array(21) { 
	// 	[0]=> string(1) "5" 
	// 	["id"]=> string(2) "20" 
	// 	[1]=> string(3) "123" 
	// 	["codigo"]=> string(3) "123" 
	// 	[2]=> string(7) "Óculos" 
	// 	["nome_epi"]=> string(7) "Óculos" 
	// 	[3]=> string(16) "Óculos de solda" 
	// 	["descricao"]=> string(16) "Óculos de solda" 
	// 	[4]=> string(1) "5" 
	// 	["id_empresa"]=> string(1) "5" 
	// 	[5]=> string(1) "1" 
	// 	["epi"]=> string(1) "1" 
	// 	[6]=> string(2) "20" 
	// 	[7]=> string(2) "18" 
	// 	["id_func"]=> string(2) "18" 
	// 	[8]=> string(1) "5" 
	// 	["id_epi"]=> string(1) "5" 
	// 	[9]=> string(10) "2015-08-14" 
	// 	["data_entrega"]=> string(10) "2015-08-14" 
	// 	[10]=> string(2) "12" 
	// 	["quantidade"]=> string(2) "12" 
	// } array(21) { 
	// 	[0]=> string(1) "6" 
	// 	["id"]=> string(2) "13" 
	// 	[1]=> string(3) "124" 
	// 	["codigo"]=> string(3) "124" 
	// 	[2]=> string(6) "Camisa" 
	// 	["nome_epi"]=> string(6) "Camisa" 
	// 	[3]=> string(17) "Camisa da empresa" 
	// 	["descricao"]=> string(17) "Camisa da empresa" 
	// 	[4]=> string(1) "5" 
	// 	["id_empresa"]=> string(1) "5" 
	// 	[5]=> string(1) "0" 
	// 	["epi"]=> string(1) "0" 
	// 	[6]=> string(2) "13" 
	// 	[7]=> string(2) "18" 
	// 	["id_func"]=> string(2) "18" 
	// 	[8]=> string(1) "6" 
	// 	["id_epi"]=> string(1) "6" 
	// 	[9]=> string(10) "2015-08-07" 
	// 	["data_entrega"]=> string(10) "2015-08-07" 
	// 	[10]=> string(1) "3" 
	// 	["quantidade"]=> string(1) "3" 
	// }
	
	public function get_func_by_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$return = array();
		$aux=0;
		$query = "SELECT * FROM funcionario WHERE nome LIKE '%%%s%%' && oculto = 0 && id_empresa = '".$_SESSION['id_empresa']."'";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$aux++;
		}
		if($aux == 0){
			echo '<div class="msg">Nenhum funcionário encontrado!</div>';
		}else{
			return $return;
		}

	}
	public function ocultar(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE funcionario SET oculto = 1 WHERE id = %s";
		$result = $g->tratar_query($query, $this->id);
		if($result){
			echo '<div class="msg">Funcionário excluido com sucesso!</div>';
		}
	}

	public function ocultar_by_id($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE funcionario SET oculto = 1 WHERE id = %s";
		$result = $g->tratar_query($query, $id);
		if($result){
			echo '<div class="msg">Funcionário excluido com sucesso!</div>';
		}
	}

// $data_em_rg , $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis




	public function atualiza_func($id, $nome, $cpf, $data_nasc, $id_endereco, $telefone, $email, $senha, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $rg, $data_em_rg, $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		
		
		$temp = Funcionario::get_func_id($id);
		$cont = 0; //conta se algum dado importante foi alterado
		foreach ($temp as $key => $value) {
			if($key == 'data_nasc' && $temp->$key != $data_nasc){// verifica se data_nascimento foi alterado
				$cont++;
			}else if($key == 'id_empresa' && $temp->$key != $id_empresa){// verifica se empresa foi alterada
				$cont++;
			}else if($key == 'id_turno' && $temp->$key != $id_turno){// verifica se turno foi alterado
				$cont++;
			}else if($key == 'id_cbo' && $temp->$key != $id_cbo){// verifica se turno foi alterado
				$cont++;
			}else if($key == 'is_admin' && $temp->$key != $is_admin){// verifica se turno foi alterado
				$cont++;
			}else if($key == 'salario_base' && $temp->$key != $salario_base){// verifica se turno foi alterado
				$cont++;
			}else if($key == 'qtd_horas_sem' && $temp->$key != $qtd_horas_sem){// verifica se turno foi alterado
				$cont++;
			}
		}
		if($cont > 0){//se cont > 0 um dos dados importantes foi alterado e necessita gerar histórico
			
			//se foi alterado algo importante tem que adicionar um novo registro com as alterações e manter o outro
			// Funcionario::add_func($id, $nome, $cpf, $data_nasc, $id_endereco, $telefone, $email, $senha, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $rg, $data_em_rg, $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor);

		}else{

			$aux=0;
			
			$query = "UPDATE funcionario SET nome='%s', cpf='%s', data_nasc='%s', id_endereco = '%s', telefone = '%s', email = '%s', id_empresa = '%s', id_empresa_filial = '%s', id_turno = '%s', id_cbo = '%s', is_admin = '%s', rg = '%s', data_em_rg = '%s' , org_em_rg = '%s', num_tit_eleitor = '%s', email_empresa = '%s', data_adm = '%s', salario_base = '%s', qtd_horas_sem = '%s', num_cart_trab = '%s', num_serie_cart_trab = '%s', id_uf_cart_trab = '%s', num_pis = '%s', id_supervisor = '%s'";
											     // $nome,    $cpf,       $data_nasc,       $telefone,      $email,       $id_empresa_filial,        $id_turno,    $id_cbo,        $is_admin,        $data_em_rg ,     $org_em_rg,          $num_tit_eleitor,    $email_empresa,       $data_adm,        $salario_base,     $qtd_horas_sem,       $num_cart_trab,       $num_serie_cart_trab,        $uf_cart_trab,   $num_pis, $id

			if($senha != ""){
				$query .= ", senha = '%s' ";
				$aux++;
			}

			$query .= "WHERE id = '%s' and oculto = 0";
			// printf($query, $nome, $cpf, $data_nasc, $telefone, $email, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $id);
			if($aux == 0){
				$query_tra = $g->tratar_query($query, $nome, $cpf, $data_nasc, $id_endereco, $telefone, $email, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $rg, $data_em_rg , $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor,          $id);
			}else{
				$query_tra = $g->tratar_query($query, $nome, $cpf, $data_nasc, $id_endereco, $telefone, $email, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $rg, $data_em_rg , $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor,         $senha, $id);
			}

			return $query_tra;
		}
	}

	public function get_all_func_emp($id_empresa){
		$sql = new Sql();
		$sql->conn_bd();
		$aux=0;
		$query = mysql_query("SELECT * FROM funcionario WHERE oculto = 0 $$ id_empresa='%s'");

		while($result = mysql_fetch_array($query)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$aux++;
		}
		return $return;
	}

	public function get_nome_by_id($id){
		$sql = new Sql();
		$sql->conn_bd();
		$aux = 0;
		$query = "SELECT nome FROM funcionario WHERE id = ".$id;

		$result= mysql_query($query);

		if(@mysql_num_rows($result) == 0){
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$return = $row['nome'];
	     }
		return $return;

	}
	public function printFunc(){
        $empresa = new Empresa();
        $empresa = $empresa->get_empresa_by_id($this->id_empresa);
		$filial = new Filial();
        $filial = $filial->get_filial_id($this->id_empresa_filial);
        $cbo = new Cbo();
        $cbo = $cbo->get_cbo_by_id($this->id_cbo);
        $turno = new Turno();
        $turno = $turno->getTurnoById($this->id_turno);
        $u = new Epi();
		$epi_func = $u->get_epi_func($this->id);

        $texto = "";
		$texto .= "<table class='table_pesquisa'><tr>";
		$texto .= "<td colspan='2'><b><span>ID: <span></b></td><td colspan='2'><span><span>".$this->id."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Nome: <span></b></td><td colspan='2'><span>".$this->nome."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Telefone: <span></b></td><td colspan='2'><span>".$this->telefone."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>CPF: <span></b></td><td colspan='2'><span>".$this->cpf."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Data de Nascimento: <span></b></td><td colspan='2'><span>".$this->data_nasc."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Email:<span> </b></td><td colspan='2'><span>".$this->email."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Empresa: <span></b></td><td colspan='2'><span>".$empresa->nome_fantasia."</span></td>";
		$texto .= "</tr>";
		if($filial->id){
			$texto .= "<tr>";
			$texto .= "<td colspan='2'><b><span>Filial: <span></b></td><td colspan='2'><span>".$filial->nome."</span></td>";
			$texto .= "</tr>";
		}
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>CBO: <span></b></td><td colspan='2'><span>".$cbo->descricao."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td colspan='2'><b><span>Turno: <span></b></td><td colspan='2'><span>".$turno->nome." - ". $turno->desc."</span></td>";
		$texto .= "</tr>";
		if(count($epi_func)>0){
			$texto .= '<tr> <td colspan="4"><span><b>Equipamentos do funcionário:</b></span></td></tr>';
			$texto .= '<tr> <td><span>ID</span></td> <td><span>Nome</span></td> <td><span>Data da entrega</span></td><td><span>Quantidade</span></td></tr>';
                      foreach ($epi_func as $key => $value) {
                       $texto .= '<tr><td><span>'.$epi_func[$key]->id.'</span></td><td><span>'.$epi_func[$key]->nome_epi.'</span></td><td><span>'.$epi_func[$key]->data_entrega.'</span></td><td><span>'.$epi_func[$key]->quantidade.'</span></td></tr>';
                      } 
		}
		$texto .= "</table>";
		return $texto;
	}
	
}

 ?>