
<?php
include("restrito.php");
include("../model/class_filial_bd.php");



?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
      
      
</script>

<head>
   <title>Pesquisar Filial</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>   
<?php include_once("../view/topo.php"); ?>


                          <div class="formulario">
                          <div class="title-box" style="float:left"><div style="float:left"><img src="../images/search-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Pesquisar filial</span></div></div>                                                                
                         <form method="POST" class="pesquisa-campos" id="pesquisa-campos" name="pesquisa-campos" action="pesquisa_filial.php">
                         <table>
                           <tr>
                              <td><span >Filial: </span></td>
                              <td><input type="text" id="name_search" name="name_search" title="Digite nome ou CNPJ da filial que deseja pesquisar"></td>
                              <td><input type="submit" value="Buscar"></td>
                           </tr>
                        </table>
                      </form>
               <?php
                     if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                        $filial = new Filial();
                        $filiais = $filial->get_filial_by_cnpj_and_nome($_POST['name_search']);
                          echo '<table class="">';
                          foreach($filiais as $key => $filial){
                             echo '<tr>
                                      <td><a href="pesquisa_filial.php?verificador=1&id='.$filiais[$key][0].'">'.$filiais[$key][1]." ".$filiais[$key][2].'</a></td></tr>';
                          }
                          echo '</table>';
                     }

                     if(isset($_GET['verificador']) && $_GET['verificador'] == 1){
                       $filial = new Filial();
                       $filial = $filial->get_filial_id($_GET['id']);
                       echo $filial->printFilial();

                     }
                  ?>
                          </div>                         
                                
</body>
</html>