<?php
//CLIENTE > DADOS DA OBRA > PRODUTOS > MATERIAIS > PATRIMONIOS > FUNCIONARIOS
include("restrito.php"); 

include_once("../model/class_sql.php");
include("../model/class_grupo_bd.php");

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

	function buscar(){
          var nome = document.getElementById("nome").value;
          var url = '../ajax/ajax_buscar_clientes.php?nome='+nome;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
          	
            $('#form-input-select').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       
    }
    function selecionaCliente(id){
          var url = '../ajax/ajax_buscar_dados_cliente.php?id='+id;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
            
            $('#form-input-dados').html(dataReturn);  //coloco na div o retorno da requisicao
          });
    }
</script>

<body>	
			<?php include_once("../view/topo.php"); ?>

			
            <div class="formulario" style="width:43%;">
              <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">NOVA OBRA</span></div></div>
              <?php 
                    if(isset($_GET['t']) && $_GET['t'] == 'c'){
                        unset($_SESSION['obra']);
                    }
               ?>
            <?php if(isset($_GET['t']) && $_GET['t'] == 'a_c_o'){// add clientes da obra?>
            	              
                       <form  action="add_obra.php" onsubmit="return validate(this)">
                        
                              <input type="hidden" id="t" name="t" value="a_d_o">
                              <!-- <div class="situacao">                                  
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                              </div> -->
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                              		<div class="title-bloco">Cliente/ Obra</div>
                                  <div class="desc-bloco">
                                      <span>Selecione o cliente </span>

                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <span><b>Nome/ Razao Social: </b></span><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:65%"> <input type="button" value="Buscar" onclick="buscar()">
                                          </div>
                                          <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; height:200px;">
                                              <select size="10" style="height: 100%; width: 100%">
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-input right">
                                          <div class="form-input">
                                              <span><b>Dados do cliente selecionado: </b></span>
                                          </div>
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb; height:200px; padding: 10px;">
                                              <input type="hidden" name="id_cli" value="<?php (isset($_SESSION['obra']['cliente']['id_cli']))?print $_SESSION['obra']['cliente']['id_cli']:''; ?>">
                                              <span><b>Nome/ Razao Social:</b></span><input readonly  name="nome_cli" id="nome_cli" type="text" style="border: 0; width: 100%; height: 20px;" value="<?php (isset($_SESSION['obra']['cliente']['nome_cli']))?print $_SESSION['obra']['cliente']['nome_cli']:''; ?>"><br />
                                              <span><b>CPF/ CNPJ:</b></span><input readonly  name="cpf_cnpj_cli" id="cpf_cnpj_cli" type="text" style="border: 0; width: 100%; height: 20px;" value="<?php (isset($_SESSION['obra']['cliente']['cpf_cnpj_cli']))?print $_SESSION['obra']['cliente']['cpf_cnpj_cli']:''; ?>"><br />
                                              <span><b>Endereço:</b></span><input style="border: 0px; width: 100%;height: 20px;" readonly  name="rua" id="rua" type="text" value="<?php (isset($_SESSION['obra']['cliente']['rua']))?print $_SESSION['obra']['cliente']['rua']:''; ?>"><br />
                                              <span><b>Nº:</b></span><input style="border: 0px; width: 100%; height:20px;" readonly  name="num" id="num" type="text" style="border: 0; width:100%; height: 20px;"value="<?php (isset($_SESSION['obra']['cliente']['num']))?print $_SESSION['obra']['cliente']['num']:''; ?>"><br />
                                              <span><b>Telefone:</b></span><input style="border: 0px; width: 100%; height:20px;" readonly  name="telefone_com" id="telefone_com" type="text" style="border: 0; width:100%"value="<?php (isset($_SESSION['obra']['cliente']['telefone_com']))?print $_SESSION['obra']['cliente']['telefone_com']:''; ?>"><br />
                                          </div>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px;text-align:center">
                                         <input type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                              <div class="form-input">
                                    <div class="buttons">
                                        <!-- <input type="submit" name="button" class="button" id="button" value="cadastrar"> --> <input type="button" name="button" class="button" onclick="window.location.href='add_obra.php?t=c'" id="button" value="Cancelar">
                                    </div>
                              </div>
                       </form>          
                       
            <?php }else if(isset($_GET['t']) && $_GET['t'] == 'a_d_o'){ //add dados da obra?>
                      <form  action="add_obra.php" onsubmit="return validate(this)">
                               <input type="hidden" id="t" name="t" value="a_p_o">
                              <?php
                                  $_SESSION['obra']['cliente']['id_cli'] = $_GET['id_cli'];
                                  $_SESSION['obra']['cliente']['nome_cli'] = $_GET['nome_cli'];
                                  $_SESSION['obra']['cliente']['cpf_cnpj_cli'] = $_GET['cpf_cnpj_cli'];
                                  $_SESSION['obra']['cliente']['rua'] = $_GET['rua'];
                                  $_SESSION['obra']['cliente']['num'] = $_GET['num'];
                                  $_SESSION['obra']['cliente']['telefone_com'] = $_GET['telefone_com'];
                                  
                               ?>
                              
                              <!-- <div class="situacao">                                  
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                              </div> -->
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  <div class="title-bloco">Dados da obra</div>
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
                                          <span>Descricão:</span><br /><textarea type="text" placeholder="Descreva os principais detalhes da obra..." name="desc" id="desc"  style="width:90%; max-width:90%; max-height: 100px"><?php (isset($_SESSION['obra']['dados']['desc']))?print $_SESSION['obra']['dados']['desc']:'' ?></textarea>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px;text-align:center">
                                           <input type="button"  onclick="javascript:window.history.back()" value="Voltar"> <input type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_obra.php?t=c'" id="button" value="Cancelar">
                              </div>
                       </form>
			
			      <?php }else if(isset($_GET['t']) && $_GET['t'] == 'a_p_o'){ //add patrimonios da obra?>
                      <form  action="add_obra.php" onsubmit="return validate(this)">
                               <input type="hidden" id="t" name="t" value="a_p_o">
                              <?php
                                  $_SESSION['obra']['dados']['nome'] = $_GET['nome'];
                                  $_SESSION['obra']['dados']['data_inicio_previsto'] = $_GET['data_inicio_previsto'];
                                  $_SESSION['obra']['dados']['rua'] = $_GET['rua'];
                                  $_SESSION['obra']['dados']['num'] = $_GET['num'];
                                  $_SESSION['obra']['dados']['desc'] = $_GET['desc'];
                                  
                               ?>
                              
                              <!-- <div class="situacao">                                  
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                              </div> -->
                              <div class="bloco-1" id="dados_obra">            
                                  <!-- <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div> -->
                                  <div class="title-bloco">Produtos/Obra</div>
                                  <div class="desc-bloco">
                                      <span>Selecione os Patrimonios </span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input left">
                                          <div class="form-input">
                                              <span><b>Nome: </b></span><br /><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:65%"> <input type="button" value="Buscar" onclick="buscar()">
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
                                          <div class="form-input" id="form-input-dados" style="border: 1px solid#bbb; height:200px; padding: 10px;">
                                              
                                          </div>
                                      </div>
                                      
                                      <div class="form-input" style="margin: 10px;text-align:center">
                                         <input type="button"  onclick="javascript:window.history.back()" value="Voltar"> <input type="submit" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                             
                              <div class="buttons" style="text-align:center">
                                  <input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_obra.php?t=c'" id="button" value="Cancelar">
                              </div>
                       </form>
      
            <?php } ?>

	 	    </div>
         <div class="formulario" style="width:43%;">
            <div class="bloco-1">
                <div class="form-input"><h3>Dados do cadastramento</h3></div>
                <div class="body-bloco">
                  <?php if(isset($_SESSION['obra']['cliente'])){?>
                        <div class="form-input" style="border-bottom: 1px solid#aaa">
                              <span style="margin-left:10px;"><b>Cliente</b></span>
                        </div>
                        <div class="form-input" style="padding: 0px 0px 5px 10px;">
                            <span><b>Nome/Razão Social: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['nome_cli']))?print $_SESSION['obra']['cliente']['nome_cli']:''; ?>"><br />
                            <span><b>CPF/CNPJ: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['cpf_cnpj_cli']))?print $_SESSION['obra']['cliente']['cpf_cnpj_cli']:''; ?>"><br />
                            <span><b>Endereço: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['rua']))?print $_SESSION['obra']['cliente']['rua']:''.(isset($_SESSION['obra']['cliente']['num']))?print ', '.$_SESSION['obra']['cliente']['num']:''; ?>"><br />
                            <span><b>Telefone: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['cliente']['telefone_com']))?print $_SESSION['obra']['cliente']['telefone_com']:''; ?>"><br />
                        </div>
                    <?php } ?>
                    <?php if(isset($_SESSION['obra']['dados'])){?>
                        <div class="form-input" style="border-bottom: 1px solid#aaa">
                              <span style="margin-left:10px;"><b>Dados da Obra</b></span>
                        </div>
                        <div class="form-input" style="padding: 0px 0px 10px 10px;">
                            <span><b>Nome: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['dados']['nome']))?print $_SESSION['obra']['dados']['nome']:''; ?>"><br />
                            <span><b>Data Inicio: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['dados']['data_inicio_previsto']))?print $_SESSION['obra']['dados']['data_inicio_previsto']:''; ?>"><br />
                            <span><b>Endereço: </b></span><input readonly   type="text" style="border: 0" value="<?php (isset($_SESSION['obra']['dados']['rua']))?print $_SESSION['obra']['dados']['rua']:''.(isset($_SESSION['obra']['dados']['num']))?print ', '.$_SESSION['obra']['dados']['num']:''; ?>"><br />
                            <span><b>Descrição: </b></span><br /><textarea style="resize:none; padding: 1px 0px 2px 10px;width:90%; height: 50px; border: 0" readonly><?php (isset($_SESSION['obra']['dados']['desc']))?print $_SESSION['obra']['dados']['desc']:''; ?></textarea>
                        </div>
                   <?php } ?>
                </div>
            </div>
         </div>
	 	    <?php //include("informacoes_grupo.php") ?> 
	 		
</body>
</html>