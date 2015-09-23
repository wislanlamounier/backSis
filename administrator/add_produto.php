<?php
//CLIENTE > DADOS DA OBRA > PRODUTOS > MATERIAIS > PATRIMONIOS > FUNCIONARIOS
include("restrito.php"); 

include_once("../model/class_sql.php");
include_once("../model/class_grupo_bd.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_material_bd.php");
include_once("../model/class_unidade_medida_bd.php");
include_once("../model/class_produto_bd.php");
include_once("../model/class_produto_materiais_bd.php");

function validate(){
   if(!isset($_POST['nome']) || $_POST['nome'] == ""){
        return false;
    }
    return true;
}
 ?>


<head>
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">

</head>
<script type="text/javascript">
    function increment(nome, acao){//chama a pagina que vai incrementar a quantidade no patrimonio
            // alert("chamou: "+acao)
            var parametros = nome.split(":");
            
            var quantidade = document.getElementById(nome).value;
            
            var url = '../ajax/ajax_incrementa_quantidade_material.php?id='+parametros[0]+'&qtd='+quantidade+'&tipo='+parametros[2]+'&acao='+acao; 
            
            $.get(url, function(dataReturn) {
                $('#apagar').html(dataReturn);  
            });
    }
    
    function buscarMateriais(acao){
      
        var nome = document.getElementById("nome_pesquisa").value;
        if(document.getElementById("m").checked == true){
            var url = '../ajax/ajax_buscar_materiais.php?nome='+nome+'&tipo=m&acao='+acao;  
            $.get(url, function(dataReturn) {
                $('#form-input-select').html(dataReturn);
            });
        }else if(document.getElementById("p").checked == true){
            var url = '../ajax/ajax_buscar_materiais.php?nome='+nome+'&tipo=p&acao='+acao;  
            $.get(url, function(dataReturn) {
                $('#form-input-select').html(dataReturn);
            });
        }
        
        
    }

    function selecionaProduto(id, whatarray){
            
          var url = '../ajax/ajax_montar_material.php?id='+id+'&whatarray='+whatarray;  
          
          $.get(url, function(dataReturn) {
            
            $('#form-input-dados').html(dataReturn); 
          });
    }

    function apagar(id, whatarray, acao){
        
        var url = '../ajax/ajax_apagar.php?id='+id+'&whatarray='+whatarray+'&acao='+acao; 
        
        $.get(url, function(dataReturn) {
          
          $('#form-input-dados').html(dataReturn);  
        });
    }
    function cancel(){
      opc = confirm("Tem certeza que deseja cancelar?");
      if(opc)
        window.location.href='add_produto.php?t=c';

    }
</script>

  
      <?php include_once("../view/topo.php"); ?>
              <div id="apagar" style="float:left"></div>
            <?php

                if(isset($_POST['t']) && $_POST['t'] == 'cadastrar'){
                    $cont=0; //conta se todos os materiais foram adicionados com sucesso
                    $materiais = $_SESSION['produto']['material'];
                    $sucesso = false; // verifica se o produto foi adicionado com sucesso
                    if(validate()){
                        $produto = new Produto();
                        $produto_materiais = new  ProdutosMateriais();                      
                        // print_r($_SESSION['produto']['material']);
                        $nome = $_POST['nome'];
                        $id_empresa = $_SESSION['id_empresa'];
                        $produto->add_produtos($nome, $id_empresa);//inserindo dados no objeto
                        $id_produto = $produto->add_produto_bd();
                        
                        if($id_produto){
                          $sucesso = 'Cadastrado';

                          for($aux = 0; $aux < count($materiais); $aux++){
                              // echo '<br />'.$materiais[$aux];
                              $id_qtd_tipo = explode(":", $materiais[$aux]);
                              

                              $id_material = $id_qtd_tipo[0].':'.$id_qtd_tipo[2];


                              $produto_materiais = $produto_materiais->add_produtos_materiais($id_produto, $id_material, $id_qtd_tipo[1]);
                              // $sucesso = $produto_materiais->add_produtos_materiais_bd();
                              
                              if($produto_materiais->add_produtos_materiais_bd()){
                                 $cont++;
                              }
                          }
                          unset($_SESSION['produto']);
                        }
                    }
                }else if(isset($_POST['t']) && $_POST['t'] == 'editar'){
                    $cont=0; //conta se todos os materiais foram adicionados com sucesso
                    $materiais = $_SESSION['produto']['editar']['material'];
                    $sucesso = false; // verifica se o produto foi adicionado com sucesso
                    if(validate()){
                        $produto = new Produto();
                        $produto_materiais = new  ProdutosMateriais();                      
                        // print_r($_SESSION['produto']['material']);
                        
                        $nome = $_POST['nome'];
                        $id_produto = $_POST['id_produto'];
                        $produto = $produto->atualiza_produto($nome, $id_produto);
                        
                        if($id_produto){
                          $sucesso = 'Atualizado';
                          $produto_materiais->limpa_materiais_produto($id_produto);
                          for($aux = 0; $aux < count($materiais); $aux++){
                              // echo '<br />'.$materiais[$aux];
                              $id_qtd_tipo = explode(":", $materiais[$aux]);
                              

                              $id_material = $id_qtd_tipo[0].':'.$id_qtd_tipo[2];


                              $produto_materiais = $produto_materiais->add_produtos_materiais($id_produto, $id_material, $id_qtd_tipo[1]);
                              // $sucesso = $produto_materiais->add_produtos_materiais_bd();
                              
                              if($produto_materiais->add_produtos_materiais_bd()){
                                 $cont++;
                              }
                          }
                          unset($_SESSION['produto']);
                        }
                    }
                    
                }
           ?>
      
            <div class="formulario" style="width:500px;">
              <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR PRODUTO</span></div></div>
              <?php 
                    if(isset($_GET['t']) && $_GET['t'] == 'c'){
                        unset($_SESSION['produto']);
                    }
               ?>
               <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){ ?>
              
                      <form  action="add_produto.php" method="POST" onsubmit="return validate(this)">

                                <?php
                                    unset($_SESSION['produto']['editar']);
                                    $produto = new Produto();
                                    $produto = $produto->get_produto_id($_GET['id']);
                                    $aux = 0;
                                    $materiais = $produto->get_materiais_produto($produto->id);
                                    foreach ($materiais as $key => $value) {
                                        foreach ($value as $key => $material) {
                                            if($key == 1){
                                                $id_tipo = explode(':', $material);                                             
                                            }
                                            if($key == 2){
                                                $quantidade = $material;                                             
                                            }
                                        }
                                        $_SESSION['produto']['editar']['material'][$aux] = $id_tipo[0].':'.$quantidade.':'.$id_tipo[1];
                                        $aux++;
                                    }                                  
                               ?>
                              <input type="hidden" id="t" name="t" value="editar">
                               <input type="hidden" id="id_produto" name="id_produto" value="<?php echo $produto->id ?>">
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  
                                  <div class="desc-bloco">
                                      <span>Selecione os Materiais necessários para esse produto </span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <div class="form-input" style="background-color:rgba(210,210,210,0.5); padding: 10px 0px 10px 5px; border: 1px solid#bbb;">
                                                  <span><b>Nome: </b></span><input type="text" placeholder="Digite o nome do produto" id="nome" name="nome" style="width:75%" value="<?php echo $produto->nome ?>">    
                                              </div>
                                              <span><b>Pesquisar materiais: </b></span><br />
                                              <input type="radio" style="height:12px" checked name="tipo_material" id="m"><span>Materiais</span><input type="radio" name="tipo_material" id="p" style="height:12px"><span>Produtos</span>
                                              <input type="text" placeholder="Digite para pesquisar..." title="Digite o nome do material para pesquisar" id="nome_pesquisa" style="width:65%"> <input type="button" value="Buscar" onclick="buscarMateriais('editaproduto')">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Materiais selecionados: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb;  padding: 10px;">
                                                <?php 
                                                if(isset($_SESSION['produto']['editar']['material'])){
                                                  echo '<table>';
                                                      for($aux = 0; $aux < count($_SESSION['produto']['editar']['material']); $aux++){
                                                        $id_qtd_tipo = explode(':', $_SESSION['produto']['editar']['material'][$aux]);
                                                          // echo 'ID: '.$tipo_id_qtd_tipo[1].' Tipo: '.$tipo_id_qtd_tipo[0].' Quantidade: '.$tipo_id_qtd_tipo[2].'<br />';

                                                        if($aux%2==0)
                                                               echo '<tr style="background-color:#ccc;">';
                                                        else
                                                              echo '<tr style="background-color:#ddd;">';
                                                            if($id_qtd_tipo[2] == 'm'){// se for material
                                                                  $res = new Material();
                                                                  $res = Material::get_material_id($id_qtd_tipo[0]);
                                                                  $uni = new Unidade_medida();
                                                                  $uni = $uni->get_unidade_medida_by_id($res->id_unidade_medida);
                                                                  echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" onchange="increment(this.id, \'editar\')" style="width:50%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd_tipo[1].'"> <span>'.$uni->sigla.'</span></td><td><a name="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" style="cursor:pointer"  onclick="apagar(this.name,\'material\',\'editar\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            }else if($id_qtd_tipo[2] == 'p'){// se for produto
                                                                  $res = new Produto();
                                                                  $res = $res->get_produto_id($id_qtd_tipo[0]);
                                                                  echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" onchange="increment(this.id, \'editar\')" style="width:50%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd_tipo[1].'"></td><td><a name="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" style="cursor:pointer"  onclick="apagar(this.name,\'material\',\'editar\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            }
                                                        echo '</tr>';
                                                      }
                                                      echo '</table>';
                                                }
                                                 ?>
                                          </div>
                                      </div>
                                   </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="Salvar"> <input type="button" name="button" class="button" onclick="cancel()" id="button" value="Cancelar">
                              </div>
                              
                       </form>
      
                       
                        <?php 
                            if(isset($sucesso) && $sucesso == true && count($materiais) == $cont){
                              echo '<div class="msg">Produto '.$_POST['nome'].' adicionado com sucesso</div>';
                              
                            }
                            if(isset($sucesso) && !$sucesso && isset($_POST['nome'])){
                              echo '<div class="msg">'.(count($materiais)-$cont).' materiais não foram adicionados</div>';
                            }
                         ?>
                        
              <?php }else{ ?>
                
                      <form  action="add_produto.php" method="POST" onsubmit="return validate(this)">
                               <input type="hidden" id="t" name="t" value="cadastrar">
                              <?php
                                  // $_SESSION['obra']['dados']['nome'] = $_GET['nome'];
                                  // $_SESSION['obra']['dados']['data_inicio_previsto'] = $_GET['data_inicio_previsto'];
                                  // $_SESSION['obra']['dados']['rua'] = $_GET['rua'];
                                  // $_SESSION['obra']['dados']['num'] = $_GET['num'];
                                  // $_SESSION['obra']['dados']['desc'] = $_GET['desc'];
                                  
                               ?>
                              
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  
                                  <div class="desc-bloco">
                                      <span>Selecione os Materiais necessários para esse produto </span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <div class="form-input" style="background-color:rgba(210,210,210,0.5); padding: 10px 0px 10px 5px; border: 1px solid#bbb;">
                                                  <span><b>Nome: </b></span><input type="text" placeholder="Digite o nome do produto" id="nome" name="nome" style="width:75%">    
                                              </div>
                                              <span><b>Pesquisar materiais: </b></span><br />
                                              <input type="radio" style="height:12px" checked name="tipo_material" id="m"><span>Materiais</span><input type="radio" name="tipo_material" id="p" style="height:12px"><span>Produtos</span>
                                              <input type="text" placeholder="Digite para pesquisar..." title="Digite o nome do material para pesquisar" id="nome_pesquisa" style="width:65%"> <input type="button" value="Buscar" onclick="buscarMateriais('addproduto')">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                          
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Materiais selecionados: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb;  padding: 10px;">
                                                <?php 
                                                if(isset($_SESSION['produto']['material'])){
                                                  echo '<table>';
                                                      for($aux = 0; $aux < count($_SESSION['produto']['material']); $aux++){
                                                        $id_qtd_tipo = explode(':', $_SESSION['produto']['material'][$aux]);
                                                          // echo 'ID: '.$tipo_id_qtd_tipo[1].' Tipo: '.$tipo_id_qtd_tipo[0].' Quantidade: '.$tipo_id_qtd_tipo[2].'<br />';

                                                        if($aux%2==0)
                                                               echo '<tr style="background-color:#ccc;">';
                                                        else
                                                              echo '<tr style="background-color:#ddd;">';
                                                            if($id_qtd_tipo[2] == 'm'){// se for material
                                                                  $res = new Material();
                                                                  $res = Material::get_material_id($id_qtd_tipo[0]);
                                                                  $uni = new Unidade_medida();
                                                                  $uni = $uni->get_unidade_medida_by_id($res->id_unidade_medida);
                                                                  echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" onchange="increment(this.id,\'cadastrar\')" style="width:50%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd_tipo[1].'"> <span>'.$uni->sigla.'</span></td><td><a name="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" style="cursor:pointer"  onclick="apagar(this.name,\'material\',\'cadastrar\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            }else if($id_qtd_tipo[2] == 'p'){// se for produto
                                                                  $res = new Produto();
                                                                  $res = $res->get_produto_id($id_qtd_tipo[0]);
                                                                  echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" onchange="increment(this.id, \'cadastrar\')" style="width:50%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd_tipo[1].'"></td><td><a name="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" style="cursor:pointer"  onclick="apagar(this.name,\'material\', \'cadastrar\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            }
                                                        echo '</tr>';
                                                      }
                                                      echo '</table>';
                                                }
                                                 ?>
                                          </div>
                                      </div>
                                   </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="cancel()" id="button" value="Cancelar">
                              </div>
                              
                       </form>
      
                       
                        <?php


                            if(isset($sucesso) && $sucesso != false && count($materiais) == $cont){
                              echo '<div class="msg">Produto '.$_POST['nome'].' '.$sucesso.' com sucesso</div>';
                              
                            }
                            if(isset($sucesso) && !$sucesso && isset($_POST['nome'])){
                              echo '<div class="msg">'.(count($materiais)-$cont).' materiais não foram adicionados</div>';
                            }
                         ?>
              <?php } ?>
              
            

        </div>
         
        <?php include_once("informacoes_produto.php"); ?>
      

