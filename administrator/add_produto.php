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
 <script type="text/javascript">
function session(qtd, id){
	var qtd = qtd;
  var id = id;
	alert(qtd);
  alert(id);
	 var url = '../ajax/ajax_incrementa_quantidade_material.php?id='+id+'&qtd='+qtd;  //caminho do arquivo php que irá buscar os materiais

         $.get(url, function(dataReturn) {
            $('#form-input-select').html(dataReturn);  //coloco na div o retorno da requisicao
          });
}

function buscarMateriais(){
      
        
        var nome = document.getElementById("nome").value;
        var url = '../ajax/ajax_buscar_materiais.php?nome='+nome;  //caminho do arquivo php que irá buscar os materiais

         $.get(url, function(dataReturn) {
            $('#form-input-select').html(dataReturn);  //coloco na div o retorno da requisicao
          });
    }
function selecionaProduto(id){
        // alert('chamou'+id)
          
            
          var url = '../ajax/ajax_montar_material.php?id='+id;  //caminho do arquivo php que irá buscar as cidades no BD
          // alert('passou')
          $.get(url, function(dataReturn) {
            
            $('#form-input-dados').html(dataReturn);  //coloco na div o retorno da requisicao
          });
    }


 </script>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style1.css">
</head>

<body>			
	<?php include_once("../view/topo.php"); ?>
               <?php 
                    if(isset($_GET['t']) && $_GET['t'] == 'c'){
                        unset($_SESSION['produto']);
                    }
               ?>
			       <div id="form-input-select">
             </div>
            <div class="formulario" style="width:550px;">
              <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">PRODUTO</span></div></div>
              	
                <div class="bloco-1" id="dados_obra" style="width:525px;">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  <div class="title-bloco">Produtos</div>
                                  <div class="desc-bloco">
                                      <span>Digite o nome do produto em seguida adicione apenas a quantidade do insumo que deseja cadastrar </span>
                                  </div>
                                  <div class="body-bloco" style="width:500px;">
                                      <?php if(isset($_GET['buscar']) !='buscar'){?>
                                            <div class="cabecalho"><div style="float:left;width:60%" ><span>Nome</span></div><div style="float:top"><span>RECEITA</span></div></div>
                                            <br><br>
                                            
                                            <form method="POST" id="cadastrar" onsubmit="return validate(this)">
                                            <div class="desc-produto"><div class="desc"><input type="text" name="produto" id="produto"></div><div class="detalhe"><span>INSUMO</span></div><div class="detalhe"><span>QUANTIDADE</span></div></div>
                                           
                                            <div class="formulario-produto" >
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
                                             
                                              <div class="resultados" id="resultados" ><div class="insumo"><input id="nome_material" readonly type="text" value="<?php echo $nome_material; ?>" name="<?php echo  'insumo'.$nome_material ?>"></div><div class="quantidade" ><input type="number" onchange="session(this.value, this.id)" id="<?php echo $id?>" name="<?php echo 'quantidade:'.$nome_material?>" value="<?php $_SESSION['produto']['material'][$id] ?>"><input readonly  id="medida" value="<?php echo $medida->sigla; ?>"></div></div>
                                             
                                              <br>                                            
                                              <?php } ?>
                                              <br> <br>
                                              <div class="buttons" style="text-align:center">
                                                <input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_produto.php?t=c'" id="button" value="Cancelar">
                                              </div>
                                                                                      
                                              </form>
                                            </div>
            <?php } ?>      
                </div>
                                
            </div>
                       
























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



