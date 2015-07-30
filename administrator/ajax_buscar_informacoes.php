<?php

include_once("../model/class_sql.php");
include_once("../model/class_funcionario_bd.php");

	$sql = new Sql();
	$sql->conn_bd();

	$nome = $_GET['nome'];  //codigo do estado passado por parametro

	$sql = "SELECT * FROM funcionario WHERE nome LIKE '%$nome%' && oculto = 0 ORDER BY id";  //consulta todas as cidades que possuem o codigo do estado
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	//monto um array de cidades
	for ($i = 0; $i < $num; $i++) {
	  $dados = mysql_fetch_array($res);
	  $arrFuncionario[$i][0] = $dados['id'];
	  $arrFuncionario[$i][1] = $dados['nome'];
	}
?>

<div class="formulario">
<table>
  <?php
  	if($dados) 
	    foreach($arrFuncionario as $value => $nome){
	      echo "<tr><td><a href='add_func.php?tipo=editar&id=".$arrFuncionario[$value][0]."'>".$arrFuncionario[$value][1]."</a></td></tr>";
	     // echo "<option>teste</option>";
	  	}
	
?>
</table>
</div>