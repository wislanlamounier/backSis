<?php 
include_once("class_sql.php");

class token{

	public $id;
	public $token;
	public $data;
	public $invalido;

	public function add_token($token, $data, $invalido){
		$this->token = $token;
		$this->data = $data;
		$this->invalido = $invalido;
	}

	public function add_token_bd(){
		$sql = new Sql();
		$sql->conn_bd();

		$sql = "INSERT INTO token (token, data, invalido) VALUES ('".$this->token."','".$this->data."','".$this->invalido."')";

		if(mysql_query($sql)){
			return true;
		}else{
			return false;
		}
	}

	public function verificaToken($token){
		$sql = new Sql();
		$sql->conn_bd();

		$sql = "SELECT count(id) as cont FROM token WHERE token = '".$token."' && invalido = 0";

		$result = mysql_query($sql);

		$row = mysql_fetch_array($result);

		if($row['cont'] > 0){
			return true;
		}else{
			return false;
		}
	}


}

 ?>