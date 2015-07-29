<?php
include("restrito.php");


 include_once("../model/class_funcionario_bd.php");
 include_once("../model/class_horarios_bd.php");
 include_once("../model/class_turno_bd.php");
 include_once("../model/class_sql.php");
 include_once("../model/class_filial_bd.php");
 include_once("../model/class_cbo_bd.php");
 include_once("../model/class_cidade_bd.php");
 include_once("../model/class_estado_bd.php");
 include_once("../model/class_endereco_bd.php");
 include_once("../model/class_periodicidade_bd.php");
 include_once("../model/class_exame_bd.php");

function validate(){
   if(!isset($_POST['descricao']) || $_POST['descricao'] == ""){
         return false;
   }
   if(!isset($_POST['period']) || $_POST['period'] == "no_sel"){
         return false;
   }
   return true;
}

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
   function validate(f){
      var erros=0;
      for(i=0; i < f.length; i++){
        if(f[i].name == "descricao"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "period"){
            if(f[i].value == "no_sel"){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
      }
      if(erros>0){
         return false;
      }else{
         return true;
      }
   }
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
               <h1>Adicionar exame</h1>
               <?php 
                  if(validate()){
                     $exame = new Exame();
                     $exame->add_exame($_POST['descricao'], $_POST['period']);
                     // echo $exame->printExames();
                     if($exame->add_exame_bd()){
                        echo '<div class="msg">Cadastrado com sucesso!</div>';
                     }else{
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     }

                  }
               ?>
               <form method="POST" class="ad_exame" id="ad_exame" name="ad_exame" action="add_exames.php" onsubmit="return validate(this)">
                  <table border="0">
                     <!-- <tr> <td><span>Descrição:</span></td> <td ><input type="text" id="desc" name="desc" style="width:100px;"></td><td><span style="font-size:12px; color:#555;">(Ex. de descrição: Das 8:00 às 12:00 e das 13:00 às 18:00)</span></td></tr> <!- nome -->
                     <tr> <td ><span>Descrição:</span></td> <td><input type="text" id="descricao" name="descricao"></td></tr> <!-- ini exp -->
                     <tr>
                        <td ><span>Periodicidade:</span></td>
                        <?php 
                            $periodo = new Periodicidade();
                            $periodos = $periodo->get_name_all_periodo();
                         ?>
                        <td>
                           <select name="period" id="period">
                              <option value="no_sel">Selecione a periodicidade</option>
                              <?php
                                 for($aux=0; $aux < count($periodos); $aux++) {
                                       echo '<option value="'.$periodos[$aux][0].'">'.$periodos[$aux][1]. ' Dias</option>';
                                 } 
                              ?>
                           </select>
                        </td>
                     </tr>
                     
                     <tr><td colspan="3"><input style="width:80px;"type="submit" name="button" id="button" value="Cadastrar"></td> </tr>
                  </table>
               </form>
            </div>
         
      
   </div>
</body>
</html>