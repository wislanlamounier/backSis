<?php

include_once("../model/class_sql.php");
include_once("../model/class_turno_bd.php");

	$sql = new Sql();
	$sql->conn_bd();

	$nome = $_GET['nome'];  //codigo do estado passado por parametro
	
	$sql = "SELECT * FROM turno WHERE nome LIKE '%$nome%' && oculto = 0 ORDER BY id";  //consulta todas as cidades que possuem o codigo do estado
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	//monto um array de cidades
	if($num == 0){
		echo "<div class='msg' style='margin-top: 20px;'>Nenhum Registro encontrado!</div>";
		return;
	}
	for ($i = 0; $i < $num; $i++) {
	  $dados = mysql_fetch_array($res);
	  $arrTurno[$i][0] = $dados['id'];
	  $arrTurno[$i][1] = $dados['nome'];
	}
?>

<div class="formulario" style="width:450px">
	<div class="msg" style="float:left">
		<div style="float:left; background-color:rgba(50,200,50,0.3); width:100%; height:43px; text-align:left; margin-top:-20px;">
			<div style="float:left; margin-left:5px;"><img src="../images/search-icon.png" style="width:40px;"></div>
			<div style="float:left; margin-left:5px; margin-top:10px; font-size:18px; color:#333;">Turno</div>
		</div>
		<table style="float:left" class="table-pesquisa">
		  <?php
		  	$cont=0;
		  	if($dados) 
			    foreach($arrTurno as $value => $nome){
			      echo "<tr><td style='padding-left:20px;'><a href='add_turno.php?tipo=editar&id=".$arrTurno[$value][0]."'>".$arrTurno[$value][1]."</a></td></tr>";
			     	$cont++;
			  	}
			  	// echo '<tr><td style="padding:0;"><hr style="background-color:#eee;"/></td></tr>';
			  	echo '<tr><td style="padding-left:20px; font-size: 12px; color:#777;">'.$cont. " registro(s) encontrado(s)</td></tr>";
		   ?>
		  
		</table>
	</div>
</div>