<?php 
include_once("class_sql.php");
require_once(dirname(__FILE__) . "/../global.php");

class EpiXFunc{

	public $id;
	public $id_func;
	public $id_epi;
	public $data_entrega;
	public $quantidade;
	
	public function add_epi_x_func($array_id_epi, $id_func, $data_entrega, $quantidade){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		if($array_id_epi !=0){

		$query = "INSERT INTO funcionario_epi(id_epi, id_func, data_entrega, quantidade) VALUES ('%s','%s', '%s', '%s')";
		for ($i=0; $i < count($array_id_epi) ; $i++) { 
			$g->tratar_query($query, $array_id_epi[$i], $id_func, $data_entrega, $quantidade);	
		}
		}else{
			echo "<div class='msg'>teste</div>";
		}
	}
	public function atualiza_epi_x_func($id_funcionario, $array_id_epi, $data_entrega, $quantidade){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		
		mysql_query("DELETE FROM funcionario_epi WHERE id_epi = ".$id_epi);
	
		$this->add_funcionario_epi($array_id_epi, $id_cbo, $data_entrega, $quantidade);
	}

	
}


?>