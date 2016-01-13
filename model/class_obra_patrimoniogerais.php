<?php 
	
class Obra_patrimoniogerais{
	public $id;
	public $id_obra;
	public $id_patrimonioGeral;

	public function add_patrimoniogeral($id_obra, $id_patrimonio){
		
		$obra_patrimoniogerais = new Obra_patrimoniogerais();
		$obra_patrimoniogerais->id_obra = $id_obra;
		$obra_patrimoniogerais->id_patrimonioGeral = $id_patrimonio;
		
		return $obra_patrimoniogerais;

	}

	public function add_patrimoniogeral_bd(){
		
		$query = "INSERT INTO obra_patrimoniogerais ";
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