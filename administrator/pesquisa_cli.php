
<?php
include("restrito.php");
include("../model/class_cliente.php");

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
      
      
</script>

<head>
   <title>Pesquisar Cliente</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>   
<?php include_once("../view/topo.php"); ?>


                          <div class="formulario">
                          <div class="title-box" style="float:left"><div style="float:left"><img src="../images/search-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Pesquisar Cliente</span></div></div>                                                                
                                    <form method="POST" class="pesquisa-campos" id="pesquisa-campos" name="pesquisa-campos" action="pesquisa_cli.php">
                                         <table>
                                           <tr>
                                            <select name="tipo" class="select">
                                            <option   value="2">Selecione o tipo de Cliente</option>
                                            <option   value="0">Cliente Pessoa Fisica</option>
                                            <option   value="1">Cliente Pessoa Juridica</option>  
                                            </select>
                                              <td><span>Cliente: </span></td>
                                              <td><input type="text" id="name_search" name="name_search"></td>
                                              <td><input type="submit" value="Buscar"></td>
                                           </tr>
                                          </table>
                                    </form>
                         <?php

                          if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                            if($_POST['tipo']==0){
                                $cli = new Cliente();
                                $tipo = $_POST['tipo'];

                                $clis = $cli->pesquisa_cli_by_name($_POST['name_search'], $tipo, $_SESSION['id_empresa']);
                                        echo '<table>';
                                        if(count($clis)>0)
                                foreach($clis as $key => $cli){
                                   echo '<tr>
                                            <td><a href="pesquisa_cli.php?verificador=1&id='.$clis[$key][0].'">'.$clis[$key][0]." ".$clis[$key][1].'</a></td></tr>';
                                }
                                echo '</table>';
                           }                         
                         if($_POST['tipo']==1){
                            $cli = new Cliente();
                                $tipo = $_POST['tipo'];
                                $clis = $cli->pesquisa_cli_by_name($_POST['name_search'], $tipo, $_SESSION['id_empresa']);
                                if($clis != ""){
                                        echo '<table>';
                                if(count($clis)>0)
                                foreach($clis as $key => $cli){
                                   echo '<tr>
                                            <td><a href="pesquisa_cli.php?verificador=2&id='.$clis[$key][0].'">'.$clis[$key][0]." ".$clis[$key][1].'</a></td></tr>';
                                }
                                }
                                echo '</table>';
                         }
                        }
                        $cli = new Cliente();
                        if(isset($_GET['verificador']) && $_GET['verificador'] == 1){
                             
                              
                              $cli = $cli->get_cli_id($_GET['id']);
                              echo $cli->printCli();
                           }elseif(isset($_GET['verificador']) && $_GET['verificador'] == 2){
                             
                              // $cli = new Cliente();
                              $cli = $cli->get_cli_jur_id($_GET['id']);
                              
                              echo $cli->printCli_Jur();
                           }

                          ?>                          
                          </div>
                         
                                
</body>
</html>