<?php 
	
class Obra_maquinarios{
	public $id;
	public $id_obra;
	public $id_maquinario;

	public function add_maquinario($id_obra, $id_maquinario){
		
		
		$obra_maquinarios = new Obra_maquinarios();
		$obra_maquinarios->id_obra = $id_obra;
		$obra_maquinarios->id_maquinario = $id_maquinario;
		
		return $obra_maquinarios;

		
	}

	public function add_maquinario_bd(){

		$query = "INSERT INTO obra_maquinarios ";
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