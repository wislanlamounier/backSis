<?php 
header('Content-Type: text/html; charset=utf-8');

class Sql{
	public function conn_bd(){
		$conn = mysql_connect("localhost","root","j3540771") or print(mysql_error());
		mysql_select_db("bd_viacampus");
		mysql_query("SET NAMES 'utf8'");
		mysql_query('SET character_set_connection=utf8');
		mysql_query('SET character_set_client=utf8');
		mysql_query('SET character_set_results=utf8');
		return $conn;
	}
	public function close_conn($conn){
		mysql_close($conn) or print(mysql_error());
	}
}
?>