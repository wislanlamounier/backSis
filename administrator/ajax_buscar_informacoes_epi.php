<?php

include_once("../model/class_sql.php");
include_once("../model/class_epi_bd.php");

	$sql = new Sql();
	$sql->conn_bd();

	$nome_epi = $_GET['nome_epi'];  //codigo do estado passado por parametro
	
	$sql = "SELECT * FROM epi WHERE nome_epi LIKE '%$nome_epi%' ORDER BY id";  //consulta todas as cidades que possuem o codigo do estado
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	//monto um array de cidades
	if($num == 0){
		echo "<div class='msg' style='margin-top: 20px;'>Nenhum Registro encontrado!</div>";
		return;
	}
	for ($i = 0; $i < $num; $i++) {
	  $dados = mysql_fetch_array($res);
	  $arrEpi[$i][0] = $dados['id'];
	  $arrEpi[$i][1] = $dados['nome_epi'];
	}
?>

<div class="formulario" style="width:450px">
	<div class="msg" style="float:left">
		<div style="float:left; background-color:rgba(50,200,50,0.3); width:100%; height:43px; text-align:left; margin-top:-20px;">
			<div style="float:left; margin-left:5px;"><img src="../images/search-icon.png" style="width:40px;"></div>
			<div style="float:left; margin-left:5px; margin-top:10px; font-size:18px; color:#333;">Funcionários</div>
		</div>
		<table style="float:left" class="table-pesquisa">
		  <?php
		  	$cont=0;
		  	if($dados) 
			    foreach($arrEpi as $value => $nome){
			      echo "<tr><td style='padding-left:20px;'><a href='add_epi.php?tipo=editar&id=".$arrEpi[$value][0]."'>".$arrEpi[$value][1]."</a></td></tr>";
			     	$cont++;
			  	}
			  	// echo '<tr><td style="padding:0;"><hr style="background-color:#eee;"/></td></tr>';
			  	echo '<tr><td style="padding-left:20px; font-size: 12px; color:#777;">'.$cont. " registro(s) encontrado(s)</td></tr>";
		   ?>
		  
		</table>
	</div>
</div>