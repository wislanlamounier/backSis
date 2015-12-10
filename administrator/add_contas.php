<?php
include("restrito.php");
include_once("../includes/functions.php");
include_once("../model/class_cliente.php");
include_once("../model/class_conta_bd.php");
?>
<style>
    .divisoes{
        float: left;
        clear: left;
    }
    
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#fp").click(function(){
        $("#formulario-apagar").fadeToggle();
        $("#fr").fadeToggle();
        $("#voltar2").fadeToggle();
    });
    $("#fr").click(function(){
        $("#formulario-areceber").fadeToggle();
        $("#fp").fadeToggle();
        $("#voltar1").fadeToggle();
    });
    
    
     $("#vr").click(function(){
        $("#visualizar-areceber").fadeToggle();
        $("#vp").fadeToggle();
        $("#voltar3").fadeToggle();
    });
        $("#vp").click(function(){
        $("#visualizar-apagar").fadeToggle();
        $("#vr").fadeToggle();
        $("#voltar4").fadeToggle();
    });
});
</script>


<html>
    <?php Functions::getHead('Adicionar');?>
    <?php Functions::getScriptContas();?>
    <?php Functions::getPaginacao();?>
  

    <body>
        <?php include_once("../view/topo.php"); ?>


            <div class='formulario' style="width:50%;">                
               <div class="title-box" style="float:left"><div style="float:left"><img src="../images/user_add.png" width="60px" style="margin-left:-20px; margin-top:-20px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRO DE CONTAS</span></div></div>
               
            <?php
            $contas = new Contas();
            
            
            if(isset($_POST['apagar_areceber']) && $_POST['apagar_areceber'] != "" ){
                
                foreach ($_POST as $key => $value) {                          

                             if($key == 'cod' && isset($value)){
                                $cod = $value;                                 
                             }
                             if($key == 'desc' && isset($value)){
                                $desc = $value;                                
                             }
                              if($key == 'select_fornecedor' && isset($value)){
                                $select_fornecedor = $value;                                
                             }
                               if($key == 'sem_fornecedor_cliente' && isset($value)){
                                $sem_fornecedor_cliente = 'Sem fornecedor ou cliente';                                
                             }
                               if($key == 'obra' && isset($value)){
                                $obra = $value;                                 
                             }
                               if($key == 'valor' && isset($value)){
                                $source = array('.', ',','R$');
                                $replace = array('', '.','');
                                $valor = str_replace($source, $replace, $value); //remove os pontos e substitui a virgula pelo ponto                                                              
                             }
                               if($key == 'multa' && isset($value)){
                                $source = array('.', ',','R$');
                                $replace = array('', '.','');
                                $multa = str_replace($source, $replace, $value);                              
                             }
                              if($key == 'banco' && isset($value)){
                                $banco = $value;                                
                             }                            
                               if($key == 'num_parcelas' && isset($value)){
                                $num_parcelas = $value;                                
                             }
                               if($key == 'data' && isset($value)){
                                $data = $value;                                
                             }
                                if($key == 'juros' && isset($value)){
                                $juros = $value;                                
                             } 
                               if($key == 'apagar_areceber' && isset($value)){
                                $tipo = $value;                                
                             }                              
                         } 
                         
                         if(isset($sem_fornecedor_cliente) && $sem_fornecedor_cliente != ""){
                             $id_fornecedor = $sem_fornecedor_cliente;
                         }else{
                            if(isset($_POST['select_fornecedor_cliente']))
                             $id_fornecedor = $_POST['select_fornecedor_cliente'];                             
                         }
                         
                        
                         if(isset($cod) && $cod != "" && isset($valor) && $valor != "" && isset($data) && $data != "" && isset($banco) && $banco != ""){
                         $contas->add_contas($cod, $desc, $id_fornecedor, $obra, $banco, $valor, $multa, $data, $num_parcelas, $juros, $tipo);                          
                         $contas->add_contas_bd();
                         }else {
                             
                             echo '<div class="msg">Por favor preencha os seguintes campos : <br>';
                             $err = 0;                            
                             
                             if($cod == ""){
                                 echo 'Codigo<br>';                                 
                             }
                             if($valor == ""){
                                 echo 'Valor<br>';
                             }
                             if($data == ""){
                                 echo 'Data<br>';
                             }
                             if($banco == ""){
                                 echo 'Banco<br>';
                             }
                         }
            }       
            ?>
        
               <div style="margin-top:50px; background-color:rgba(50,200,50,0.3); "><span style="font-family: sans-serif; font-size: 20pt;">Cadastrar Contas</span></div>
               <Nav style="padding:20px;">
                   <a hidden="on" id="voltar1" href="add_contas.php">Voltar</a> <a id="fp" href="#formulario-apagar">À pagar</a> | <a id="fr" href="#formulario-areceber">À receber</a><a hidden="on" id="voltar2" href="add_contas.php">Voltar</a>                  
               </nav>
                       
               <div hidden="on" id="formulario-apagar">
                   <div class="title"><h3>À Pagar</h3></div>
                   <form method="Post" action="add_contas.php">
                       
                       <input type="hidden" value="1" id="apagar_areceber" name="apagar_areceber">
                       
                       <table style="width:100%;">
                       <tr>
                           <td><span>Código:</span></td><td><input type="text" id="cod" name="cod"></td>
                           <td><span>Descrição:</span></td><td><textarea id="desc" name="desc"></textarea></td>
                       </tr>
                       <tr><td><span>Forncedor:</span></td><td>
                                  <select id="select_fornecedor" name="select_fornecedor_cliente"  style="width:100%" title="Selecione o fornecedor">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $fornecedor = new Cliente();
                                       $fornecedor = $fornecedor->get_all_fornecedor();
                                       for ($i=0; $i < count($fornecedor) ; $i++) { 
                                          echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select></td> 
                                 <td><span>Sem Fornecedor</span></td><td><input type="checkbox" id="sem_fornecedor_cliente" name='sem_fornecedor_cliente' type="fornecedor não consta no cadastrado"></td>
                       </tr>
                       <tr>
                           <td colspan="2"><span>Pagamento relacionado a obra:</span></td>
                            <td>
                        <select name='obra' id='obra'>
                           <option value='obrax'>Obra x</option> 
                            <option value='obray'>Obra y</option>
                        </select>
                            </td>
                       </tr>
                       <tr>
                            <td>
                           <span>Banco</span></td>
                            <td>
                                <input type="text" name='banco' id='banco' >                          
                            </td>
                            <td><span>Data do vencimento: </span></td>
                            <td><input type="date" name="data" id="data"></td>
                       </tr>
                       <tr>                                             
                           <td><span>Valor: </span></td>
                           <td><input onkeyup="mascara(this, mvalor);" type="text" name="valor" id="valor"></td>
                           <td><span>N° Parecelas: </span></td>
                           <td><input type="number" name='num_parcelas' id="num_parcelas"></td>
                       </tr>
                       <tr>
                           <td><span>Multa por Atraso:</span></td><td><input onkeyup="mascara(this, mvalor);" type="text" id="multa" name="multa"></td>
                           <td><span>Juros:</span></td><td><input type="number" id="juros" name="juros"></td><td>
                                                                                            <select style="width: 100px;">
                                                                                                <option value="mensal">Mensal</option>
                                                                                                <option value="anual">Anual</option>
                                                                                            </select></td>
                            
                       </tr>
                       
                       </table>
                       
                       <div  id="editar" hidden="on" style="margin:0 auto; margin-top:30px;">
                           <input type="hidden" type="atualizar" value="atualizar">
                           <input type="button" class="button" value="Cancelar"><input class="button" type="submit" value="Guardar">
                       </div>
                      
                       
                       <div id="adicionar" style="margin:0 auto; margin-top:30px;"><input type="button" class="button" value="Cancelar"><input class="button" type="submit" value="Guardar"></div>
                   </form>
              </div>
                
               <div hidden="on" id="formulario-areceber">
                   
                   <div class="title"><h3>À Receber</h3></div>
                   <form method="Post" action="add_contas.php">
                       
                       <input type="hidden" value="2" name="apagar_areceber" id="apagar_areceber">
                       
                       <table style="width:100%;">
                       <tr>
                           <td><span>Código:</span></td><td><input type="text" id="cod" name="cod"></td>
                           <td><span>Descrição:</span></td><td><textarea id="desc" name="desc"></textarea></td>
                       </tr>
                       
                        <tr><td><span>Cliente:</span></td><td>
                                  <select id="select_fornecedor" name="select_fornecedor_cliente"  style="width:100%" title="Selecione o fornecedor">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $fornecedor = new Cliente();
                                       $fornecedor = $fornecedor->get_all_cliente();
                                       for ($i=0; $i < count($fornecedor) ; $i++) { 
                                          echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select></td> 
                                 <td><span>Sem Cliente</span></td><td><input type="checkbox" name='sem_fornecedor_cliente' type="fornecedor não consta no cadastrado"></td>
                       </tr>
                       <tr>
                           <td colspan="2"><span>Pagamento relacionado a obra:</span></td>
                           <td style="width: 100px;">
                        <select name='obra' id='obra'>
                           <option value='obrax'>Obra x</option> 
                            <option value='obray'>Obra y</option>
                        </select>
                            </td>
                       </tr>
                     <tr>
                         <td>
                           <span>Banco</span></td>
                            <td>
                                <input type="text" name='banco' id='banco' >                          
                            </td>
                            <td><span>Data do vencimento: </span></td>
                            <td><input type="date" name="data" id="data"></td>
                       </tr>
                       <tr>                                             
                           <td><span>Valor: </span></td>
                           <td><input onkeyup="mascara(this, mvalor);" type="text" name="valor" id="valor"></td>
                           <td><span>N° Parecelas: </span></td>
                           <td><input type="number" name='num_parcelas' id="num_parcelas"></td>
                           
                           
                       </tr>
                       <tr>
                           <td><span>Multa por Atraso:</span></td><td><input onkeyup="mascara(this, mvalor);" type="number" id="multa" name="multa"></td>
                           <td><span>Juros:</span></td><td><input type="number" id="juros" name="juros"></td><td>
                                                                                            <select style="width: 100px;">
                                                                                                <option value="mensal">Mensal</option>
                                                                                               <option value="anual">Anual</option>
                                                                                            </select></td>
                            
                       </tr>
                       
                       </table>
                        <div id="editar" hidden="on" style="margin:0 auto; margin-top:30px;">
                             <input type="hidden" type="atualizar" value="atualizar">
                             <input type="button" class="button" value="Cancelar"><input class="button" type="submit" value="Guardar">
                         </div>
                        <div id="adicionar" style="margin:0 auto; margin-top:30px;"><input type="button" class="button" value="Cancelar"><input class="button" type="submit" value="Guardar"></div>
                   </form>
               </div>  
               <div id="ver_contas" style="background-color:rgba(50,200,50,0.3); "><span style="font-family: sans-serif; font-size: 20pt;">Ver Contas</span></div>
               <Nav style="padding:20px;">
                   <a hidden="on" id="voltar3"  href="add_contas.php">Voltar</a> <a id="vp" href="#ver_contas">À pagar</a> | <a id="vr" href="#ver_contas">À receber</a><a hidden="on" id="voltar4" href="add_contas.php">Voltar</a>                  
               </nav>
               <div id="visualizar-apagar" hidden>
                    <?php
                    $contas = new Contas();
                    
                     $contas_apagar = $contas->ver_contas_apagar();                     
                     $style1 = 'background-color: rgba(50,200,50,0.3);';
                     $i = 0;
                     ?>
                   <div class="title"><h3>À Pagar</h3></div>
                   <?php foreach ($contas_apagar as $key => $value) { 
                    $i++;
                    $clis = new Cliente();
                    $cli = $clis->get_all_cli_by_id($value->fornecedor_cliente);
                    if($cli[1]== ""){
                        $cli[1]= 'Fornecedor não cadastrado';
                    }
                   ?>
                   
                    
                   
                    <div id="contas" class="tabela-contas-apagar" style="<?php if($i % 2 == 1){echo $style1;}?>">
                        <div id="<?php echo $i ?>" >
                                <div class="row">                                     
                                    <div class="center">
                                         <div class="col-5">
                                             <div class="item"><label>Cod:</label>  <label><?php echo $value->codigo  ?></label></div>
                                         </div>
                                         <div class="col-5">
                                             <div class="item"><label>Fornecedor: </label> <label><?php echo $cli[1]; ?></label></div>
                                         </div>
                                         <div class="col-5">
                                             <div class="item"><label>Valor: </label> <label><?php echo $value->valor ?></label> </div>
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
                                            <div class="item"><textarea style="position:absolute; z-index: 200;" row="2" cols="50"> <?php echo $value->descricao ?> </textarea></div>
                                        </div>
                                     </div>
                                 </div>                        
                                 <div class="row">
                                     <div class="center">
                                         <br>
                                         <div class="col-3">Adicionar à contas pagas</div><div class="col-3"><div class="button" onclick="">Salvar</div></div>
                                     </div>
                                </div>
                            
                            </div>                        
                        </div>
                   
                       <?php } ?>
                   <input type="button" class="button" value="Voltar" style="color: floralwhite" id="back"><input type="button" style="color: floralwhite" class="button" value="proximo" id="next">
                   <?php 
                        if ($i > 2) {
                            echo '<script>paginar('.$i.','.'3'.')</script>';
                    } ?>
                   
               </div>              
              
               </div>

    </body>
</html>