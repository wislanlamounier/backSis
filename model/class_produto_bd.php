<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Produto{

	public $id;
	public $nome;
	public $id_empresa;
	public $altura;
	public $largura;
	public $comprimento;


	public function add_produtos($nome, $id_empresa, $altura, $largura, $comprimento)
	{		
		$this->nome = $nome;
		$this->id_empresa = $id_empresa;
		$this->altura = $altura;
		$this->largura = $largura;
		$this->comprimento = $comprimento;
	}

	public function add_produto_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO produtos (nome, id_empresa, altura, largura, comprimento) VALUES ('%s','%s','%s','%s','%s')";

		$result = $g->tratar_query($query, $this->nome, $this->id_empresa, $this->altura, $this->largura, $this->comprimento); //inserindo no banco de dados
		
		$query = "SELECT * FROM produtos order by id desc";
		$result = $g->tratar_query($query); //pegando id da ultima insersão
		 
		 if(@mysql_num_rows($result) == 0){
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$id = $row['id'];
	     	return $id;
	     }
	}
	public function atualiza_produto($nome, $id_produto){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE produtos SET nome = '%s' WHERE id = '%s'";

		$result = $g->tratar_query($query, $nome, $id_produto); //inserindo no banco de dados

	}
	public function get_produto_by_name($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM produtos WHERE id_empresa=".$_SESSION['id_empresa']." && nome LIKE '%%%s%%' ";
		$query_tra = $g->tratar_query($query, $name);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['nome'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			echo '<div class="msg">Nenhum produto encontrado!</div>';
		}else{
			$sql->close_conn();
			return $return;
		}
	}
	public function get_produto_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM produtos WHERE id = '%s' && id_empresa=".$_SESSION['id_empresa'];
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            return false;            
	     }else{

	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$produto = new Produto();
	     	$produto->id = $row['id'];
	     	$produto->nome = $row['nome'];
            $produto->id_empresa = $row['id_empresa'];

	     	return $produto;
	     }

	}
	public function get_materiais_produto($id_produto){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM produto_materiais WHERE id_produto = '%s'";
		$query_tra = $g->tratar_query($query, $id_produto);

		while($result =  mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id_produto'];
			$return[$aux][1] = $result['id_material'];
			$return[$aux][2] = $result['quantidade'];
                        $return[$aux][3] = $result['id'];
			$aux++;
		}
		if($aux == 0){
			$sql->close_conn();
			return false;
		}else{
			$sql->close_conn();
			return $return;
		}
	}
	

}
 ?>