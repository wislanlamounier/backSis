<?php

include_once("../model/class_sql.php");
include_once("../model/class_cliente.php");

	$sql = new Sql();
	$sql->conn_bd();

	$nome = $_GET['nome'];  //codigo do estado passado por parametro
	if(isset($_GET['tipo']) && $_GET['tipo'] == 0){
		$sql = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%$nome%' && tipo = 0 ORDER BY id";  //consulta todas as cidades que possuem o codigo do estado
	}else{
		$sql = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%$nome%' && tipo = 1 ORDER BY id";  //consulta todas as cidades que possuem o codigo do estado
	}
	
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	//monto um array de cidades
	if($num == 0){
		echo "<div class='msg' style='margin-top: 20px;'>Nenhum Registro encontrado!</div>";
		return;
	}
	for ($i = 0; $i < $num; $i++) {
	  $dados = mysql_fetch_array($res);
	  $arrClientes[$i][0] = $dados['id'];
	  $arrClientes[$i][1] = $dados['nome_razao_soc'];
	}
?>

<div class="formulario" style="width:450px">
	<div class="msg" style="float:left">
		<div style="float:left; background-color:rgba(50,200,50,0.3); width:100%; height:43px; text-align:left; margin-top:-20px;">
			<div style="float:left; margin-left:5px;"><img src="../images/search-icon.png" style="width:40px;"></div>
			<div style="float:left; margin-left:5px; margin-top:10px; font-size:18px; color:#333;">Clientes</div>
		</div>
		<table style="float:left" class="table-pesquisa">
		  <?php
		  	$cont=0;
		  	if($dados) 
			    foreach($arrClientes as $value => $nome){
			    	//verifica se é pessoa fisica ou juridica
			      if(isset($_GET['tipo']) && $_GET['tipo'] == 0){
			      		echo "<tr><td style='padding-left:20px;'><a href='add_cliente.php?tipo=editar&id=".$arrClientes[$value][0]."'>".$arrClientes[$value][1]."</a></td></tr>";
			      }else{
			      		echo "<tr><td style='padding-left:20px;'><a href='add_cliente.php?tipo=editarj&id=".$arrClientes[$value][0]."'>".$arrClientes[$value][1]."</a></td></tr>";
			      }
			      $cont++;
			  	}
			  	// echo '<tr><td style="padding:0;"><hr style="background-color:#eee;"/></td></tr>';
			  	echo '<tr><td style="padding-left:20px; font-size: 12px; color:#777;">'.$cont. " registro(s) encontrado(s)</td></tr>";
		   ?>
		  
		</table>
	</div>
</div>