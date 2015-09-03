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
function sessionProduto(nome){
	var produto = nome;
	alert(nome);
	 var url = '../ajax/ajax_incrementa_quantidade_material.php?nome='+nome;  //caminho do arquivo php que irá buscar os materiais

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

			
            <div class="formulario" style="width:43%;">
              <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">PRODUTO</span></div></div>
              	<?php 
                    if(isset($_GET['t']) && $_GET['t'] == 'c'){
                        unset($_SESSION['produto']);
                    }
               ?>


 <form  action="add_obra.php" onsubmit="return validate(this)">
                               <input type="hidden" id="cad" name="cad" value="cad">
                              
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  <div class="title-bloco">Produtos</div>
                                  <div class="desc-bloco">
                                      <span>Selecione os materiais </span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <div class="form-input" style="background-color:rgba(200,200,200,0.5); padding: 10px 0px 10px 0px;">
                                                  <input type="hidden" id="tipo" value="2">
                                                  <span><b>Nome do Produto: </b></span>
                                                  <input type="text" id="produto" name="produto" onchange="sessionProduto(this.value)">
                                                  <?php echo $_SESSION['produto']['nome']?>
                                              </div>
                                              <span><b>Materiais: </b></span><br /><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:65%"> <input type="button" value="Buscar" onclick="buscarMateriais()">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Patrimonios selecionados: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb;  padding: 10px;">
                                                <?php 
                                                    echo '<table>';
                                                    if(isset($_SESSION['obra']['patrimonio']))//se conter dados de patrimonio na sessão executa o for percorrendo e exibindo os dados com as quantidades
                                                        for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
                                                            //variavel tipo_id_qtd = os valores da sessão
                                                            $tipo_id_qtd = explode(':', $_SESSION['obra']['patrimonio'][$aux]);
                                                              

                                                            echo '<tr>';
                                                            if($tipo_id_qtd[0] == 0){
                                                               $res = Patrimonio_geral::get_patrimonio_geral_id($tipo_id_qtd[1]);
                                                               echo '<td ><span>'.$res->nome.': </span></td><td><input name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
                                                            }else if($tipo_id_qtd[0] == 1){
                                                               $res = Maquinario::get_maquinario_id($tipo_id_qtd[1]);
                                                               echo '<td><span>'.$res->modelo.': </span></td><td><input name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
                                                            }else{
                                                               $res = Veiculo::get_veiculo_id($tipo_id_qtd[1]);
                                                               echo '<td><span>'.$res->modelo.': </span></td><td><input name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
                                                            }
                                                            echo '</tr>';
                                                            // if(count($patrimonio)>1)
                                                            //  for($aux = 0; $aux < count($patrimonio); $aux++ ){
                                                            //      echo 'id '. $patrimonio[$aux][1].'<br />';
                                                            //  }
                                                            // else
                                                            //  echo 'id '. $patrimonio[0][1].'<br />';
                                                        }
                                                        echo '</table>';

                                                 ?>
                                          </div>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px;text-align:center">
                                         <input type="button"  onclick="javascript:window.history.back()" value="Voltar"> <input type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_produto.php?t=c'" id="button" value="Cancelar">
                              </div>
                       </form>
























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



