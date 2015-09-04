<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_material_bd.php");


	$sql = new Sql();
	$sql->conn_bd();

	$nome = $_GET['nome'];  //codigo do estado passado por parametro
	
	
	
		$res = Material::get_material_by_name($nome);
	
?>


<select name="clientes" id="clientes" size='10' style="height: 100%; width: 100%" onDblClick="selecionaProduto(this.value)">
  <?php
  	if($res) 
	   for($aux = 0; $aux < count($res); $aux++){
	      echo "<option value='".$res[$aux][0]."'>".$res[$aux][1]."</option>";
	     // echo "<option>teste</option>";
	  	}
?>
	
</select>