<?php
include_once("../model/class_sql.php");

	$sql = new Sql();
	$sql->conn_bd();

	$estado = $_GET['estado'];  //codigo do estado passado por parametro

	$sql = "SELECT * FROM cidade WHERE estado = $estado ORDER BY id";  //consulta todas as cidades que possuem o codigo do estado
	$res = mysql_query($sql);
	$num = mysql_num_rows($res);
	//monto um array de cidades
	for ($i = 0; $i < $num; $i++) {
	  $dados = mysql_fetch_array($res);
	  $arrCidades[$dados['id']] = $dados['nome'];
	}
?>


<select name="cidade" id="cidade">
  <?php
  	if($dados) 
	    foreach($arrCidades as $value => $nome){
	      echo "<option value='{$value}'>{$nome}</option>";
	     // echo "<option>teste</option>";
	  	}
	else
		echo "<option>Selecione um Estado</option>";
?>
</select>