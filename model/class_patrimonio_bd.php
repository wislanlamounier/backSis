<?php
require_once("../global.php");
include_once("../model/class_sql.php");
include_once("../model/class_empresa_bd.php");
include_once("../model/class_cliente.php");
include_once("../model/class_grupo_bd.php");
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
	public function get_all_patrimonio($modelo){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        $aux=0;
        $return = array();
        $query = "SELECT id, modelo, fabricante  FROM maquinario as e where e.modelo like '%%%s%%' union SELECT id, modelo, id_marca FROM veiculo as f where f.modelo like '%%%s%%'";
        $query = $g->tratar_query($query, $modelo, $modelo);
        $result = mysql_fetch_array($query);
        
        if(!$query){
        	echo "<div class='msg'>Patrimonio não encontrado !</div>";
        	return;
        }

        while($result = mysql_fetch_array($query)){
        		
	          $return[$aux][0] = $result['id'];
	          $return[$aux][1] = $result['modelo'];
	          $return[$aux][2] = $result['fabricante'];

	          $aux++;
        }
       
        return $return;
        
    }
    public function get_name_patrimonio_id($id){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        $aux=0;
        $return = array();
        $query = "SELECT id, modelo, fabricante, tipo  FROM maquinario as e where e.id = %d union SELECT id, modelo, id_marca, tipo FROM veiculo as f where f.id = %d";
        $query_tra = $g->tratar_query($query, $id, $id);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['modelo'];
			$return[$aux][2] = $result['tipo'];
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
		

		
		  $veiculo = new Veiculo();
		  $veiculo = $veiculo->get_empresa_by_id($this->id_empresa);	  
		  
		  

		$texto ="";
		$texto .= "<table class='table_pesquisa'><tr>";
		$texto .= "<tr>";
		$texto .= "<td><span><b>ID: </b></span></td><td><span>".$this->id."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><span><b>Grupo: </b></span></td><td><span>".$grupo->nome."</span></td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><span><b>Empresa: </b></span></td><td><span>".$empresa->nome_fantasia."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><span><b>Nome: </b></span></td><td><span>".$this->nome."</span></td>";
		$texto .= "</tr>";		
		$texto .= "<tr>";
		$texto .= "<td><span><b>Descricao: </b></span></td><td><span>".$this->descricao."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><span><b>Valor Compra: </b></span></td><td><span>".$this->valor_compra."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><span><b>Valor Hora: </b></span></td><td><span>".$custo->valor_hora."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><span><b>Forncedor: </b></span></td><td><span>".$cliente->nome_fornecedor."</span></td>";
		$texto .= "</tr>";
		$texto .= "<tr>";
		$texto .= "<td><span><b>Responsável: </b></span></td><td><span>".$funcionario->nome."</span></td>";
		$texto .= "</tr>";		
									
		$texto .= "</table>";
	
 		return $texto;
	 }

}

	
	
 ?>