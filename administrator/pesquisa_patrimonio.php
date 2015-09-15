
<?php
include("restrito.php");
include("../model/class_patrimonio_bd.php");



?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
      
      
</script>

<head>
   <title>Pesquisar Patrimonio</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>   
<?php include_once("../view/topo.php"); ?>


     <div class="formulario">
           <div class="title-box" style="float:left"><div style="float:left"><img src="../images/search-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Pesquisar Patrimonio (Maquinário e Veículo)</span></div></div>                                                                
                 <form method="POST" class="pesquisa-campos" id="pesquisa-campos" name="pesquisa-campos" action="pesquisa_patrimonio.php">
                    <table id="table-search">
                      <tr>
                         <td><span >Patrimonio: </span></td>
                         <td><input type="text" id="name_search" name="name_search" title="Digite qual patrimobio deseja procurar..."></td>
                         <td><input type="submit" value="Buscar" class="button"></td>
                      </tr>
                   </table>
                 </form>
          <?php
                if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                   $patrimonio = new Patrimonio();
                   $patrimonios = $patrimonio->get_all_patrimonio($_POST['name_search']);
                     echo '<table class="exibe-pesquisa">';
                     if(count($patrimonios)>0)
                     foreach($patrimonios as $key => $patrimonio){
                        echo '<tr>

                                 <td><a href="pesquisa_patrimonio.php?verificador=1&id='.$patrimonios[$key][0].'&controle='.$patrimonios[$key][3].'">'.$patrimonios[$key][0]." ".$patrimonios[$key][1]." ".$patrimonios[$key][4].'</a></td></tr>';
                     }
                     echo '</table>';
                }

                if(isset($_GET['verificador']) && $_GET['verificador'] == 1){
                  $patrimonio = new Patrimonio();
                  $id = $_GET['id'];
                  $controle = $_GET['controle'];
                  $patrimonio->printPatrimonio($id,$controle);




                }
             ?>
     </div>                         
                                
</body>
</html>