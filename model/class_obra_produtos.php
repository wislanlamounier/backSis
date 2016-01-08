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

	function add_obra_produtos($id_obra){
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

}
?>