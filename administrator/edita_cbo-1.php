
<?php
include('restrito.php');

include_once("../model/class_funcionario_bd.php");
include_once("../model/class_horarios_bd.php");
include_once("../model/class_turno_bd.php");
include_once("../model/class_sql.php");
include_once("../model/class_filial_bd.php");
include_once("../model/class_cbo_bd.php");
include_once("../model/class_cidade_bd.php");
include_once("../model/class_estado_bd.php");
include_once("../model/class_exame_bd.php");
include_once("../model/class_cboXexames.php");
include_once("../model/class_endereco_bd.php");
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
   <title>Editar</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
   

              
               <?php include_once("../view/topo.php"); ?>           
         <div class="formulario">
                
               <h1>Editar Classificação Brasileira de Ocupações - CBO</h1>
               <?php if(isset($_GET['verificador']) && $_GET['verificador'] == 1){ //se verificador estiver setado e for igual a 1 carregara os campos preenchidos?>
                     
                     <?php 
                        $id = $_GET['id'];
                        $cbo = new Cbo();
                        $cbo = $cbo->get_cbo_by_id($id);
                        $codigo = $cbo->codigo;
                        $descricao = $cbo->descricao;
                        
                      ?>

                     <form method="POST" id="add_cbo" action="edita_cbo.php" onsubmit="return validate(this)">
                        <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                        <table border="0" >
                           <!-- <tr> <td><span>Descrição:</span></td> <td ><input type="text" id="desc" name="desc" style="width:100px;"></td><td><span style="font-size:12px; color:#555;">(Ex. de descrição: Das 8:00 às 12:00 e das 13:00 às 18:00)</span></td></tr> <!- nome -->
                           <tr> <td ><span>Codigo:</span></td> <td><input type="text" id="codigo" name="codigo" value="<?php echo $codigo; ?>"></td></tr> <!-- ini exp -->
                           <tr> <td ><span>Descrição:</span></td> <td><input type="text" id="descricao" name="descricao" value="<?php echo $descricao; ?>"></td></tr> <!-- ini exp -->
                           <tr><td colspan="2"><span>Selecione os exames necessários para essa função:</span></td></tr>
                           <tr>
                              <td colspan="2">
                                 <!-- <select id="exames" name="exames[]" size="5" multiple style="width:270px"> -->
                                    <?php
                                       $exame = new Exame();
                                       $exames = $exame->get_name_all_exames();
                                       
                                       for ($i=0; $i < count($exames); $i++) { 
                                          $data[$i] = array("id"=>$exames[$i][0], "name"=>$exames[$i][1]);
                                       }
                                       $exames_cbo = $cbo->get_exames_cbo($cbo->id);
                                       $data_selected = array();
                                       for ($i=0; $i < count($exames_cbo); $i++) { 
                                          $data_selected[$i] = array("id"=>$exames_cbo[$i][0], "name"=>$exames_cbo[$i][1]);
                                       }
                                       $aux=0;
                                       $aux_temp=0;
                                       $temp = array();
                                       for($i=0; $i < count($exames); $i++){
                                         
                                          for($y=0; $y < count($data_selected); $y++){
                                            
                                            if($exames[$i][0] == $data_selected[$y]["id"]){
                                              
                                              $aux++;
                                            }
                                          }
                                          if($aux == 0){
                                            
                                            $temp[$aux_temp]["id"] = $exames[$i][0];
                                            $temp[$aux_temp]["name"] = $exames[$i][1];
                                            $aux_temp++;
                                          }
                                          $aux=0;
                                          
                                       }
                                       $data = $temp;
                                       RendDoubleSelect::showDoubleDropDown($data, $data_selected, "id", "name", "", 
                                              "sel_exames1", "sel_exames2", "hd_exames", "130px", 
                                             "Exames", "Selecionados");
                                     ?>
                                 <!-- </select> -->
                              </td>
                           </tr>

                           <tr><td colspan="3"><input style="width:80px;"type="submit" onclick="selectAll()" name="button" id="button" value="Editar"> <input style="width:80px;" name="button" onclick="window.location.href='edita_cbo.php'" id="button" value="Cancelar"></td> </tr>
                        </table>
                     </form>
                    
               <?php }else{ ?>
                    <form method="POST" class="search_func" id="search_func" name="search_func" action="edita_cbo.php">
                         <table>
                           <tr>
                              <td><span >Código ou Descrição: </span></td>
                              <td><input type="text" id="name_search" name="name_search" title="Digite o código ou a descrição para pesquisar"></td>
                              <td><input type="submit" value="Buscar"></td>
                           </tr>
                        </table>
                      </form>
                      <?php 
                          if(isset($_POST['id'])){
                            if(validate()){
                              $cbo = new Cbo();
                              $cbo_x_exames = new CboXexames();
                              $array_id_exames =  array();
                              if($cbo->atualiza_cbo($_POST['id'], $_POST['codigo'], $_POST['descricao'])){
                                 if(isset($_POST['sel_exames2']))
                                    $array_id_exames = $_POST['sel_exames2'];

                                 if($cbo_x_exames->atualiza_cbo_x_exames($_POST['id'], $array_id_exames)){
                                    echo '<div class="msg">Atualizado com sucesso!</div>';
                                 }

                              }else{
                                 echo '<div class="msg">Falha na atualização!</div>';
                              }
                              
                            }
                          }
                         ?>

               <?php } ?>
               <?php
                     if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                        $cbo = new Cbo();
                        $cbos = $cbo->get_cbo_by_codigo_and_desc($_POST['name_search']);
                          echo '<table class="exibe_func">';
                          foreach($cbos as $key => $cbo){
                             echo '<tr>
                                      <td><a href="edita_cbo.php?verificador=1&id='.$cbos[$key][0].'">'.$cbos[$key][1]." ".$cbos[$key][2].'</a></td></tr>';
                          }
                          echo '</table>';
                     }
                     
                  ?>
            </div>         
    
</body>
</html>