<?php 
include("restrito.php");
include_once("../model/class_sql.php");
include_once("../model/class_cbo_bd.php");
include_once("../model/class_cidade_bd.php");
include_once("../model/class_estado_bd.php");
include_once("../model/class_endereco_bd.php");
include_once("../model/class_cliente.php");
 ?>	

<html>
<head>
	<title>Editar Cliente</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php include("../view/topo.php");  ?>
	<div class="formulario">
		 <h1>Editar Cliente</h1>
		
		<form method="POST" action="edita_cliente.php">
			<table>				
				<td><span>Cliente: <input type="text" id="name_search" name="name_search"></td> <td><input type="submit" value="Buscar"></td>

			</table>
		</form>

		<?php
           if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
              $cli = new Cliente();
              $clis = $cli->get_cli_by_name($_POST['name_search']);
              
              if(count($clis) == 0){
                echo '<div class="msg">Nenhum registro encontrado!</div>';
              }
                echo '<table class="exibe_func">';
                foreach($clis as $key => $cli){
                   echo '<tr>
                            <td><a href="edita_cliente.php?verificador=1&id='.$clis[$key][0].'">'.$clis[$key][0]." ".$clis[$key][1].'</a></td></tr>';
                }
                echo '</table>';
           }
                     
        ?>
	</div>


</body>
</html>