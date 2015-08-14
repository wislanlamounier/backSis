<?php

include_once("../model/class_sql.php");
require_once("../global.php");
include_once("../model/class_empresa_bd.php");
include_once("../model/class_cliente.php");
include_once("../model/class_grupo_bd.php");
include_once("../model/class_custo_bd.php");
include_once("../model/class_funcionario_bd.php");

class Patrimonio{
	public $id;
	public $id_custo;
	public $id_grupo;		
	public $id_responsavel;
	public $id_fornecedor;
	public $id_empresa;	
	public $valor_compra;
	public $nome;
	public $descricao;

	public function add_patrimonio($id_custo, $id_grupo, $id_responsavel, $id_fornecedor, $id_empresa, $valor_compra, $nome, $descricao){
		
		$this->id_custo = $id_custo;
		$this->id_grupo = $id_grupo;		
		$this->id_responsavel = $id_responsavel;
		$this->id_fornecedor = $id_fornecedor;
		$this->id_empresa = $id_empresa;		
		$this->valor_compra = $valor_compra;
		$this->nome = $nome;
		$this->descricao = $descricao;
	}
	
	public function add_patrimonio_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "INSERT INTO patrimonio (id_custo, id_grupo, id_responsavel, id_fornecedor, id_empresa, valor_compra, nome, descricao)
									VALUES ( '%s',		'%s',	'%s',			'%s',			'%s',		'%s',	    '%s',	    '%s' )";

		if($g->tratar_query($query, $this->id_custo, $this->id_grupo, $this->id_responsavel, $this->id_fornecedor, $this->id_empresa, $this->valor_compra, $this->nome, $this->descricao)){
		return true; 
		}else{
		return false;
		} 
	}
	public function get_patrimonio_by_nome($nome){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        $aux=0;
        $return = array();
        $query = $g->tratar_query("SELECT * FROM patrimonio WHERE oculto = 0 && nome LIKE '%%%s%%'",$nome);

        while($result = mysql_fetch_array($query)){
          $return[$aux][0] = $result['id'];
          $return[$aux][1] = $result['nome'];
          $return[$aux][2] = $result['valor_compra'];

          $aux++;
        }
        if($aux == 0){
          echo "<div class='msg'>Patrimonio não encontrado !</div>";
        }else{
        return $return;
        }
    }
    public function get_patrimonio_nome($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM patrimonio WHERE nome LIKE '%%%s%%' &&  oculto = 0";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$return[$aux][2] = $result['id_fornecedor'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum patrimonio encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}
    public function get_patrimonio_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM patrimonio WHERE id = '%s' && oculto =0";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            echo 'Nenhum grupo encontrado';
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->descricao = $row['descricao'];
	     	$this->id_grupo = $row['id_grupo'];
	     	$this->id_custo = $row['id_custo'];
	     	$this->id_fornecedor = $row['id_fornecedor'];
	     	$this->id_empresa = $row['id_empresa'];
	     	$this->nome = $row['nome'];
	     	$this->id_responsavel = $row['id_responsavel'];
	     	$this->valor_compra = $row['valor_compra'];
	     	
	     	return $this;
	     }
	}	

	public function atualiza_patrimonio($nome, $descricao, $id_grupo, $id_fornecedor, $id_responsavel, $id_empresa, $id_custo, $valor_compra, $id){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE patrimonio SET nome='%s', descricao='%s', id_grupo='%s', id_fornecedor='%s', id_responsavel='%s', id_empresa='%s', id_custo='%s', valor_compra='%s' WHERE id ='%s' ";

		$query_tra = $g->tratar_query($query, $nome, $descricao, $id_grupo, $id_fornecedor, $id_responsavel, $id_empresa, $id_custo, $valor_compra, $id);
		
		if($query_tra){
			return $query_tra;
		}else{
			return false;
		}
		
	}
	public function ocultar_by_id($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE patrimonio SET oculto = 1 WHERE id = %s";
		$result = $g->tratar_query($query, $id);
		if($result){
			echo '<div class="msg">Patrimonio excluido com sucesso!</div>';
		}
	}
	public function printPatrimonio(){
		

		
		  $empresa = new Empresa();
		  $empresa = $empresa->get_empresa_by_id($this->id_empresa);	  
		  $cliente = new Cliente();
		  $cliente = $cliente->get_cli_by_id($this->id_fornecedor);
		  $funcionario = new Funcionario();
		  $funcionario = $funcionario->get_func_id($this->id_responsavel);

		  $grupo   = new Grupo();
		  $grupo   = $grupo->get_grupo_id($this->id_grupo);
		  $custo   = new Custo();
		  $custo   = $custo->get_valor_id($this->id_custo);		  
		  

		$texto ="";
		$texto .= "<table class='table_pesquisa'><tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>ID: </b></td><td>".$this->id."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Grupo: </b></td><td>".$grupo->nome."</td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><b>Empresa: </b></td><td>".$empresa->nome_fantasia."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Nome: </b></td><td>".$this->nome."</td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><b>Descricao: </b></td><td>".$this->descricao."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Valor Compra: </b></td><td>".$this->valor_compra."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Valor Hora: </b></td><td>".$custo->valor_hora."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Forncedor: </b></td><td>".$cliente->nome_fornecedor."</td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><b>Responsável: </b></td><td>".$funcionario->nome."</td>";
		$texto .= "</tr>";		
									
		$texto .= "</table>";
	
 		return $texto;
	 }

}

	
	
 ?>