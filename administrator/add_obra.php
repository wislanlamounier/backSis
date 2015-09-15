<?php
//CLIENTE > DADOS DA OBRA > PRODUTOS > MATERIAIS > PATRIMONIOS > FUNCIONARIOS
include("restrito.php"); 

include_once("../model/class_sql.php");
include_once("../model/class_grupo_bd.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_produto_bd.php");
include_once("../model/class_cbo_bd.php");

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
    function exibe(id){
        
        var url = '../ajax/ajax_buscar_materiais.php?id_produto='+id; 
            
         $.get(url, function(dataReturn) {
              
              $('#popup').html(dataReturn);  
         });

        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;
      
        var screenWidth = screen.width;
        var screenHeight = screen.height;
        // alert(windowWidth+" x "+windowHeight)
        if(windowWidth > 1200){
          document.getElementById("popup").style.marginLeft = "35%";
        }else if(windowWidth > 1000){
          document.getElementById("popup").style.marginLeft = "30%";
        }else if(windowWidth > 500){
          document.getElementById("popup").style.marginLeft = "20%";
        }else{
          document.getElementById("popup").style.marginLeft = "0%";
        }
    }
    function fechar(){

        document.getElementById("popup").style.marginLeft = "-450px";
    }
    function increment(nome, whatarray){//chama a pagina que vai incrementar a quantidade no patrimonio
           var parametros = nome.split(":");
                
           var quantidade = document.getElementById(nome).value;

           if(quantidade > 0){
               if(whatarray == 'patrimonio'){
                    
                    var url = '../ajax/ajax_incrementa_quantidade.php?id='+parametros[1]+'&qtd='+quantidade+'&tipo='+parametros[2]+'&whatarray='+whatarray; 
                    
                    $.get(url, function(dataReturn) {
                      
                    });
                }else if(whatarray == 'produto'){
                    
                    var url = '../ajax/ajax_incrementa_quantidade.php?id='+parametros[0]+'&qtd='+quantidade+'&whatarray='+whatarray; 
                    
                    $.get(url, function(dataReturn) {
                      
                    });
                }
          }else{
             alert("Insira um valor maior que 0")
          }
    }
  	function buscarClientes(){

            var nome = document.getElementById("nome").value;
            var url = '../ajax/ajax_buscar_clientes.php?nome='+nome; 
            
            $.get(url, function(dataReturn) {
            	
              $('#form-input-select').html(dataReturn);  
            });
         
    }
    function buscarPatrimonios(){
      
        if(document.getElementById("veiculo").checked == true){
            tipo = 2;
            document.getElementById("tipo").value = "2";
        }else if(document.getElementById("maquinario").checked == true){
            tipo = 1;
            document.getElementById("tipo").value = "1";
        }else{
            tipo = 0;
            document.getElementById("tipo").value = "0";
        }
        var nome = document.getElementById("nome").value;
        var url = '../ajax/ajax_buscar_patrimonios.php?nome='+nome+'&tipo='+tipo;  

         $.get(url, function(dataReturn) {
            $('#form-input-select').html(dataReturn);
          });
    }
    function selecionaCliente(id){
          var url = '../ajax/ajax_buscar_dados_cliente.php?id='+id;  
          
          $.get(url, function(dataReturn) {
            
            $('#form-input-dados').html(dataReturn); 
          });
    }
    function selecionaPatrimonio(id){
          var tipo = document.getElementById("tipo").value;
            
          var url = '../ajax/ajax_montar_patrimonio.php?id='+id+'&tipo='+tipo;  

          $.get(url, function(dataReturn) {
            
            $('#form-input-dados').html(dataReturn); 
          });
    }
    function buscarFuncionario(){
        var nome = document.getElementById("nome").value;
        var url = "../ajax/ajax_buscar_funcionarios.php?nome="+nome;

        $.get(url, function(dataReturn) {
            
            $('#form-input-select').html(dataReturn);
        });
    }
    function selecionaFuncionarios(id){
      
        var url = '../ajax/ajax_montar_funcionarios.php?id='+id; 
        
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
    function buscarProdutos(){
        var nome = document.getElementById("nome").value;
        
        var url = '../ajax/ajax_buscar_materiais.php?nome='+nome+'&tipo=p';  
        $.get(url, function(dataReturn) {
            $('#form-input-select').html(dataReturn);
        });
    }
    function selecionaProduto(id){
            
          var url = '../ajax/ajax_montar_material.php?id='+id+'&whatarray=obra';
          
          $.get(url, function(dataReturn) {
            
            $('#form-input-dados').html(dataReturn); 
          });
    }
    function cancel(){
      opc = confirm("Tem certeza que deseja cancelar?");
      if(opc)
        window.location.href='add_obra.php?t=c';
    }

</script>

<body>	
			<?php include_once("../view/topo.php"); ?>

			
            <div class="formulario" style="width:43%;">
              <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">NOVA OBRA</span></div></div>
              <?php 
                    if(isset($_GET['t']) && $_GET['t'] == 'c'){
                        unset($_SESSION['obra']);
                        echo '<div class="msg">
                                  <form  action="add_obra.php">
                                    <input type="hidden" id="t" name="t" value="a_c_o">
                                    Cadastramento cancelado!<br /><br />
                                    <input type="submit"  value="Nova Obra" class="button"> <input type="button" onclick="window.location.href=\'principal.php\'" value="Início" class="button">
                                  </form> 
                              </div>';
                    }
               ?>
            <?php if(isset($_GET['t']) && $_GET['t'] == 'a_c_o'){ // add clientes da obra?>
            	         <?php $_SESSION['obra']['status'] = 0; ?>
                       <form  action="add_obra.php" onsubmit="return validate(this)">
                        
                              <input type="hidden" id="t" name="t" value="a_d_o">

                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                              		<div class="title-bloco"><b>Cliente/Obra</b></div>
                                  <div class="desc-bloco">
                                      <span>Selecione o cliente </span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <span><b>Nome/Razao Social: </b></span><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:65%"> <input type="button" value="Buscar" onclick="buscarClientes()">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                          <div class="form-input">
                                              <span style="color:#787878; font-size:12px;">(Clique para selecionar)</span>
                                          </div>
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Dados do cliente selecionado: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb; height:200px; padding: 10px;">
                                              <input type="hidden" name="id_cli" value="<?php (isset($_SESSION['obra']['cliente']['id_cli']))?print $_SESSION['obra']['cliente']['id_cli']:''; ?>">
                                              <span><b>Nome/Razao Social:</b></span><input readonly  name="nome_cli" id="nome_cli" type="text" style="border: 0; width: 100%; height: 20px; padding-left:20px;" value="<?php (isset($_SESSION['obra']['cliente']['nome_cli']))?print $_SESSION['obra']['cliente']['nome_cli']:''; ?>"><br />
                                              <span><b>CPF/CNPJ:</b></span><input readonly  name="cpf_cnpj_cli" id="cpf_cnpj_cli" type="text" style="border: 0; width: 100%; height: 20px; padding-left:20px;" value="<?php (isset($_SESSION['obra']['cliente']['cpf_cnpj_cli']))?print $_SESSION['obra']['cliente']['cpf_cnpj_cli']:''; ?>"><br />
                                              <span><b>Endereço:</b></span><input style="border: 0px; width: 100%;height: 20px; padding-left:20px;" readonly  name="rua" id="rua" type="text" value="<?php (isset($_SESSION['obra']['cliente']['rua']))?print $_SESSION['obra']['cliente']['rua']:''; ?>"><br />
                                              <span><b>Nº:</b></span><input style="border: 0px; width: 100%; height:20px; padding-left:20px;" readonly  name="num" id="num" type="text" style="border: 0; width:100%; height: 20px;"value="<?php (isset($_SESSION['obra']['cliente']['num']))?print $_SESSION['obra']['cliente']['num']:''; ?>"><br />
                                              <span><b>Telefone:</b></span><input style="border: 0px; width: 100%; height:20px; padding-left:20px;" readonly  name="telefone_com" id="telefone_com" type="text" style="border: 0; width:100%"value="<?php (isset($_SESSION['obra']['cliente']['telefone_com']))?print $_SESSION['obra']['cliente']['telefone_com']:''; ?>"><br />
                                          </div>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px; text-align:center;  width:97%">
                                         <!-- <input type="button"  onclick="javascript:window.history.back()" class="voltar" value="Voltar"> --> <input class="avancar" type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                              <div class="form-input">
                                    <div class="buttons">
                                        <!-- <input type="submit" name="button" class="button" id="button" value="Cadastrar"> --> <input type="button" name="button" class="button" onclick="cancel()" id="button" value="Cancelar">
                                    </div>
                              </div>
                       </form>          
                       
            <?php }else if(isset($_GET['t']) && $_GET['t'] == 'a_d_o'){ //add dados da obra?>
                      <form  action="add_obra.php" onsubmit="return validate(this)">
                               <input type="hidden" id="t" name="t" value="a_pr_o">
                              <?php
                                  $_SESSION['obra']['cliente']['id_cli'] = $_GET['id_cli'];
                                  $_SESSION['obra']['cliente']['nome_cli'] = $_GET['nome_cli'];
                                  $_SESSION['obra']['cliente']['cpf_cnpj_cli'] = $_GET['cpf_cnpj_cli'];
                                  $_SESSION['obra']['cliente']['rua'] = $_GET['rua'];
                                  $_SESSION['obra']['cliente']['num'] = $_GET['num'];
                                  $_SESSION['obra']['cliente']['telefone_com'] = $_GET['telefone_com'];
                                  
                               ?>
                              
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  <div class="title-bloco"><b>Dados da obra</b></div>
                                  <div class="desc-bloco">
                                      <span>Preencha os principais dados da obra</span>
                                  </div>
                                  <div class="body-bloco" style="padding:10px;">
                                      <div class="form-input" style="width:45%">
                                          <span>Nome:</span><br /><input  type="text" placeholder="Digite o nome da obra..." name="nome" id="nome" value="<?php (isset($_SESSION['obra']['dados']['nome']))?print $_SESSION['obra']['dados']['nome']:''; ?>" style="width:100%">
                                      </div>
                                      <div class="form-input" style="width:40%; margin-left: 10px;">
                                          <span>Data inicio:</span><br /><input type="date" name="data_inicio_previsto" id="data_inicio_previsto" value="<?php (isset($_SESSION['obra']['dados']['data_inicio_previsto']))?print $_SESSION['obra']['dados']['data_inicio_previsto']:''; ?>" style="width:100%; ">
                                      </div>
                                      <div class="form-input" style="width:60%">
                                          <span>Rua:</span><br /><input type="text" placeholder="" name="rua" id="rua" style="width:100%" value="<?php (isset($_SESSION['obra']['dados']['rua']))?print $_SESSION['obra']['dados']['rua']:'' ?>">
                                      </div>
                                      <div class="form-input" style="width:25%; margin-left: 10px;">
                                          <span>Nº:</span><br /><input type="number" name="num" id="num"  style="width:100%; " value="<?php (isset($_SESSION['obra']['dados']['num']))?print $_SESSION['obra']['dados']['num']:'' ?>">
                                      </div>
                                      <div class="form-input">
                                          <span>Descricão:</span><br /><textarea type="text" placeholder="Descreva os principais detalhes da obra..." name="desc" id="desc"  style="width:90%; max-width:90%; height: 10%;max-height: 100px; padding: 2px;"><?php (isset($_SESSION['obra']['dados']['desc']))?print $_SESSION['obra']['dados']['desc']:'' ?></textarea>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px; text-align:center;  width:97%">
                                         <input type="button"  onclick="javascript:window.history.back()" class="voltar" value="Voltar"> <input class="avancar" type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="cancel()" id="button" value="Cancelar">
                              </div>
                       </form>
			      <?php }else if(isset($_GET['t']) && $_GET['t'] == 'a_pr_o'){ //add produtos da obra?>
                        <form  action="add_obra.php" onsubmit="return validate(this)">
                               <input type="hidden" id="t" name="t" value="a_p_o">
                              <?php
                                  $_SESSION['obra']['dados']['nome'] = $_GET['nome'];
                                  $_SESSION['obra']['dados']['data_inicio_previsto'] = $_GET['data_inicio_previsto'];
                                  $_SESSION['obra']['dados']['rua'] = $_GET['rua'];
                                  $_SESSION['obra']['dados']['num'] = $_GET['num'];
                                  $_SESSION['obra']['dados']['desc'] = $_GET['desc'];
                                  
                               ?>
                               <div id="popup" class="popup" style="float:left">
                                    <div class="formulario" style="width:300px;">
                                      <table style="width:100%; text-align:center;" border="0">
                                         <!-- <input type="hidden" id="id_banco" name="id_banco" value="<?php echo $banco->id ?>"> -->
                                         <tr><td colspan='2'><b>Materiais</b></td></tr>
                                         <tr><td colspan='2'><input onclick="fechar()" type="button"  class="button" value="Concluir" ></td></tr>
                                       </table>
                                    </div>
                               </div>
                        
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  <div class="title-bloco"><b>Produtos/Obra</b></div>
                                  <div class="desc-bloco">
                                      <span>Selecione os Produtos </span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <span><b>Nome: </b></span><br /><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:65%"> <input type="button" value="Buscar" onclick="buscarProdutos()">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                          <div class="form-input">
                                              <span style="color:#787878; font-size:12px;">(Duplo clique para selecionar)</span>
                                          </div>
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Produtos selecionados: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb;  padding: 10px;">
                                                <?php 

                                                  if(isset($_SESSION['obra']['produto'])){
                                                      echo '<table>';
                                                      for($aux = 0; $aux < count($_SESSION['obra']['produto']); $aux++){
                                                        $id_qtd = explode(':', $_SESSION['obra']['produto'][$aux]);

                                                        if($aux%2==0)
                                                                   echo '<tr style="background-color:#ccc;">';
                                                            else
                                                                  echo '<tr style="background-color:#ddd;">';
                                                                
                                                         $res = new Produto();
                                                         $res = $res->get_produto_id($id_qtd[0]);
                                                         echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd[1].'" onchange="increment(this.id,\'produto\')" style="width:100%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd[1].'"></td><td><a name="'.$res->id.'" title="Clique aqui para ver os materiais desse produto" onclick="exibe(this.name)" style="cursor:pointer"><span>Ver materiais</span></a></td><td><a name="'.$res->id.':'.$id_qtd[1].'" style="cursor:pointer"  onclick="apagar(this.name,\'produto\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            
                                                          echo '</tr>';
                                                      }
                                                      echo '</table>';
                                                }

                                                 ?>
                                          </div>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px; text-align:center;  width:97%">
                                         <input type="button"  onclick="javascript:window.history.back()" class="voltar" value="Voltar"> <input class="avancar" type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center;">
                                  <input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="cancel()" id="button" value="Cancelar">
                              </div>
                       </form>

			      <?php }else if(isset($_GET['t']) && $_GET['t'] == 'a_p_o'){ //add patrimonios da obra?>
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
                                  <div class="title-bloco"><b>Patrimonios/Obra</b></div>
                                  <div class="desc-bloco">
                                      <span>Selecione os Patrimonios</span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <div class="form-input" style="background-color:rgba(200,200,200,0.5); padding: 10px 0px 10px 0px;">
                                                  <input type="hidden" id="tipo" value="2">
                                                  <span><b>Tipo: </b></span>
                                                  <input type="radio" name="tipo" id="veiculo" style="height:12px;" value="veiculo" checked><span>Veículo</span><input type="radio" name="tipo" value="maquinario" id="maquinario" style="height:12px;"><span>Maquinario</span><input style="height:12px;" value="geral" name="tipo" id="geral" type="radio"><span>Geral</span><br />
                                              </div>
                                              <span><b>Nome: </b></span><br /><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:65%"> <input type="button" value="Buscar" onclick="buscarPatrimonios()">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                          <div class="form-input">
                                              <span style="color:#787878; font-size:12px;">(Duplo clique para selecionar)</span>
                                          </div>
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Patrimonios selecionados: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb;  padding: 10px;">
                                                <?php 
                                                    echo '<table style="width:100%">';
                                                    if(isset($_SESSION['obra']['patrimonio']))//se conter dados de patrimonio na sessão executa o for percorrendo e exibindo os dados com as quantidades
                                                        for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
                                                            //variavel tipo_id_qtd = os valores da sessão
                                                            $tipo_id_qtd = explode(':', $_SESSION['obra']['patrimonio'][$aux]);

                                                            if($aux%2==0)
                                                               echo '<tr style="background-color:#ccc;">';
                                                            else
                                                              echo '<tr style="background-color:#ddd;">';
                                                            if($tipo_id_qtd[0] == 0){
                                                               $res = Patrimonio_geral::get_patrimonio_geral_id($tipo_id_qtd[1]);
                                                               echo '<td ><span>'.$res->nome.': </span></td><td><input  id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" onchange="increment(this.id, \'patrimonio\')" style="width:30%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$tipo_id_qtd[2].'"></td><td><a style="cursor:pointer" name="'.$tipo_id_qtd[0].':'.$res->id.':'.$tipo_id_qtd[2].'" id="'.$res->id.'" onclick="apagar(this.name,\'patrimonio\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            }else if($tipo_id_qtd[0] == 1){
                                                               $res = Maquinario::get_maquinario_id($tipo_id_qtd[1]);
                                                               echo '<td><span>'.$res->modelo.': </span></td><td><input readonly  id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.id, \'patrimonio\')" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td><td><a style="cursor:pointer" name="'.$tipo_id_qtd[0].':'.$res->id.':'.$tipo_id_qtd[2].'" id="'.$res->id.'" onclick="apagar(this.name,\'patrimonio\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            }else{
                                                               $res = Veiculo::get_veiculo_id($tipo_id_qtd[1]);
                                                               echo '<td><span>'.$res->modelo.': </span></td><td><input readonly  id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.id, \'patrimonio\')" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td><td><a style="cursor:pointer" name="'.$tipo_id_qtd[0].':'.$res->id.':'.$tipo_id_qtd[2].'" id="'.$res->id.'" onclick="apagar(this.name,\'patrimonio\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                                                            }
                                                            echo '</tr>';

                                                        }
                                                        echo '</table>';

                                                 ?>
                                          </div>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px; text-align:center;  width:97%">
                                         <input type="button"  onclick="javascript:window.history.back()" class="voltar" value="Voltar"> <input class="avancar" type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="cancel()" id="button" value="Cancelar">
                              </div>
                       </form>
      
            <?php }else if(isset($_GET['t']) && $_GET['t'] == 'a_f_o'){ //add produtos da obra?>
                        <form  action="add_obra.php" onsubmit="return validate(this)">
                               <input type="hidden" id="t" name="t" value="final">
                              <?php
                                  // $_SESSION['obra']['dados']['nome'] = $_GET['nome'];
                                  // $_SESSION['obra']['dados']['data_inicio_previsto'] = $_GET['data_inicio_previsto'];
                                  // $_SESSION['obra']['dados']['rua'] = $_GET['rua'];
                                  // $_SESSION['obra']['dados']['num'] = $_GET['num'];
                                  // $_SESSION['obra']['dados']['desc'] = $_GET['desc'];
                                  
                               ?>
                              
                              <!-- <div class="situacao">                                  
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                              </div> -->
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  <div class="title-bloco"><b>Funcionários/Obra</b></div>
                                  <div class="desc-bloco">
                                      <span>Selecione os Funcionarios que trabalharão nessa obra</span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <span><b>Nome: </b></span><br /><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:65%"> <input type="button" value="Buscar" onclick="buscarFuncionario()">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                          <div class="form-input">
                                              <span style="color:#787878; font-size:12px;">(Duplo clique para selecionar)</span>
                                          </div>
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Funcionarios selecionados: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb;  padding: 10px;">
                                                <?php
                                                     if(isset($_SESSION['obra']['funcionario'])){ 
                                                          echo '<table style="width:100%" >';
                                                          for($aux = 0; $aux < count($_SESSION['obra']['funcionario']); $aux++){
                                                              if($aux%2==0)
                                                                 echo '<tr style="background-color:#ccc;">';
                                                              else
                                                                echo '<tr style="background-color:#ddd;">';
                                                                   $res = Funcionario::get_func_id($_SESSION['obra']['funcionario'][$aux]);
                                                                   echo '<td ><span>'.$res->nome.': </span></td><td style="text-align:center"><a style="cursor:pointer" id="'.$res->id.'" onclick="apagar(this.id,\'funcionario\')"><img style="width:15px" src="../images/delete.png"></a></td>';         
                                                                echo '</tr>';
                                                          }
                                                          echo '</table>';
                                                      }
                                                 ?>
                                          </div>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px; text-align:center;  width:97%">
                                         <input type="button"  onclick="javascript:window.history.back()" class="voltar" value="Voltar"> <input class="avancar" type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="cancel()" id="button" value="Cancelar">
                              </div>
                       </form>

            <?php } ?>

	 	    </div>
         <div class="formulario" style="width:43%;">
            <div class="bloco-1">
                <div class="form-input">
                    <div class="form-input"><b>DADOS DO CADASTRAMENTO</b></div>
                    <?php if(isset($_SESSION['obra']['status']) && $_SESSION['obra']['status'] == 0 ){
                          echo '<div class="form-input">(ORÇAMENTO)</div>';
                    } ?>

                </div>
                <div class="body-bloco">
                  <?php if(isset($_SESSION['obra']['cliente'])){?>
                        <div class="form-input" style="border-bottom: 1px solid#aaa">
                              <span style="margin-left:10px;"><b>Cliente</b></span>
                        </div>
                        <div class="form-input" style="padding: 0px 0px 5px 10px; padding-left:20px;">
                            <?php if(isset($_SESSION['obra']['cliente']['nome_cli']) && $_SESSION['obra']['cliente']['nome_cli'] != '' ){ ?>
                                        <span><b>Nome/Razão Social: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['nome_cli']))?print $_SESSION['obra']['cliente']['nome_cli']:''; ?>"><br />
                            <?php }if(isset($_SESSION['obra']['cliente']['cpf_cnpj_cli']) && $_SESSION['obra']['cliente']['cpf_cnpj_cli'] != ''){ ?>
                                        <span><b>CPF/CNPJ: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['cpf_cnpj_cli']))?print $_SESSION['obra']['cliente']['cpf_cnpj_cli']:''; ?>"><br />
                            <?php }if(isset($_SESSION['obra']['cliente']['rua']) && $_SESSION['obra']['cliente']['rua'] != ''){ ?>
                                        <span><b>Endereço: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['rua']))?print $_SESSION['obra']['cliente']['rua']:''.(isset($_SESSION['obra']['cliente']['num']))?print ', '.$_SESSION['obra']['cliente']['num']:''; ?>"><br />
                            <?php }if(isset($_SESSION['obra']['cliente']['telefone_com']) && $_SESSION['obra']['cliente']['telefone_com'] != ''){ ?>
                                        <span><b>Telefone: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['telefone_com']))?print $_SESSION['obra']['cliente']['telefone_com']:''; ?>"><br />
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['obra']['dados']) && count($_SESSION['obra']['dados']) > 0){?>
                            <div class="form-input" style="border-bottom: 1px solid#aaa">
                                  <span style="margin-left:10px;"><b>Dados da Obra</b></span>
                            </div>
                            <div class="form-input" style="padding: 0px 0px 10px 10px; padding-left:20px;">
                                <?php if(isset($_SESSION['obra']['dados']['nome']) && $_SESSION['obra']['dados']['nome'] != ''){ ?>
                                            <span><b>Nome: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['dados']['nome']))?print $_SESSION['obra']['dados']['nome']:''; ?>"><br />
                                <?php }if(isset($_SESSION['obra']['dados']['data_inicio_previsto']) && $_SESSION['obra']['dados']['data_inicio_previsto'] != ''){ ?>
                                            <span><b>Data Inicio: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['dados']['data_inicio_previsto']))?print $_SESSION['obra']['dados']['data_inicio_previsto']:''; ?>"><br />
                                <?php }if(isset($_SESSION['obra']['dados']['rua']) && $_SESSION['obra']['dados']['rua'] != ''){ ?>
                                            <span><b>Endereço: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['dados']['rua']))?print $_SESSION['obra']['dados']['rua']:''.(isset($_SESSION['obra']['dados']['num']))?print ', '.$_SESSION['obra']['dados']['num']:''; ?>"><br />
                                <?php }if(isset($_SESSION['obra']['dados']['desc']) && $_SESSION['obra']['dados']['desc'] != ''){// se existe descrição ?>
                                            <span><b>Descrição: </b></span><br />
                                                <textarea style="padding: 1px 0px 2px 10px;width:90%; min-width: 90%; max-width:95%; max-height:15%; height: 5%; border: 0" readonly><?php (isset($_SESSION['obra']['dados']['desc']))?print $_SESSION['obra']['dados']['desc']:''; ?></textarea>
                                <?php } ?>
                            </div>
                   <?php } ?>
                   <?php if(isset($_SESSION['obra']['produto']) && count($_SESSION['obra']['produto']) > 0){?>
                            <div class="form-input" style="border-bottom: 1px solid#aaa">
                                  <span style="margin-left:10px;"><b>Produtos/Obra</b></span>
                            </div>
                            <div class="form-input" style="padding: 0px 0px 10px 10px; padding-left:20px;">
                                <?php 

                                                  if(isset($_SESSION['obra']['produto'])){
                                                      echo '<table style="text-align:center; width:90%">';

                                                      echo '<tr style="background-color:#ddd;"><td><span><b>Nome</b></span></td><td><span><b>Quantidade</b></span></td></tr>';
                                                      for($aux = 0; $aux < count($_SESSION['obra']['produto']); $aux++){
                                                        $id_qtd = explode(':', $_SESSION['obra']['produto'][$aux]);

                                                        if($aux%2==0)
                                                                   echo '<tr style="background-color:#ccc;">';
                                                            else
                                                                  echo '<tr style="background-color:#ddd; ">';
                                                                
                                                         $res = new Produto();
                                                         $res = $res->get_produto_id($id_qtd[0]);
                                                         echo '<td style="padding: 3 10 3 10px;"><span>'.$res->nome.' </span></td><td style="padding: 3 10 3 10px;"><span>'.$id_qtd[1].'</span></td>';
                                                            
                                                          echo '</tr>';
                                                      }
                                                      echo '</table>';
                                                }

                                                 ?>
                            </div>
                   <?php } ?>
                   <?php if(isset($_SESSION['obra']['patrimonio']) && count($_SESSION['obra']['patrimonio']) > 0){?>
                            <div class="form-input" style="border-bottom: 1px solid#aaa">
                                  <span style="margin-left:10px;"><b>Patrimonios/Obra</b></span>
                            </div>
                            <div class="form-input" style="padding: 0px 0px 10px 10px; padding-left:20px; ">
                                <?php 
                                      echo '<table style="text-align:center; width:90%">';
                                            echo '<tr style="background-color:#ddd;"><td><span><b>Nome</b></span></td><td><span><b>Quantidade</b></span></td></tr>';
                                      for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
                                                 //variavel tipo_id_qtd = os valores da sessão
                                                 $tipo_id_qtd = explode(':', $_SESSION['obra']['patrimonio'][$aux]);
                                                 if($aux%2==0)
                                                          echo '<tr style="background-color:#ccc;">';
                                                 else
                                                          echo '<tr style="background-color:#ddd; ">';
                                                 if($tipo_id_qtd[0] == 0){
                                                    $res = Patrimonio_geral::get_patrimonio_geral_id($tipo_id_qtd[1]);
                                                    // echo '<li style="margin-left:10px;"><span>'.$res->nome.': </span><input readonly style="width:30%; border: 0" type="number" value="'.$tipo_id_qtd[2].'"></li>';
                                                    echo '<td style="padding: 3 10 3 10px;"><span>'.$res->nome.' </span></td><td style="padding: 3 10 3 10px;"><span>'.$tipo_id_qtd[2].'</span></td>';
                                                 }else if($tipo_id_qtd[0] == 1){
                                                    $res = Maquinario::get_maquinario_id($tipo_id_qtd[1]);
                                                    // echo '<li style="margin-left:10px;"><span>'.$res->modelo.': </span><input readonly style="width:30%; border: 0" type="number" value="'.$tipo_id_qtd[2].'"></li>';
                                                    echo '<td style="padding: 3 10 3 10px;"><span>'.$res->modelo.' </span></td><td style="padding: 3 10 3 10px;"><span>'.$tipo_id_qtd[2].'</span></td>';
                                                 }else{
                                                    $res = Veiculo::get_veiculo_id($tipo_id_qtd[1]);
                                                    // echo '<li style="margin-left:10px;"><span>'.$res->modelo.': </span><input readonly style="width:30%; border: 0" type="number" value="'.$tipo_id_qtd[2].'"></li>';
                                                    echo '<td style="padding: 3 10 3 10px;"><span>'.$res->modelo.' </span></td><td style="padding: 3 10 3 10px;"><span>'.$tipo_id_qtd[2].'</span></td>';
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
                   <?php } ?>
                   <?php if(isset($_SESSION['obra']['funcionario']) && count($_SESSION['obra']['funcionario']) > 0){?>
                                <div class="form-input" style="border-bottom: 1px solid#aaa">
                                  <span style="margin-left:10px;"><b>Funcionários/Obra</b></span>
                            </div>
                            <div class="form-input" style="padding: 0px 0px 10px 10px; padding-left:20px;">
                                <?php 
                                      echo '<table style="text-align:center; width:90%">';
                                            echo '<tr style="background-color:#ddd;"><td><span><b>Nome</b></span></td><td><span><b>Cargo</b></span></td></tr>';
                                      for($aux = 0; $aux < count($_SESSION['obra']['funcionario']); $aux++){
                                                 //variavel tipo_id_qtd = os valores da sessão
                                                 // echo '<li style="margin-left:10px;"><span>'.Funcionario::get_nome_by_id($_SESSION['obra']['funcionario'][$aux]).'</span></li>';
                                          if($aux%2==0)
                                               echo '<tr style="background-color:#ccc;">';
                                          else
                                               echo '<tr style="background-color:#ddd; ">';
                                          // buscarcargo
                                             $funcionario = Funcionario::get_func_id($_SESSION['obra']['funcionario'][$aux]);
                                             $cbo = new Cbo();
                                             $cbo = $cbo->get_cbo_by_id($funcionario->id_cbo);
                                                echo '<td style="padding: 3 10 3 10px;"><span>'.$funcionario->nome.' </span></td><td style="padding: 3 10 3 10px;"><span>'.$cbo->descricao.'</span></td>';
                                                echo '</tr>';
                                      }
                                      
                                      echo '</table>';
                                 ?>
                            </div>
                   <?php } ?>
                </div>
            </div>
         </div>
	 	    <?php //include("informacoes_grupo.php") ?> 
	 		
</body>
</html>