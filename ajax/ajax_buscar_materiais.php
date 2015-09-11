<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_material_bd.php");
include_once("../model/class_produto_bd.php");


	$sql = new Sql();
	$sql->conn_bd();

	$nome = $_GET['nome'];  //codigo do estado passado por parametro
	$tipo = $_GET['tipo'];
	if($tipo == 'm')//buscar materiais
		$res = Material::get_material_by_name($nome);
	else if($tipo == 'p')// buscar produtos
		$res = Produto::get_produto_by_name($nome);

	
?>

<?php if($res){ ?>
<select name="clientes" id="clientes" size='10' style="height: 100%; width: 100%" onDblClick="selecionaProduto(this.value)">
  <?php
  	if($res) 
	   for($aux = 0; $aux < count($res); $aux++){
	   		if($tipo == 'm')//exibe materiais
	      		echo "<option value='m:".$res[$aux][0]."'>".$res[$aux][1]."</option>";
	      	else if($tipo == 'p')// exibe produtos
	     		echo "<option value='p:".$res[$aux][0]."'>".$res[$aux][1]."</option>";
	  	}
?>
	
</select>
<?php } ?>