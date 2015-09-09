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

function validate(){
   if(!isset($_POST['desc']) || $_POST['desc'] == ""){
        return false;
    }
      return true;
}
 ?>

<html>
<head>
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <link rel="stylesheet" type="text/css" href="style.css">

</head>
<script type="text/javascript">
    function increment(nome){//chama a pagina que vai incrementar a quantidade no patrimonio

            var parametros = nome.split(":");
            
            var quantidade = document.getElementById(nome).value;
            
            var url = '../ajax/ajax_incrementa_quantidade_material.php?id='+parametros[0]+'&qtd='+quantidade; 
            
            $.get(url, function(dataReturn) {
                $('#apagar').html(dataReturn);  
            });
    }
    
    function buscarProdutos(){
        var nome = document.getElementById("nome_pesquisa").value;
        var url = '../ajax/ajax_buscar_materiais.php?nome='+nome;  

         $.get(url, function(dataReturn) {
            $('#form-input-select').html(dataReturn);
          });
    }

    function selecionaProduto(id){
            
          var url = '../ajax/ajax_montar_material.php?id='+id;  
          
          $.get(url, function(dataReturn) {
            
            $('#form-input-dados').html(dataReturn); 
          });
    }

    function apagar(id, whatarray){
        
        var url = '../ajax/ajax_apagar.php?id='+id+'&whatarray='+whatarray; 
        
        $.get(url, function(dataReturn) {
          
          $('#form-input-dados').html(dataReturn);  
        });
    }
</script>

<body>  
      <?php include_once("../view/topo.php"); ?>

      
            <div class="formulario" style="width:500px;">
              <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">NOVO PRODUTO</span></div></div>
              <?php 
                    if(isset($_GET['t']) && $_GET['t'] == 'c'){
                        unset($_SESSION['produto']);
                    }
               ?>

                      <form  action="add_obra.php" onsubmit="return validate(this)">
                               <input type="hidden" id="t" name="t" value="a_f_o">
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
                                      <span>Selecione os Materiais referentes a esse produto </span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <div class="form-input" style="background-color:rgba(210,210,210,0.5); padding: 10px 0px 10px 5px; border: 1px solid#bbb;">
                                                  <span><b>Nome: </b></span><input type="text" placeholder="Digite o nome do produto" id="nome_produto" style="width:75%">    
                                              </div>
                                              <span><b>Pesquisar materiais: </b></span><br /><input type="text" placeholder="Digite para pesquisar..." title="Digite o nome do material para pesquisar" id="nome_pesquisa" style="width:65%"> <input type="button" value="Buscar" onclick="buscarProdutos()">
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
                                                        $id_qtd = explode(':', $_SESSION['produto']['material'][$aux]);
                                                          // echo 'ID: '.$tipo_id_qtd[1].' Tipo: '.$tipo_id_qtd[0].' Quantidade: '.$tipo_id_qtd[2].'<br />';

                                                        echo '<tr>';
                                                            $res = new Material();
                                                            $res = Material::get_material_id($id_qtd[0]);
                                                            $uni = new Unidade_medida();
                                                            $uni = $uni->get_unidade_medida_by_id($res->id_unidade_medida);
                                                           echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd[1].'" onchange="increment(this.id)" style="width:30%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd[1].'"> <span>'.$uni->sigla.'</span></td><td><a name="'.$res->id.':'.$id_qtd[1].'" style="cursor:pointer"  onclick="apagar(this.name,\'material\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                        
                                                        echo '</tr>';
                                                        // if(count($patrimonio)>1)
                                                        //  for($aux = 0; $aux < count($patrimonio); $aux++ ){
                                                        //      echo 'id '. $patrimonio[$aux][1].'<br />';
                                                        //  }
                                                        // else
                                                        //  echo 'id '. $patrimonio[0][1].'<br />';
                                                      }
                                                      echo '</table>';
                                                }
                                                 ?>
                                          </div>
                                      </div>
                                      
                                      
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_produto.php?t=c'" id="button" value="Cancelar">
                              </div>
                       </form>
      



            

        </div>
         
        <?php //include("informacoes_grupo.php") ?> 
      
</body>
</html>