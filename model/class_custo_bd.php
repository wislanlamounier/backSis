<?php

include_once("../model/class_sql.php");
require_once("../global.php");

class Custo{
	public $id;
	public $valor_hora;
	


	public function add_custo($valor_hora)
	{
		$this->id = $id;
		$this->valor_hora = $valor_hora;		
	}

	public function add_custo_bd(){
		$sql = new Sql();
		$sql = conn_bd();
		$g = new Glob();

		$query = "INSERT INTO (valor_hora)
					VALUES('%s')";
		if($g->tratar_query($query, $this->valor_hora)){
			return true;
		}else{
			return false;
		}
	}

}
	
 ?>