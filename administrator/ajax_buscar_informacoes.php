<?php

include_once("../model/class_sql.php");
include_once("../model/class_funcionario_bd.php");

	$sql = new Sql();
	$sql->conn_bd();

	$id = $_GET['id_funcionario'];  //codigo do estado passado por parametro

	$sql = "SELECT * FROM funcionario WHERE id = $id ORDER BY id";  //consulta todas as cidades que possuem o codigo do estado
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	//monto um array de cidades
	for ($i = 0; $i < $num; $i++) {
	  $dados = mysql_fetch_array($res);
	  $arrFuncionario[$dados['id']] = $dados['nome'];
	}
?>


<table>
  <?php
  	if($dados) 
	    foreach($arrFuncionario as $value => $nome){
	      echo "<tr><td>{$nome}</td></tr>";
	     // echo "<option>teste</option>";
	  	}
	
?>
</table>