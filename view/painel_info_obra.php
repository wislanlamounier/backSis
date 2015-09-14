<?php    // print_r($_SESSION['obra']['cliente']);
        if (isset($_SESSION['obra']['dados'])){
        $obras = $_SESSION['obra']['dados'];       
        }else{
          $obras['nome']="...";
          $obras['data_inicio_previsto']="...";
          $obras['desc']="...";
          $obras['rua']="...";
          $obras['num']="...";
          $obras['telefone_com']="...";
        }        
        if (isset($_SESSION['obra']['cliente'])){
        $cliente = $_SESSION['obra']['cliente'];       
        }else{
          $cliente['id_cli']="...";
          $cliente['nome_cli']="...";
          $cliente['cpf_cnpj_cli']="...";
          $cliente['rua']="...";
          $cliente['num']="...";
          $cliente['telefone_com']="...";
        }
        if(isset($_SESSION['obra']['funcionario'])){
        $funcionario = $_SESSION['obra']['funcionario'];       
        }else if(!isset($_SESSION['obra']['funcionario'])){          
            $funcionario[0] = "...";                
        }
        if (isset($_SESSION['obra']['patrimonio'])){
           for($aux = 0; $aux < 1; $aux++){
            // $_SESSION['obra']['patrimonio'][0]=1;
                                                             
          }                                      
        }
        
?>
<div class="painel-controle">
      
    
       
         <div class="colum">
          <div style="float:left;width:100%"><div style="float:left"><img src="../images/info.png" width="50px" style="margin-left:5px; margin-top:-20px;margin-left:-20px; "></div><div style="float:left; margin-top:10px; margin-left:10px; "><span style="width:120px" class="title"><b>Informações Obra</b></span></div></div>
            <div clas="msg-descricao"><span style="color: #003300;"> <b>Dados da Obra</b></span></div>
            <div class="descricao"><span>Nome: </span></div> <div class="descricao"><span type="text" id="nome" ><?php echo $obras['nome']?></span></div>
            <div class="descricao"><span>Data de Início: </span></div> <div class="descricao"><span type="text" id="data_inicio_previsto" ><?php echo $obras['data_inicio_previsto']?></span></div>
            <div class="descricao"><span>Data de Fim: </span></div> <div class="descricao"><span type="text" id="data_inicio_previsto" ><?php echo $obras['data_inicio_previsto']?></span></div>
            <div class="msg-descricao"><span style="color: #003300;float:left; margin-left:10;"><b>Funcionários</b></span></div>
            <div class="msg-descricao"><a style="font-size:14px; cursor:pointer" name="popup" onclick="exibe(this.name)" >Expandir</a></div>
            <div class="msg-descricao"><span style="margin-left:10; color: #003300;float:left;"><b>Patrimonio</b></span></div>
            <div class="msg-descricao"><a style="font-size:14px;cursor:pointer" name="popup-patrimonio" onclick="exibe(this.name)">Expandir</a></div>
            <div class="msg-descricao"><span style="color: #003300;"><b>Dados do cliente vinculado à obra</b></span></div>
            <div class="descricao"><span>Cliente: </span></div> <div class="descricao"><span type="text" id="rua" ><?php echo $cliente['nome_cli']?></span></div>
            <div class="descricao"><span>Telefone: </span></div> <div class="descricao"><span type="text" id="telefone_com"><?php echo $cliente['telefone_com']?></span></div>            
            <div class="descricao" style="border:0"><span>Descrição: </span><textarea readonly type="text" id="telefone_com" ><?php echo $obras['desc']?></textarea></div>
            
        </div>

</div>


<!-- popup -->
      <div id="popup" class="popup-painel" style="float:left">
                      <div class="descricao" style="border:0;" ><span>Nome </span></div>
                  <!-- eSTRUTURA DE REPETIÇÃO PARA ALIMENTAR OS NOMES E INFORMAÇÕES DO FUNCIONARIO -->
                  <?php  
                  if(isset($_SESSION['obra']['funcionario'])){
                   for($aux = 0; $aux < count($funcionario); $aux++){
                      
                    $res = Funcionario::get_func_id($funcionario[$aux]);          
                    ?>          
                            <div class="colum-funcionario"><input readonlytype="text" value="<?php  echo $res->nome; ?>"></div>
                            
                      <?php } ?>
                    <?php } ?>  
                            <tr><td><input onclick="fechar(this.name)" name="popup" type="button" class="button" style="clear: both; float:left; margin-top:10px;" value="Concluir"></td></tr>
                </div>


      <div id="popup-patrimonio" class="popup-painel" style="float:left">
          
       <?php  
        if (isset($_SESSION['obra']['patrimonio'])) {
           for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
                       $tipo_id_qtd = explode(':', $_SESSION['obra']['patrimonio'][$aux]);                                               
                                                 if($tipo_id_qtd[0] == 0){
                                                  $res = Patrimonio_geral::get_patrimonio_geral_id($tipo_id_qtd[1]);
                                                  echo '<div class="colum-funcionario"><input style="font-weight:bold" readonly type="text" value="Geral" > <input readonly type="text" value="'.$res->nome.'"></div>';                                                  
                                                 }else if($tipo_id_qtd[0] == 1){
                                                  $res = Maquinario::get_maquinario_id($tipo_id_qtd[1]);
                                                  echo '<div class="colum-funcionario"> <input style="font-weight:bold" readonly type="text" value="Maquinário" > <input readonly type="text" value="'.$res->modelo.'"></div>';
                                                 }else{
                                                  $res = Veiculo::get_veiculo_id($tipo_id_qtd[1]);
                                                  echo '<div class="colum-funcionario"><input style="font-weight:bold" readonly type="text" value="Veículo"> <input readonly type="text" value="'.$res->modelo.'"></div>';
                                                 }
                                               }
        }      
         ?>          
                 <tr><td><input onclick="fechar(this.name)" type="button" name="popup-patrimonio" class="button" style="clear: both; float:left; margin-top:10px;" value="Concluir"></td></tr>
      </div>
        <!-- fimpopup -->