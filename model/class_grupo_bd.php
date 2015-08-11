<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Grupo{
	public $id;
	public $nome;
	public $descricao;


	public function add_grupo($id, $nome, $descricao)
	{
		$this->id = $id;
		$this->nome = $nome;
		$this->descricao = $descricao;
	}

	public function add_grupo_bd($nome, $descricao){
		$sql = new Sql();
		$sql = conn_bd();
		$g = new Glob();

		$query = "INSERT INTO (nome, descricao)
					VALUES('%s','%s')";.
		if($g->tratar_query($query, $this->nome, $this->descricao)){
			return true;
		}else{
			return false;
		}
	}

}
 ?>