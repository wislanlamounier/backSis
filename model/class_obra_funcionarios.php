<?php 
include_once("class_funcionario_bd.php");

class Obra_funcionario{
	public $id;
	public $id_obra;
	public $id_funcionario;

	public function add_funcionarios_obra($id_obra){
		$list = array();
		foreach ($_SESSION['obra']['funcionario'] as $key => $value) {
			$obra_funcionario = new Obra_funcionario();
			$obra_funcionario->id_obra = $id_obra;
			$obra_funcionario->id_funcionario = $value;
			$list[] = $obra_funcionario;

		}
		return $list;
	}

	public function add_funcionarios_bd(){

		$query = "INSERT INTO obra_funcionarios ";
 		$campos = '(';
 		foreach ($this as $key => $value) {
 			if(!empty($value))
 				$campos .= "$key, ";
 		}
 		$campos = substr($campos, 0 ,-2);
 		$campos .= ')';
		$valores = ' VALUES (';
 		
 		foreach ($this as $key => $value) {
 			$replace = array("'",'*','==', '<', '>', '||','/','\\');
 			$value = str_replace($replace, '', $value);
 			if(!empty($value)){
 				$valores .= "'$value', ";
 			}
 		}
 		$valores = substr($valores, 0 ,-2);
 		$valores .= ') ';
		
		$sql = new Sql();
		$sql->conn_bd();
		
 		if(mysql_query($query.$campos.$valores) or print (mysql_error()))
 			return true;

 		return false;

	}

}

?>