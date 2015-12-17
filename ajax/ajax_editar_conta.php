<?php
session_start();
include_once("../includes/functions.php");
include_once("../model/class_cliente.php");
include_once("../model/class_conta_bd.php");


    if(isset($_FILES['arquivo']) && $_FILES['arquivo']['name'] != '' ){
          $nome_comprovante = 'comprovante-' .$_FILES['arquivo']['name']; 
          $id = $_POST['id'];
          $uploaddir = "../images/".$_SESSION['id_empresa']."/comprovantes/".$id."/comprovante-";
          if(isset($_FILES['arquivo'])){
                        $uploadfile = $uploaddir . basename($_FILES['arquivo']['name']);
                        echo '<pre>';
            if(is_dir($uploaddir)){                
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile);
                 }else{
                    mkdir($uploaddir); 
                    move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploadfile);
                     
                 }
             }
        }
        
        
        if(isset($_POST['editar'])){
        
            $id = $_POST['id'];            
            $conta = new Contas();               
            $conta->add_comprovante($id,$nome_comprovante);
            echo '<script>window.location = "../administrator/add_contas"</script>'; 
        }    
        
        
    if(!isset($_POST['editar'])){        
        foreach ($_POST as $key => $value) {                    
                    if($key == 'data'){
                        $data = $value;;
                    }
                    if($key == 'id'){
                        $id = $value;
                    }
                    if($key == 'arquivo'){

                      } 

            }    
              
                if(isset($id) && isset($data)){
                    $conta = new Contas();  
                    $qtd_pagas = $_POST['qtd_pagas'];
                    $parcelas = $_POST['parcelas'];
                    $conta->set_conta_paga($id,$qtd_pagas, $data, $nome_comprovante, $parcelas);
                    echo '<script>window.location = "../administrator/add_contas"</script>';  
                }
    }            
    if(isset($_GET['tipo'])){
    ?> 
<div id="visualizar-conta">
        <?php Functions::getPaginacao();?>
      <?php
                    if($_GET['tipo'] == 'apagar'){
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_apagar(); 
                    empty($conta)? print "<div class='msg' id='visualizar-conta'>Nâo foi encontado nenhum resultado para sua pesquisa</div>" : '';
                    }
                    
                    if($_GET['tipo'] == 'areceber'){
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_areceber();
                    empty($conta)? print "<div class='msg' id='visualizar-conta'>Nâo foi encontado nenhum resultado para sua pesquisa</div>" : '';
                    }
                    
                    if($_GET['tipo'] == 'buscarrecebidias'){                        
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_recebidas();                   
                    empty($conta)? print "<div class='msg' id='visualizar-conta'>Nâo foi encontado nenhum resultado para sua pesquisa</div>" : '';
                    }
                    
                    if($_GET['tipo'] == 'buscarapagas'){                       
                    $contas = new Contas();                    
                    $conta = $contas->ver_contas_pagas();
                    empty($conta)? print "<div class='msg' id='visualizar-conta'>Nâo foi encontado nenhum resultado para sua pesquisa</div>" : '';
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
                                             <div class="item"><label>Cod: </label><label><?php echo $value->codigo  ?></label></div>
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
                                             <div class="item"><label>Obra: </label> <label><?php echo $value->obra ?></label></div>
                                        </div>
                                         
                                        <?php
                                        if(isset($value->status) && $value->status == 1 && isset($value->tipo) && $value->tipo == 1){ ?> 
                                        <div class="col-3">
                                            <div class="item"><label>Pago em: </label><label><?php echo $value->data_pagamento ?></label></div>
                                        </div>
                                        
                                           
                                                        <?php if($value->nome_comprovante != ""){ ?>
                                                        <div class="col-2"><input class="button" style="width: 100%;" type="button" value="Visualizar Comprovante" onclick="visualizaComprovante('<?php echo $value->nome_comprovante ?>','<?php echo $_SESSION['id_empresa'] ?>');"></div>
                                                        <?php }?>
                                                        <?php if($value->nome_comprovante == ""){ ?>
                                                        <form action="../ajax/ajax_editar_conta.php" method='POST' enctype="multipart/form-data" >
                                                            <input type="hidden" id="id" name="id" value="<?php echo $value->id ?>">
                                                            <input type="hidden" id="editar" name="editar" value="editar">
                                                                    <div class="item"><div class="col-3"><label>Adicionar comprovante: </label></div><div class="col-5"><input type="file" name="arquivo" id='arquivo'></div><div style="float:right" class="col-1"><input type="submit" class="button" id="salvar" value="salvar"></div></div>                    
                                                        </form>
                                                        <?php }?>
                                            
                         
                                        <?php } if(isset($value->status) && $value->status == 1 && isset($value->tipo) && $value->tipo == 2){?> 
                                        <div class="col-3">
                                            <div class="item"><label>Recebida em: </label><label><?php echo $value->data_pagamento ?></label></div>
                                        </div>
                                                        <?php if($value->nome_comprovante != ""){ ?>
                                                        <div class="col-2"><input class="button" style="width: 100%;" type="button" value="Visualizar Comprovante" onclick="visualizaComprovante('<?php echo $value->nome_comprovante ?>','<?php echo $_SESSION['id_empresa'] ?>');"></div>
                                                        <?php }?>
                                                        <?php if($value->nome_comprovante == ""){ ?>
                                                        <form action="../ajax/ajax_editar_conta.php" method='POST' enctype="multipart/form-data" >
                                                            <input type="hidden" id="id" name="id" value="<?php echo $value->id ?>">
                                                            <input type="hidden" id="editar" name="editar" value="editar">
                                                                    <div class="item"><div class="col-3"><label>Adicionar comprovante: </label></div><div class="col-5"><input type="file" name="arquivo" id='arquivo'></div><div style="float:right" class="col-1"><input type="submit" class="button" id="salvar" value="salvar"></div></div>                    
                                                        </form>
                                                        <?php }?>
                                        <?php } ?>   
                                         <div class="col-5">
                                            <div class="item"><label>Parcelas: <?php echo $value->parcelas ?></label></div>
                                        </div> 
                                        <div class="col-1">
                                            <div class="item">
                                                <label>Pagas: <?php echo $value->pagas ?></label>
                                            </div>                
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
                                        if(isset($value->status) && $value->status == 0 && isset($value->tipo) && $value->tipo == 1){?>
                                        <form action="../ajax/ajax_editar_conta.php" method='POST' enctype="multipart/form-data" >
                                            <input type="hidden" name="id" id="id" value="<?php echo $value->id; ?>">
                                            <input type="hidden" name="parcelas" id="parcelas" value="<?php echo $value->parcelas; ?>">
                                            <div class="row">                                                 
                                                <div style="margin-left: 0px; padding-top: 10px; padding-left: 20px; background-color: rgba(50,200,50,0.6);" class="center">   
                                                    
                                                     <div class="col-10"><div class="item"><label>Adicionar à contas pagas</label></div></div>
                                                     
                                                     <div class="col-3"><div class="item"><label>Data do pagamento:</label> <input type="date" name='data' id="data"></div></div>
                                                        <div class="col-2" style="width: 15%;">                                                     
                                                            <div class="item"><label>Parcelas: </label>                                                        
                                                                <select id="qtd_pagas" name="qtd_pagas">
                                                                            <?php
                                                                            for ($index = $value->pagas; $index <= $value->parcelas; $index++){
                                                                                    if($index > $value->pagas){
                                                                                    echo '<option value='.$index.'>'.$index.'</option>';
                                                                                     }
                                                                                }                                                           
                                                                            ?>
                                                                </select>
                                                                
                                                            </div>
                                                        </div> 
                                                        <div class="col-1">
                                                            <div class="item">
                                                                <label>Pagas: <?php echo $value->pagas ?></label>
                                                            </div>                
                                                        </div>
                                                     <div class="col-4"><div class="item"><label>Comprovante: </label><input type="file" name="arquivo" id='arquivo'></div></div>
                                                        <div class="col-10">
                                                            <div class="item">
                                                                <input type="submit" class="button" id="salvar" value="salvar">
                                                            </div>
                                                        </div>  
                                                     </div>
                                                
                                            </div>
                                        </form>
                                        <?php } if(isset($value->status) && $value->status == 0 && isset($value->tipo) && $value->tipo == 2){?>
                                       <form action="../ajax/ajax_editar_conta.php" method='POST' enctype="multipart/form-data" >
                                                 <input type="hidden" name="id" id="id" value="<?php echo $value->id; ?>">
                                            <div class="row">                                                
                                                <div style="margin-left: 0px; padding-top: 10px; padding-left: 20px; background-color: rgba(50,200,50,0.6);" class="center">
                                                    <div class="col-10">
                                                        <div class="item">
                                                            <label>Adicionar à contas recebidas</label>
                                                        </div>
                                                    </div>
                                                   <div class="col-2">
                                                       <div class="item">
                                                           <label>Data do pagamento: </label>
                                                       </div>
                                                   </div>
                                                   <div class="col-3">
                                                       <div class="item">
                                                           <input type="date" name='data' id="data">
                                                       </div>
                                                   </div>
                                                   <div class="col-5">
                                                       <div class="item">
                                                           <input type="file" name="arquivo" id='arquivo'>
                                                       </div>
                                                   </div>
                                                   <div class="col-10">
                                                       <div class="item">
                                                           <input type="submit" class="button" id="salvar" value="salvar">
                                                       </div>
                                                   </div>  
                                                </div>
                                            </div>
                                        </form>
                                       <?php } ?>                                  
                            </div>                        
                        </div>
                   
                       <?php } ?>
                   <div style="float: left;"><input type="button" class="button" value="Voltar" style="color: floralwhite" id="back"></div><div style="float:right"><input type="button" style="color: floralwhite" class="button" value="proximo" id="next"></div>
                   <?php    
                            
                            echo '<script>paginar('.$i.','.'2'.')</script>';
                     ?>
    </div>
    <?php
    }
   ?>