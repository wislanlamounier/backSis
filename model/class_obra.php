<?php 
include_once("class_sql.php");
include_once("class_endereco_bd.php");
class Obra{

	public $nome;
	public $data_inicio_previsto;
	public $id_responsavel_obra;
	public $site;
	public $latitude;
	public $longitude;
	public $descricao;
	public $id_empresa;
	public $id_cliente;
	public $id_endereco;
	public $id_regiao_trabalho;
	public $oculto;
	public $status;

 	public function add_dados_obra(){
 		$this->nome = $_SESSION['obra']['dados']['nome'];
 		$this->data_inicio_previsto = $_SESSION['obra']['dados']['data_inicio_previsto'];
 		$this->site = $_SESSION['obra']['dados']['site'];
 		$this->latitude = $_SESSION['obra']['dados']['latitude'];
 		$this->longitude = $_SESSION['obra']['dados']['longitude'];
 		$this->descricao = $_SESSION['obra']['dados']['desc'];
 		$this->id_empresa = $_SESSION['id_empresa'];
 		$this->id_cliente = ( isset($_SESSION['obra']['cliente']['id_cli']) ) ? $_SESSION['obra']['cliente']['id_cli'] : null;
 		$this->id_regiao_trabalho = $_SESSION['obra']['dados']['regioes'];
 		$this->id_responsavel_obra = $_SESSION['obra']['dados']['responsavel_obra'];
 		$endereco = new Endereco();
 		$endereco->add_endereco($_SESSION['obra']['dados']['rua'],$_SESSION['obra']['dados']['num'], 0, $_SESSION['obra']['dados']['bairro'], 0, 0);
 		$this->id_endereco = $endereco->add_endereco_bd();
 	}

 	public function add_dados_obra_bd(){
 		$query = "INSERT INTO obras ";
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

 		mysql_query($query.$campos.$valores) or print (mysql_error());

 		$result = mysql_query("SELECT id FROM obras ORDER BY id DESC");
 		
 		$row = mysql_fetch_array($result);
 		if(!empty($row['id']))
 			return $row['id'];

 		return null;
 	}

 	public function printObraSession(){
 		echo '<table border="1">';
 		foreach ($_SESSION['obra'] as $key => $value) {
 			echo '<tr><td colspan="2" style="text-align:center"><b>'.$key.'</b></td></tr>';
 			echo '<tr><td><b>key</b></td><td><b>value</b></td></tr>';
 			if(is_array($value)){
 				foreach ($value as $key2 => $value2) {
 					if(is_array($value2)){
 						foreach ($value2 as $key3 => $value3) {
 							if(is_array($value3)){
 								echo "<script>alert('existe mais um array');</script>";
 							}else{
 								echo '<tr><td>'.$key3.'</td><td>'.$value3.'</td></tr>';	
 							}
 						}
 					}else{
 						echo '<tr><td>'.$key2.'</td><td>'.$value2.'</td></tr>';			
 					}
 				}
 			}else{
 				echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';		
 			}
 			
 		}
 		echo '</table>';
 		print_r($_SESSION['obra']);
 	}

 	public function getObraId($id){
 		$sql = new Sql();
 		$sql->conn_bd();

 		$result = mysql_query("SELECT * FROM obras WHERE id = $id && oculto = 0");

 		$row = mysql_fetch_array($result);

 		$obra = new Obra();
		$obra->id = $row['id'];
 		$obra->nome = $row['nome'];
		$obra->data_inicio_previsto = $row['data_inicio_previsto'];
		$obra->id_responsavel_obra = $row['id_responsavel_obra'];
		$obra->site = $row['site'];
		$obra->latitude = $row['latitude'];
		$obra->longitude = $row['longitude'];
		$obra->descricao = $row['descricao'];
		$obra->id_empresa = $row['id_empresa'];
		$obra->id_cliente = $row['id_cliente'];
		$obra->id_endereco = $row['id_endereco'];
		$obra->id_regiao_trabalho = $row['id_regiao_trabalho'];
		$obra->oculto = $row['oculto'];
		$obra->status = $row['status'];

		return $obra;
 	}

 	public function getStatus($tipo){
 		if($tipo == 0){
 			return "Orçamento";
 		}else if($tipo == 1){
 			return "Aprovada";
 		}else if($tipo == 2){
 			return "Cancelada";
 		}else if($tipo == 3){
 			return "Em execução";
 		}else{
 			return "Finalizada";
 		}
 	}

 	public function getObraCompleta($id_obra){
 		$obra = new Obra();

 		$obra = $obra->getObraId($id_obra);

 		return $obra;
 	}
}

?>