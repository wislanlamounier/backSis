<?php 

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

 	public function add_dados_obra(){
 		$this->nome = $_SESSION['obra']['dados']['nome'];
 		$this->data_inicio_previsto = $_SESSION['obra']['dados']['data_inicio_previsto'];
 		$this->site = $_SESSION['obra']['dados']['site'];
 		$this->latitude = $_SESSION['obra']['dados']['latitude'];
 		$this->longitude = $_SESSION['obra']['dados']['longitude'];
 		$this->descricao = $_SESSION['obra']['dados']['desc'];
 		$this->id_empresa = $_SESSION['id_empresa'];
 		$this->id_cliente = $_SESSION['obra']['cliente']['id_cli'];
 		$this->id_regiao_trabalho = $_SESSION['obra']['dados']['regioes'];
 		$this->id_responsavel_obra = $_SESSION['obra']['dados']['responsavel_obra'];

 	}

 	public function printObra(){
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
}

?>