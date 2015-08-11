
<?php
include("restrito.php");
include("../model/class_cliente.php");

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
      
      
</script>

<head>
   <title>Pesquisar Funcionario</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>   
<?php include_once("../view/topo.php"); ?>


                    <div class="formulario">
                          <div class="title-box" style="float:left"><div style="float:left"><img src="../images/search-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Pesquisar Funcionario</span></div></div>                                                                
                                    <form method="POST" class="pesquisa-campos" id="pesquisa-campos" name="pesquisa-campos" action="pesquisa_func.php">
                                         <table id="table-search">
                                             <tr>                                             
                                                <td><span>Funcionario Nome: </span></td>
                                                <td><input style="width:100%" type="text" id="name_search" name="name_search"></td>
                                                <td><input type="submit" class="button" value="Buscar"></td>
                                             </tr>
                                          </table>
                                    </form>
                         <?php

                          if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                            
                                $func = new Funcionario();                                
                                $funcs = $func->get_func_by_name($_POST['name_search'], $_SESSION['id_empresa']);
                               echo '<table class="exibe-pesquisa">';
                                if(count($funcs)>0)
                                foreach($funcs as $key => $func){
                                   echo '<tr>
                                            <td><a href="pesquisa_func.php?verificador=1&id='.$funcs[$key][0].'">'.$funcs[$key][0]." ".$funcs[$key][1].'</a></td></tr>';
                                }
                                echo '</table>';
                           
                           }
                           if(isset($_GET['verificador']) && $_GET['verificador'] == 1){
                             
                               $func = new Funcionario();
                              $func = $func->get_func_id($_GET['id']);
                              echo $func->printFunc();
                            }
                          ?>                          
                          </div>
                         
                                
</body>
</html>