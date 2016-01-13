<?php 

class Obra_produtos{
	public $id;
	public $id_obra;
	public $id_produto;
	public $quantidade_produto;
	public $data_inicio_previsto;
	public $data_inicio_realizado;
	public $data_fim_previsto;
	public $data_fim_realizado;

	public function add_obra_produtos($id_obra){
		$lista = array();
		foreach ($_SESSION['obra']['produto'] as $key => $value) {
			//o value possui id:quantidade concatenados
			$obra_produtos = new Obra_produtos();
			$id_quant = explode(":", $value);
			$obra_produtos->id_obra = $id_obra;
			$obra_produtos->id_produto = $id_quant[0];
			$obra_produtos->quantidade_produto = $id_quant[1];
			$lista[] = $obra_produtos;
		}
		return $lista;
	}
	public function add_obra_produtos_bd(){
		$query = "INSERT INTO obra_produtos ";
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