<?php
session_start();
include_once("../model/class_empresa_bd.php");

	$nome = $_GET['nome'];  //codigo do estado passado por parametro

	$empresa = new Empresa();
	$empresa = $empresa->get_empresa_by_nome_fantasia($nome);

	if(count($empresa) == 0){
		return;
	}
	for ($i = 0; $i < count($empresa); $i++) {
	  $arrEmpresa[$i][0] = $empresa[$i][0];
	  $arrEmpresa[$i][1] = $empresa[$i][1];
	  $arrEmpresa[$i][2] = $empresa[$i][2];
	}
?>

<?php if(isset($_GET['param']) && $_GET['param'] == 0){ // EDITAR FUNCIONARIO?>

<div class="formulario" style="width:450px">
	<div class="msg" style="float:left">
		<div style="float:left; background-color:rgba(50,200,50,0.3); width:100%; height:43px; text-align:left; margin-top:-20px;">
			<div style="float:left; margin-left:5px;"><img src="../images/search-icon.png" style="width:40px;"></div>
			<div style="float:left; margin-left:5px; margin-top:10px; font-size:18px; color:#333;">Empresa</div>
		</div>
		<table style="float:left" class="table-pesquisa">
		  <?php
		  	$cont=0;
		  	if($empresa) 
			    foreach($arrEmpresa as $value => $nome){
			      echo "<tr><td style='padding-left:20px;'><a href='add_empresa.php?tipo=editar&id=".$arrEmpresa[$value][0]."'>".$arrEmpresa[$value][2]."</a></td></tr>";
			     	$cont++;
			  	}
			  	echo '<tr><td style="padding-left:20px; font-size: 12px; color:#777;">'.$cont. " registro(s) encontrado(s)</td></tr>";
		   ?>
		  
		</table>
	</div>
</div>
<?php } else if (isset($_GET['param']) && $_GET['param'] == 1){ // EXCLUIR FUNCIONARIO?>
<div class="formulario" style="width:450px">
	<div class="msg" style="float:left">
		<div style="float:left; background-color:rgba(200,50,50,0.3); width:100%; height:43px; text-align:left; margin-top:-20px;">
			<div style="float:left; margin-left:5px;"><img src="../images/delete.png" style="width:35px; margin-top:3px;"></div>
			<div style="float:left; margin-left:5px; margin-top:10px; font-size:18px; color:#333;">Excluir Empresa <span>(Clique em um registro para excluir)</span></div>
		</div>
		<table style="float:left" class="table-pesquisa">
		  <?php
		  	$cont=0;
		  	if($empresa) 
			    foreach($arrEmpresa as $value => $nome){
			      echo "<tr><td style='padding-left:20px;'><a class='icon_excluir' title='Clique para excluir' onclick='confirma(".'"'.$arrEmpresa[$value][0].'"'.",".'"'.$arrEmpresa[$value][2].'"'.")'>".$arrEmpresa[$value][2]."</a></td></tr>";
			     	$cont++;
			  	}
			  	echo '<tr><td style="padding-left:20px; font-size: 12px; color:#777;">'.$cont. " registro(s) encontrado(s)</td></tr>";
		   ?>
		  
		</table>
	</div>
</div>


<?php } ?>