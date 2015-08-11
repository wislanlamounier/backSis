
<?php
include("restrito.php");
include("../model/class_cboXexames.php");
include("../model/class_cbo_bd.php");
include("../model/class_exame_bd.php");

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
      
      
</script>

<head>
   <title>Pesquisar CBO</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>   
<?php include_once("../view/topo.php"); ?>


          <div class="formulario">
                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/search-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Pesquisar Funcionario</span></div></div>                                                                
                    <form method="POST" class="pesquisa-campos" id="pesquisa-campos" name="pesquisa-campos" action="pesquisa_cbo.php">
                       <table id="table-search">
                         <tr>
                            <td><span >Código ou Descrição: </span></td>
                            <td><input type="text" id="name_search" name="name_search" title="Digite o código ou a descrição para pesquisar"></td>
                            <td><input type="submit" value="Buscar" class="button"></td>
                         </tr>
                      </table>
                    </form>
             <?php
                   if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                      $cbo = new Cbo();
                      $cbos = $cbo->get_cbo_by_codigo_and_desc($_POST['name_search']);
                        echo '<table class="exibe-pesquisa">';
                        if(count($cbos)>0)
                        foreach($cbos as $key => $cbo){

                           echo '<tr>
                                    <td><a href="pesquisa_cbo.php?verificador=1&id='.$cbos[$key][0].'">'.$cbos[$key][1]." ".$cbos[$key][2].'</a></td></tr>';
                        }
                        echo '</table>';
                   }

                   if(isset($_GET['verificador']) && $_GET['verificador'] == 1){
                     $cbo = new Cbo();
                     $cbo = $cbo->get_cbo_by_id($_GET['id']);
                     echo $cbo->printCbo();

                   }
                ?>
          </div>                         
                                
</body>
</html>