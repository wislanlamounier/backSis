
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
include_once("../model/class_empresa_bd.php");

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
      
      
</script>

<head>
   <title>Pesquisar Empresa</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>   
<?php include_once("../view/topo.php"); ?>


                          <div class="formulario">
                          <div class="title-box" style="float:left"><div style="float:left"><img src="../images/search-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Pesquisar Empresa</span></div></div>                                                                
                                    <form method="POST" class="pesquisa-campos" id="pesquisa-campos" name="pesquisa-campos" action="pesquisa_empresa.php">
                         <table id="table-search">
                           <tr>
                              <td><span >Nome Fantasia: </span></td>
                              <td><input type="text" id="name_search" name="name_search" title="Digite o código ou a descrição para pesquisar"></td>
                              <td><input type="submit" class="button" value="Buscar"></td>
                           </tr>
                        </table>
                      </form>
               <?php
                     if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                        $empresa = new Empresa();
                        $empresas = $empresa->get_empresa_by_nome_fantasia($_POST['name_search']);
                        if(count($empresas) == 0){
                          echo '<div class="msg">Nenhum registro encontrado!</div>';
                        } 
                          echo '<table class="exibe-pesquisa">';
                        if(count($empresas) > 0)
                          foreach($empresas as $key => $empresa){
                             echo '<tr>
                                      <td><a href="pesquisa_empresa.php?verificador=1&cnpj='.$empresas[$key][1].'"><b>Empresa: </b>'.$empresas[$key][2]." - <b>CNPJ: </b>".$empresas[$key][1].'</a></td></tr>';
                          }
                          echo '</table>';
                     }

                     if(isset($_GET['verificador']) && $_GET['verificador'] == 1){
                       $empresa = new Empresa();
                       $empresa = $empresa->get_empresa_by_cnpj($_GET['cnpj']);
                      
                       echo $empresa->printEmpresa();
                   

                     }
                  ?>
                          </div>
                         
                                
</body>
</html>