<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");

	$sql = new Sql();
	$sql->conn_bd();

	$nome = $_GET['nome'];  //codigo do estado passado por parametro
	$tipo = $_GET['tipo'];
	
	if($tipo == 0)//patrimonio geral
		$res = Patrimonio_geral::get_patrimonio_geral_nome($nome);
	else if($tipo == 1)//maquinario
		$res = Maquinario::get_maquinario_modelo($nome);
	else//$tipo == 2: veiculos
		$res = Veiculo::get_veiculo_nome($nome);
?>


<select name="clientes" id="clientes" size='10' style="height: 100%; width: 100%" onDblClick="selecionaPatrimonio(this.value)">
  <?php
  	if($res) 
	   for($aux = 0; $aux < count($res); $aux++){
	      echo "<option value='".$res[$aux][0]."'>".$res[$aux][2]."</option>";
	     // echo "<option>teste</option>";
	  	}
	
?>
	
</select>