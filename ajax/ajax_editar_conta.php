<?php
session_start();
include_once("../includes/functions.php");
include_once("../model/class_cliente.php");
include_once("../model/class_conta_bd.php");


    if(isset($_GET['pago']) && isset($_GET['id'])){
        $conta = new Contas();  
        $conta->set_conta_paga($_GET['id'], $_GET['data_pagamento']);
            echo '<script>window.location = "../administrator/add_contas"</script>';
                
    }
   
    if(isset($_GET['tipo'])){
    ?> 
<div id="visualizar-conta">
        <?php Functions::getPaginacao();?>
      <?php
                    if($_GET['tipo'] == 'apagar'){
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_apagar(); 
                    }
                    if($_GET['tipo'] == 'areceber'){
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_areceber();     
                    }
                    if($_GET['tipo'] == 'buscarrecebidias'){                   
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_recebidas();     
                    }
                    if($_GET['tipo'] == 'buscarapagas'){
                       
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_pagas();     
                    }
                    
                    $style1 = 'background-color: rgba(50,200,50,0.3);';
                    $i = 0;
                    ?>
                   
                   <?php foreach ($conta as $key => $value) { 
                    $i++;
                    $clis = new Cliente();
                    $cli = $clis->get_all_cli_by_id($value->fornecedor_cliente);
                    if($cli[1]== ""){
                        $cli[1]= 'Fornecedor não cadastrado';
                    }
                   ?>
                    
                    <div id="contas" class="tabela-contas-apagar" style="<?php  if($i % 2 == 1){echo $style1;} ?> ">
                        <div  id="<?php echo $i ?>" >
                            <input type="hidden" id="id" name="id" value="<?php echo $value->id ?>">
                                <div  class="row">                                     
                                    <div  class="center">
                                         <div class="col-5">
                                             <div class="item"><label>Cod:</label>  <label><?php echo $value->codigo  ?></label></div>
                                         </div>
                                         <div class="col-5">
                                             <div class="item"><label>Fornecedor: </label> <label><?php echo $cli[1]; ?></label></div>
                                         </div>
                                         <div class="col-5">
                                             <div class="item"><label>Valor: </label> <label><?php echo'R$ ' . number_format($value->valor, 2, ',', '.') ?></label> </div>
                                         </div>     
                                          <div class="col-3">
                                             <div class="item"><label>Juros: </label> <label><?php echo $value->juros.'('.$value->periodo_juros.')'; ?></label> </div>
                                         </div>
                                        
                                    </div>
                                </div>
                                 <div class="row">
                                     <div class="center">
                                         <div class="col-5">
                                             <div class="item"><label>Data de vencimento: </label> <label><?php echo $value->data_vencimento ?></label></div>
                                        </div>
                                         <div class="col-5">
                                             <div class="item"><label>Banco: </label> <label><?php echo $value->banco ?></label></div>
                                        </div>
                                         <div class="col-5">
                                            <div class="item"><label>Descrição: </label></div>
                                        </div>  
                                        <div class="col-10">
                                            <div class="item"><textarea style="position:relative; z-index: 200;" row="2" cols="50"> <?php echo $value->descricao ?> </textarea></div>
                                        </div>
                                     </div>
                                 </div>
                                        <?php
                                        if(isset($value->status) && $value->status == 0){ ?>
                                             <div class="row">
                                                <div class="center">                                                    
                                                    <div class="col-3">Adicionar à contas pagas</div><div class="col-3">Data do pagamento: <input type="date" id="<?php echo $value->id.'data_pagamento' ?>"> </div><div class="col-3"><input type="button" class="button" id="salvar" value="salvar" onclick="addContaPaga(<?php echo $value->id ?>)"></div>
                                                </div>
                                           </div>
                                       <?php } ?>  
                                
                            
                            </div>                        
                        </div>
                   
                       <?php } ?>
                   <div style="float: left;"><input type="button" class="button" value="Voltar" style="color: floralwhite" id="back"></div><div style="float:right"><input type="button" style="color: floralwhite" class="button" value="proximo" id="next"></div>
                   <?php    
                            
                            echo '<script>paginar('.$i.','.'4'.')</script>';
                     ?>
    </div>
    <?php
    }
   ?>