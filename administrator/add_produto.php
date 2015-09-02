<?php
include("restrito.php"); 
include("../model/class_unidade_medida_bd.php");
include("../model/class_material_bd.php");
include("../model/class_produto_bd.php");
include("../model/class_produto_materiais_bd.php");

function tipo_form($checked, $id_produto, $nome_material, $id_material, $medida_sigla, $quantidade){
	echo '<br>'. $checked;
	echo '<br>'. $id_produto;
	echo '<br>'. $nome_material;
	echo '<br>'. $id_material;
	echo '<br>'. $quantidade; 
	echo $medida_sigla;

	echo '<br>'.$quantidade;

	$produtos_materiais = new ProdutosMateriais();
	$produtos_materiais->add_produtos_materiais($id_produto, $id_material, $quantidade);
	$produtos_materiais->add_produtos_materiais_bd();
}

 ?>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style1.css">
<script type="text/javascript">

function session(r){
alert(r);
var parametros = r.split(':');
var id = "incluir:"+parametros[1];
	document.getElementById(id).checked = true;



}

function validate(f){
        var erros = 0;
        var msg = "";
          for (var i = 0; i < f.length; i++) {
              if(f[i].name == "produto"){
                  if(f[i].value == ""){
                     msg += "Insira codigo no campo produto!\n";
                     f[i].style.border = "1px solid #FF0000";
                     erros++;
                  }else{
                      f[i].style.border = "1px solid #898989";
                  }
              }
   

         }
          if(erros>0){            
              alert(msg);
            return false;
          }
      }

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
						<form>
							 <input type="hidden" id="buscar" name="buscar" value="buscar"> 
						<div style="margin-top:80px; margin-left:150px; float:top; ">Buscar Insumo <input type="text" id="indice" name="indice"> <input type="submit" id="buscar" name="buscar" value="Buscar"></div>
						</form>
						<?php if(isset($_GET['buscar']) !='buscar'){?>
						<div class="cabecalho"><div style="float:left "><span>Nome</span> </div><div><span>Receita</span></div></div>
						<br><br>
						<form form method="POST" id="cadastrar" onsubmit="return validate(this)">
						<div><div style="float:left"><input type="text" name="produto" id="produto"></div><div style="float:left; padding-left:20px;" ><span>INCLUIR</span></div><div style="float:left; padding-left:20px;"><span>INSUMO</span></div><div style="float:left; padding-left:20px;"><span>QUANTIDADE</span></div></div>
						
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
							<div class="resultados" id="resultados" style="margin-left:200px; margin-top:20px;"><div style="float:left; padding-left:20px;" ><input type="checkbox"  id="<?php echo 'incluir:'.$nome_material ?>" name="<?php echo 'incluir'.$nome_material ?>"></div><div style="float:left; padding-left:40px; padding-right:50px; width:30px;"><input readonly style="width:120px; border:0; background-color: rgba(100,100,100,0);" type="text" value="<?php echo $nome_material; ?>" name="<?php echo  'insumo'.$nome_material ?>"></div><div style="float:left; padding-left:40px; padding-right:20px;"><input type="numeric" onchange="session(this.name)" id="<?php echo 'quantidade'.$nome_material?>" name="<?php echo 'quantidade:'.$nome_material?>" style="width:40px;"><input readonly style="width:40px; border:0; background-color: rgba(100,100,100,0);"type="text" name="<?php echo 'medida'.$nome_material?>" id="medida" value="<?php echo $medida->sigla; ?>"></div></div>
							<br>
						
							<?php } ?>
							<input type="hidden" name="cad" id="cad">
							<div> <input type="submit" name="cadastrar" value="Cadastrar"></div>
							</form>
						<?php } ?>	

						<?php if(isset($_GET['buscar']) =='buscar'){?>
						<div class="cabecalho"><div style="float:left "><span>Nome</span> </div><div><span>Receita</span></div></div>
						<br><br>
						<form form method="POST" id="buscar">
						<div><div style="float:left"><input type="text" name="produto" id="produto"></div><div style="float:left; padding-left:20px;" ><span>INCLUIR</span></div><div style="float:left; padding-left:20px;"><span>INSUMO</span></div><div style="float:left; padding-left:20px;"><span>QUANTIDADE</span></div></div>
						
							<?php 
							$indice= $_GET['indice'];	
							$materiais = new Material();
							$medida = new Unidade_medida();
							$materiais = $materiais->get_material_by_name($indice);

									for ($i=0; $i < count($materiais); $i++) { ?>							
										<?php  
										    $id_unidade_medida = $materiais[$i][2];
											$nome_material = $materiais[$i][1];
											$id = $materiais[$i][0];
											$medida = $medida->get_unidade_medida_by_id($id_unidade_medida);
											
										?>
							<br>
							<div class="resultados" id="resultados" style="margin-left:200px; margin-top:20px;"><div style="float:left; padding-left:20px;" ><input type="checkbox" id="incluir" name="<?php echo 'incluir'.$nome_material ?>"></div><div style="float:left; padding-left:40px; padding-right:50px; width:30px;"><input readyonly style="width:120px; border:0; background-color: rgba(100,100,100,0);" type="text" value="<?php echo $nome_material; ?>" name="<?php echo  'insumo'.$nome_material ?>"></div><div style="float:left; padding-left:40px; padding-right:20px;"><input type="text" onchange="session(this.value)" id="<?php echo 'quantidade'.$nome_material?>" name="<?php echo 'quantidade'.$nome_material?>" style="width:40px;"><input style="width:40px; border:0; background-color: rgba(100,100,100,0);"type="text" name="<?php echo 'medida'.$nome_material?>" id="medida" value="<?php echo $medida->sigla; ?>"></div></div>
							<br>
						
							<?php } ?>
							<input type="hidden" name="buscar" id="buscar">
							<div> <input type="submit" name="cadastrar" value="Cadastrar"></div>
							</form>
						<?php }?>

						<?php if(isset($_POST['cad']) =='cad'){?>

						<?php						
								$materiais = new Material();
								$medida = new Unidade_medida();
								$materiais = $materiais->get_all_material();
								echo $nome_produto = $_POST['produto'];

								$produtos = new Produto();
								$produtos->add_produtos($nome_produto, $_SESSION['id_empresa']);								
								$id_produto = $produtos->add_produto_bd();
								

								 for ($i=0; $i < count($materiais); $i++) { ?>							
								<?php  
								    $id_unidade_medida = $materiais[$i][2];
									$nome_material = $materiais[$i][1];
									$id = $materiais[$i][0];
									$medida = $medida->get_unidade_medida_by_id($id_unidade_medida);
									
									$quantidade = $_POST['quantidade'.$nome_material];
									if(isset($_POST['incluir'.$nome_material]) && $_POST['incluir'.$nome_material]){
										$checked = $_POST['incluir'.$nome_material];
										 echo $quantidade;									 
										tipo_form($checked, $id_produto, $nome_material, $id, $medida->sigla, $quantidade);
									}
									
								?>
						<?php }?>
					<?php }?>

					<?php if(isset($_POST['buscar']) =='buscar'){?>
							<?php 
							$indice= $_GET['indice'];	
							$materiais = new Material();
							$medida = new Unidade_medida();
							$materiais = $materiais->get_material_by_name($indice);
								$nome_produto = $_POST['produto'];
								$produtos = new Produto();
								$produtos->add_produtos($nome_produto, $_SESSION['id_empresa']);								
								$id_produto = $produtos->add_produto_bd();

									for ($i=0; $i < count($materiais); $i++) { ?>							
										<?php  
										    $id_unidade_medida = $materiais[$i][2];
											$nome_material = $materiais[$i][1];
											$id = $materiais[$i][0];
											$medida = $medida->get_unidade_medida_by_id($id_unidade_medida);
											
											$quantidade = $_POST['quantidade'.$nome_material];
												if(isset($_POST['incluir'.$nome_material]) && $_POST['incluir'.$nome_material]){
													$checked = $_POST['incluir'.$nome_material];
													 echo $quantidade;									 
													tipo_form($checked, $id_produto, $nome_material, $id, $medida->sigla, $quantidade);
												}
										?>
							<?php }?>

					<?php }?>
					
	 
</body>
</html>



