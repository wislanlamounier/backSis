
<?php
include("restrito.php");
include("../model/class_epi_bd.php");
include_once("../model/class_rend_double_select.php");

?>
<html>

<script type="text/javascript">
     
  
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
           
               

               <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">ADICIONAR EPI</span></div></div>                
               <form method="POST" id="add_epiXfunc" action="add_epiXfunc.php" onsubmit="return validate(this)">
                  <table border="0" >
                      <input type="hidden" id="tipo" name="tipo" value="cadastrar">                     
                     <?php include("informacoes_func_pesq.php") ?>                    
                  </table>
               </form>
             

            </div>
         
            
   
</body>
</html>