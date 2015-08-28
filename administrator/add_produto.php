<?php
include("restrito.php"); 
include("../model/class_unidade_medida_bd.php");
include("../model/class_material_bd.php");
 ?>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style1.css">
<script type="text/javascript">
function carregaUnidadeMedida(medida){
      
      var combo = document.getElementById("medida");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == medida)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
</script>
</head>

<body>			
	
			<?php include_once("../view/topo.php"); ?>
			<div>
				<div class="formulario">
					
						<div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">PRODUDTO</span></div></div>
						
						<div style="margin-top:80px;"><div style="float:left"><span>Nome</span> </div><div><span>Receita</span></div></div>
						<br><br>
						<div><div style="float:left"><input type="text" name="produto" id="produto"></div><div style="float:left; padding-left:20px;" ><span>Incluir</span></div><div style="float:left; padding-left:20px;"><span>Insumo</span></div><div style="float:left; padding-left:20px;"><span>Quantidade</span></div></div>

						<?php
							$materiais = new Material();
							$medida = new Unidade_medida();
							$materiais = $materiais->get_all_material();
							

							 for ($i=0; $i < count($materiais); $i++) { ?>							
							<?php  
							    $id_unidade_medida = $materiais[$i][2];
								$nome_material = $materiais[$i][1];
								$id = $materiais[$i][0];
								$medida = $medida->get_unidade_medida_by_id($id_unidade_medida);
								
							?>
							<br>
							<div class="resultados" id="resultados" style="margin-left:200px;"><div style="float:left; padding-left:20px;" ><input type="checkbox"></div><div style="float:left; padding-left:20px;"><span><?php echo $nome_material; ?></span></div><div style="float:left; padding-left:20px;"><input type="text" style="width:30px;"><?php echo $medida->sigla; ?></div></div>
							<br>



						<?php } ?>						


					<!-- 	<form> -->
							<!-- <table class="produto_nome" border='0'>
								<tr><td><span>Nome</span></td></tr>
								<tr><td><input type="text"> </td></tr>
							</table> -->
<!-- 
						<div class="produto">
							
							<table class="menu_produto" border='0'>
								
								<tr><td><input type="text" name="nome_produto" id="nome_produto"> </td><td>Incluir</td><td>Insumo</td><td>Quantidade</td>

									
								<?php
									$materiais = new Material();
									$materiais = $materiais->get_all_material();

									 for ($i=0; $i < count($materiais); $i++) { ?>
									
									<?php 
										$id_unidade_medida = $materiais[$i][2];
										$nome_material = $materiais[$i][1];
										$id = $materiais[$i][0];
									?>
									
																	
								<tr><td></td><td><input type="checkbox" name="incluir" id="incluir"></td> 

									<td><input type="text" name="insumo" value="<?php echo $nome_material; ?>" id="insumo" style="width:100%;"></td> 

									<td><input type="number" style="width:40%;"><select id="quantidade" name="quantidade"  style="width:30%">

                               													    <option value="no_sel">.</option>
                               													    <?php 
                               													       $medida = new Unidade_medida();
                               													       $medida = $medida->get_all_unidade_medida();
                               													       for ($i=0; $i < count($medida) ; $i++) { 
                               													          echo '<option value="'.$medida[$i][0].'">'.$medida[$i][2].'</option>';
                               													       }
                               													     ?>
                               													 </select>			
                               													 <?php echo "<script> carregaUnidadeMedida('".$id_unidade_medida."') </script>";  ?>																														
																				
									<?php } ?>						

							</table>

						</form>
					
					</div>
				</div>
			</div>
			 -->
	 
</body>
</html>