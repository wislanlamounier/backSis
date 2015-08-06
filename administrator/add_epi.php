<?php
include("restrito.php");

include_once("../model/class_sql.php");
include_once("../model/class_epi_bd.php");
include_once("../model/class_empresa_bd.php");

function validate(){
   if(!isset($_POST['epi']) || $_POST['epi'] == ""){
         return false;
   }
   if(!isset($_POST['desc']) || $_POST['desc'] == ""){
         return false;
   }
   return true;
}

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
   
</script>
<head>
   <title>Adicionar</title>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="../administrator/style.css">

   
</head>
<body>
     
    <div id="content">
            <?php include_once("../view/topo.php"); ?>                                   
            <div class="formulario">             
             <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){ ?>
                    <?php 
                        $id = $_GET['id'];
                        $Epi = new Epi();
                        $Epi = $Epi->get_epi_by_id($id);
                        $nome_epi = $Epi->nome_epi;
                        $descricao = $Epi->descricao;
                        $id_empresa = $Epi->id_empresa;
                                               
                      ?>


                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR EPI</span></div></div>
                 <form method="POST" id="add_epi" action="add_epi.php" onsubmit="return validate(this)">
                          <input type="hidden" id="tipo" name="tipo" value="editar">
                          <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                          <table border="0" >
                           <tr><td><span>EPI(nome):</span></td><td><input type="text" name="epi" id="epi" value="<?php echo $nome_epi ?>" </td></tr>
                           <tr><td><span>Descricão:</span></td><td><input type="text" name="desc" id="desc" value="<?php echo $descricao ?>" ></td></tr>
                           <tr><td><span>Empresa:</span></td><td><input type="numeric" name="empresa" id="empresa" value="<?php echo $id_empresa ?>" ></td></tr>
                           <tr><td colspan="3"><input style="width:80px;"type="submit" name="button" id="button" value="Editar"> <input style="width:80px;" name="button" onclick="window.location.href='edita_epi.php'" id="button" value="Cancelar"></td> </tr>
                           </table> 
                       </form>              
               <?php }else{ ?>                
               <form method="POST" class="ad_epi" id="ad_epi" name="ad_epi" action="add_epi.php" onsubmit="return validate(this)">
                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRO DE EPI</span></div></div>
                <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                  <table border="0">
                   <tr><td><td><span>EPI(nome):</span></td> <td><input type="text" name="epi" id="epi" ></td></tr>
                   <tr><td><td><span>Descricão:</span></td><td><input type="text" name="desc" id="desc"></td></tr>
                    <tr><td><td><span>Empresa:</span></td></td>
                        <td>
                           <?php //buscar array de Epi
                              $empresa = new Empresa();
                              $empresas = $empresa->get_all_empresa();
                           ?>
                           <select name="empresa" id="empresa">
                              <option value="no_sel">Selecione</option>
                              <?php 
                                 foreach($empresas as $key => $empresa){
                                    echo '<option value="'.$empresas[$key][0].'">'.$empresas[$key][2].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                        </tr>                 
                   <tr><td colspan="3"><input style="width:80px;"type="submit" name="button" id="button" value="cadastrar"> <input style="width:80px;" name="button" onclick="window.location.href='add_epi.php'" id="button" value="Cancelar"></td></tr>
                  </table>
               </form>              
               <?php }?>               
               <?php 
                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                  if(validate()){
                     $epi = new Epi();
                     $epi->add_epi($_POST['epi'], $_POST['desc'],  $_POST['empresa']);
                     // echo $exame->printExames();
                     if($epi->add_epi_bd()){
                        echo '<div class="msg">Cadastrado com sucesso!</div>';
                     }else{
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     }

                  }
                }else{
                  if(isset($_POST['tipo']) && $_POST['tipo'] == "editar"){                    
                          if(isset($_POST['id'])){
                            if(validate()){

                              $epi = new Epi();
                              if($epi->atualiza_epi($_POST['epi'], $_POST['desc'],  $_POST['id'], $_POST['empresa'])){
                                 echo '<div class="msg">Atualizado com sucesso!</div>';
                              }else{
                                 echo '<div class="msg">Falha na atualização!</div>';
                              }
                              
                            }//fim validade
                          }//fim ifisset                         
                         }//fim if
                       }//fimelse
                 ?>
            </div>
            <?php include_once("informacoes_epi.php"); ?>       
   </div>

</body>
</html>




