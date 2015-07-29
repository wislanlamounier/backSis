
<?php
include ("restrito.php");

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
include_once("../model/class_periodicidade_bd.php");

function validate(){
   
   if(!isset($_POST['descricao']) || $_POST['descricao'] == ""){
         return false;
   }
   if(!isset($_POST['periodo']) || $_POST['periodo'] == "no_sel"){
         return false;
   }
   return true;
}

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
    function carregaPeriodo(per){
      var combo = document.getElementById("periodo");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == per)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
    
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
        if(f[i].name == "periodo"){
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
   <title>Editar</title>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body> 

   
    <?php include_once("../view/topo.php"); ?>
      <div class="formulario">         
               <h1>Editar exames</h1>
               <?php if(isset($_GET['verificador']) && $_GET['verificador'] == 1){ //se verificador estiver setado e for igual a 1 carregara os campos preenchidos?>
                     
                     <?php 
                      $id = $_GET['id'];
                      $exame = new Exame();
                      $exame = $exame->get_exame_id($id);
                      $id = $exame->id;
                      $descricao = $exame->descricao;
                      $id_periodicidade = $exame->id_periodicidade;
                       ?>
                       <form method="POST" id="add_cbo" action="edita_exames.php" onsubmit="return validate(this)">
                          <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                          <table border="0" >
                             <!-- <tr> <td><span>Descrição:</span></td> <td ><input type="text" id="desc" name="desc" style="width:100px;"></td><td><span style="font-size:12px; color:#555;">(Ex. de descrição: Das 8:00 às 12:00 e das 13:00 às 18:00)</span></td></tr> <!- nome -->
                             <!-- <tr> <td ><span>ID:</span></td> <td> <span> <?php echo $id ?> </span> </td></tr> <!- ini exp -->
                             <tr> <td ><span>Descrição:</span></td> <td><input type="text" id="descricao" name="descricao" value="<?php echo $descricao; ?>"></td></tr> <!-- ini exp -->
                             <tr>
                                <td><span>Periodicidade:</span></td>
                                <td>
                                   <select id="periodo" name="periodo">
                                        <option value="no_sel">Selecione a periodicidade</option>
                                        <?php
                                          $periodicidade = new Periodicidade();
                                          $periodos = $periodicidade->get_name_all_periodo();
                                          for ($i=0; $i < count($periodos); $i++) { 
                                            echo '<option value="'.$periodos[$i][0].'">'.$periodos[$i][1].'</option>';
                                          }
                                         ?>
                                  </select> <span> dias</span>
                                </td>
                                <?php echo "<script> carregaPeriodo('".$id_periodicidade."') </script>";  ?>
                             </tr>
                             <tr><td colspan="3"><input style="width:80px;"type="submit" name="button" id="button" value="Editar"> <input style="width:80px;" name="button" onclick="window.location.href='edita_exames.php'" id="button" value="Cancelar"></td> </tr>
                          </table>
                       </form>
                    
               <?php }else{ ?>
                    <form method="POST" class="search_func" id="search_func" name="search_func" action="edita_exames.php">
                         <table>
                           <tr>
                              <td><span >Descrição: </span></td>
                              <td><input type="text" id="name_search" name="name_search" title="Digite o código ou a descrição para pesquisar"></td>
                              <td><input type="submit" value="Buscar"></td>
                           </tr>
                        </table>
                      </form>
                      <?php 
                          if(isset($_POST['id'])){
                            if(validate()){
                              $exame = new Exame();
                              if($exame->atualiza_exame($_POST['descricao'], $_POST['periodo'], $_POST['id'] ) ){
                                 echo '<div class="msg">Atualizado com sucesso!</div>';
                              }else{
                                 echo '<div class="msg">Falha na atualização!</div>';
                              }
                              
                            }
                          }
                         ?>

               <?php } ?>
               <?php
                     if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                     
                        $exame = new Exame();
                        $exames = $exame->get_exame_by_desc($_POST['name_search']);
                          echo '<table class="exibe_func">';
                          foreach($exames as $key => $exame){
                             echo '<tr>
                                      <td><a href="edita_exames.php?verificador=1&id='.$exames[$key][0].'">'.$exames[$key][1].'</a></td>
                             </tr>';
                          }
                          echo '</table>';
                     }
                     
                  ?>
            </div>
         
      </div>
   
</body>
</html>