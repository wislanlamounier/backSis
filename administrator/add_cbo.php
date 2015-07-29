
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
include_once("../model/class_exame_bd.php");
include_once("../model/class_cboXexames.php");
include_once("../model/class_rend_double_select.php");

function validate(){
   if(!isset($_POST['codigo']) || $_POST['codigo'] == ""){
         return false;
   }
   if(!isset($_POST['descricao']) || $_POST['descricao'] == ""){
         return false;
   }
   return true;
}

?>
<html>

<script type="text/javascript">
     
   function selectAll(){
      var select = document.getElementById("sel_exames2");
      for(i=0; i<select.length; i++){
         select[i].selected = true;
      }
   }
   function validate(f){ 
      var erros=0;   
      for(i=0; i<f.length; i++){
         if(f[i].name == "codigo"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
         }
         if(f[i].name == "descricao"){
            if(f[i].value == ""){
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
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
   
</head>

<body>
   
   <?php include_once("../view/topo.php"); ?>
    
                   
            <div class="formulario">
               <h1>Adicionar Classificação Brasileira de Ocupações - CBO</h1>
               <form method="POST" id="add_cbo" action="add_cbo.php" onsubmit="return validate(this)">
                  <table border="0" >
                     <!-- <tr> <td><span>Descrição:</span></td> <td ><input type="text" id="desc" name="desc" style="width:100px;"></td><td><span style="font-size:12px; color:#555;">(Ex. de descrição: Das 8:00 às 12:00 e das 13:00 às 18:00)</span></td></tr> <!- nome -->
                     <tr> <td ><span>Codigo:</span></td> <td><input type="text" id="codigo" name="codigo"></td></tr> <!-- ini exp -->
                     <tr> <td ><span>Descrição:</span></td> <td><input type="text" id="descricao" name="descricao"></td></tr> <!-- ini exp -->
                     <tr><td colspan="2"><span>Selecione os exames necessários para essa função:</span></td></tr>
                     <tr>
                        <td colspan="2">
                           <!-- <select id="exames" name="exames[]" size="5" multiple style="width:270px"> -->
                              <?php
                                 $exame = new Exame();
                                 $exames = $exame->get_name_all_exames();
                                 $data = array();
                                 
                                 for ($i=0; $i < count($exames); $i++) { 
                                    $data[$i] = array("id"=>$exames[$i][0], "name"=>$exames[$i][1]);
                                 }

                                 $data_selected = array();  

                                 RendDoubleSelect::showDoubleDropDown($data, $data_selected, "id", "name", "", 
                                        "sel_exames1", "sel_exames2", "hd_exames", "130px", 
                                       "Exames", "Selecionados");
                               ?>
                           <!-- </select> -->
                        </td>
                     </tr>
                     <!-- <tr><td colspan="2"><span style="color:#898989">Segure Ctrl para múltiplas seleções</span></td></tr>   -->
                     <tr><td colspan="3"><input style="width:80px;"type="submit" onclick="selectAll()" name="button" id="button" value="Cadastrar">
                        <input style="width:80px;" name="button" onclick="window.location.href='logado.php'" id="button" value="Cancelar"></td> </tr>
                  </table>
               </form>
               <?php 
                  if(validate()){
                     
                     $cboXexames = new CboXexames();
                     $cbo = new Cbo();
                     $cbo->add_cbo($_POST['codigo'], $_POST['descricao']);
                     $id_cbo = $cbo->add_cbo_bd();// id do registro cadastrado
                     $id_exames = $_POST['sel_exames2'];

                     $cboXexames->add_cbo_x_exames($id_exames, $id_cbo);
                  }
               ?>
            </div>
         
  
   
</body>
</html>