<?php 
         
include_once("class_sql.php");
include_once("class_turno_bd.php");
require_once(dirname(__FILE__) . "/../global.php");

class Periodicidade{
	public $id;
	public $periodo;
	
	public function get_name_all_periodo(){
		$sql = new Sql();
		$sql->conn_bd();
		$aux=0;
		$query = mysql_query("SELECT * FROM periodicidade");

		while($result = mysql_fetch_array($query)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['periodo'];
			$aux++;
		}
		return $return;
	}
	
	
}

 ?>