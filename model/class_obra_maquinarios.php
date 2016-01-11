<?php 

class Obra_maquinarios{
	public $id;
	public $id_obra;
	public $id_maquinarios;

	public function add_maquinarios_obra(){
		$lista = array();
		foreach ($_SESSION['obra']['patrimonios'] as $key => $value) {
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
}

 ?>