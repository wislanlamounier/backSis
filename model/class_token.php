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

	public function verifica_email($email){
		$sql = new Sql();
		$sql->conn_bd();

		$sqlFun = "SELECT count(id) as cont FROM funcionario WHERE email = '".$email."' && oculto = 0";

		$resultFun = mysql_query($sqlFun);

		$rowFun = mysql_fetch_array($resultFun);

		if($rowFun['cont'] == 0){
			return false;
		}else{
			return true;
		}
	}

	public function verificaToken($token){
		$sql = new Sql();
		$sql->conn_bd();

		$sqlFun = "SELECT count(id) as cont FROM funcionario WHERE md5(concat_ws('',email, CURRENT_DATE)) = '".$token."' && oculto = 0";

		$resultFun = mysql_query($sqlFun);

		$rowFun = mysql_fetch_array($resultFun);

		if($rowFun['cont'] == 0){
			return false;
		}

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