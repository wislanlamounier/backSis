<?php
include_once("../model/class_sql.php");

	$sql = new Sql();
	$sql->conn_bd();

	$nome = $_GET['nome'];  //codigo do estado passado por parametro

	$sql = "SELECT * FROM clientes WHERE nome_razao_soc LIKE '%".$nome."%' && oculto = 0 ORDER BY nome_razao_soc ASC";  //consulta todas as cidades que possuem o codigo do estado
	$res = mysql_query($sql);
	
	if($res)
		$num = mysql_num_rows($res);
	else
		$num = 0;
	//monto um array de cidades
	for ($i = 0; $i < $num; $i++) {
		// echo '<script>alert("achou")<script>';
	    $dados = mysql_fetch_array($res);
	    $arrClientes[$dados['id']] = $dados['nome_razao_soc'];
	}
?>


<select name="clientes" id="clientes" size='10' style="height: 100%; width: 100%" onchange="selecionaCliente(this.value)">
  <?php
  	if($dados) 
	    foreach($arrClientes as $value => $nome){
	      echo "<option value='{$value}'>{$nome}</option>";
	     // echo "<option>teste</option>";
	  	}
	
?>
	
</select>