<?php
 include("restrito.php");
 include("../model/class_epi_bd.php");
 include_once("../model/class_rend_double_select.php");
 include("../model/class_funcionario_bd.php");
 include("../model/class_epiXfunc_bd.php");
 ?>

<?php 
function validate(){
   
   if(!isset($_POST['selecionados']) || $_POST['selecionados'] == ""){
         return false;
   }
   return true;
}

 ?>

<script type="text/javascript">
      function validate(f){ 
            var erros=0;   
            for(i=0; i<f.length; i++){
               if(f[i].name == "data"){
                  if(f[i].value == ""){
                     f[i].style.border = "1px solid #f00";
                     erros++;
                  }else{
                    f[i].style.border = "1px solid #898989";
                  }
               }

               if(f[i].name == "selecionados[]"){
                  if(f[i].selectedIndex == -1){
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

    // function avanca(tipo){
    //       html = '<td>Preencha a quantidade dos equipamentos<br />';
    //       for(i=0; i<document.getElementById("selecionados").options.length; i++)
            
    //         html += document.getElementById("selecionados").options[i].text+": <input type='text' name="+document.getElementById("selecionados").options[i].value+"><br />";
    //       html += "</td>";
              
        
    //       $('#equipamentos').html(html);  //coloco na div o retorno da requisicao
    //       $('#btnAvancar').html('<input style="width:80px;" type="button" name="button" class="button" id="buttonAvancar" onclick="selectAll(), submit()" value="Cadastrar">');  //coloco na div o retorno da requisicao
          
          
    //       // document.getElementById("add_epiXfunc").submit();
    // }
    // function submit(){
    //     document.getElementById("add_epiXfunc").submit(); 
    // }
    function selectAll(){
        var select = document.getElementById("selecionados");
        for(i=0; i<select.length; i++){
          
           select[i].selected = true;
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
          <?php if(!isset($_GET['tipo'])){ //ESSE BOTÃO PESQUISAR, SÓ DEVE APARECER NA HORA DE ADICIONAR?>
                    <input type="button" class="button2" value="Pesquisar" onclick="buscar_editar('1')">
                    <div id="result1">
                    </div>
          <?php } ?>
   <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar'){ //CADASTRAR EPI POR FUNCIONARIO?>
           <div class="title-box" style="float:left"><div style="float:left"><img src="../images/icon-add-epi.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Adicionar EPI para funcionario</span></div></div><br><br><br><br>    
           <?php // botão pesquisa funcionario para adicionar equipamento (funcção buscar_editar() esta no arquivo informacoes_func_epi.php ?>
           
           <?php 
                     $func = new Funcionario();
                     $func = $func->get_func_id($_GET['id']);
            ?>
            <form method="POST" id="add_epiXfunc" action="add_epiXfunc.php" onsubmit="return validate(this)">
                  <table border="0" style="width:100%">
                      <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                      <input type="hidden" id="id_func" name="id_func" value="<?php echo $func->id; ?>">
                      
                      <tr>
                           <td><span>Funcionario:</td>
                           <td><input style="width:100%" type="text" id="funcionario" disabled name="funcionario" value="<?php echo $func->nome; ?>"></td>
                      </tr>
                      <tr> <td ><span>Data de entrega:</span></td> <td><input type="date" id="data" name="data" value='<?php echo date("Y-m-d"); ?>'></td></tr>
                      <!-- <tr> <td ><span>Quantidade:</span></td> <td><input type="number" id="quantidade" name="quantidade"></td></tr>   -->
                      <tr><td colspan="2"><span>Escolha os equipamentos e clique em avançar para definir a quantidade:</span></td></tr>
                      <tr>
                          
                              <td colspan="2">
                                  <div id="equipamentos">
                                   <!-- <select id="exames" name="exames[]" size="5" multiple style="width:270px"> -->
                                      <?php
                                         $epi = new Epi();
                                         $epis = $epi->get_name_all_epi();
                                         $data = array();
                                         $data_selected = array();

                                         for ($i=0; $i < count($epis); $i++) { 
                                            $data[$i] = array("id"=>$epis[$i][0], "nome_epi"=>$epis[$i][1]);
                                         }

                                         RendDoubleSelect::showDoubleDropDownAlert($data, $data_selected, "id", "nome_epi", "", 
                                                "sel_epis1", "selecionados", "hd_Epis", "130px", 
                                               "Epis", "Selecionados");
                                       ?>
                                   <!-- </select> -->
                                </div>
                              </td>
                          
                     </tr>
                     <tr>
                        <td colspan="3" style="text-align:center">
                          <input style="width:80px;" type="submit" name="button" class="button" id="buttonAvancar" onclick="selectAll()" value="Cadastrar">
                          <input style="width:80px;" name="button" class="button" onclick="window.location.href='logado.php'" id="button" value="Cancelar">
                        </td>
                     </tr>
                  </table>
               </form>
   <?php }else if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){ // EDITAR EPI POR FUNCIONARIO?>
            <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Editar EPI para funcionario</span></div></div><br><br><br><br>    
                 <?php 
                     $func = new Funcionario();
                     $func = $func->get_func_id($_GET['id']);
                     $u = new Epi();
                     $epi_func = $u->get_epi_func($func->id);
                  ?>
            <form method="POST" id="add_epiXfunc" action="add_epiXfunc.php" onsubmit="return validate(this)">
                  <table border="0" style="width:100%; text-align:center">
                      <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                      <input type="hidden" id="id_func" name="id_func" value="<?php echo $func->id; ?>">
                      
                      <tr><td style="width:100px;"><span>Funcionario:</td><td colspan="4"><input style="width:100%" type="text" id="funcionario" disabled name="funcionario" value="<?php echo $func->nome; ?>">                       
                      <!-- <tr> <td ><span>Data de entrega:</span></td> <td><input type="date" id="data" name="data" value='<?php echo date("Y-m-d"); ?>'></td></tr> -->
                      <!-- <tr> <td ><span>Quantidade:</span></td> <td><input type="number" id="quantidade" name="quantidade"></td></tr>   -->
                      <tr> <td ><span>ID</span></td> <td><span>Nome</span></td> <td><span>Quantidade</span></td><td><span>Data</span></td></tr>
                      <?php foreach ($epi_func as $key => $value) {
                        echo '<tr><td><span>'.$epi_func[$key]->id.'</span></td><td><span>'.$epi_func[$key]->nome_epi.'</span></td><td><span>'.$epi_func[$key]->quantidade.'</span></td><td><span>'.$epi_func[$key]->data_entrega.'</span></td></tr>';
                      } ?>
                     <tr>
                        <td colspan="4" style="text-align:center">
                          <input style="width:80px;" type="button" name="button" class="button" id="buttonAvancar" onclick="selectAll()" value="Editar">
                          <input style="width:80px;" type="button" name="button" class="button" onclick="window.location.href='logado.php'" id="button" value="Cancelar">
                        </td>
                     </tr>
                  </table>
               </form>
   <?php }?>  

       <?php 
            
              if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                  if(validate()){
                       $epixfunc = new EpiXFunc();
                       $class_epi_bd = new Epi();
                       $nome_epi = $class_epi_bd;
                       $id_func = $_POST['id_func'];
                       $data_entrega = $_POST['data'];                                 
                       $idepi = $_POST['selecionados'];
                       $cont=0;
                       //echo '<script>alert("'.$arridepi[$i][0].'");</script>';                       

                       for ($i = 0; $i < count($idepi); $i++) {
                            $quantidade = substr($idepi[$i], 1, strpos($idepi[$i],']')-1);//pega aquandidade que vem via post
                            $id_epi = substr($idepi[$i], strpos($idepi[$i],']')+1);//pega o id
                            
                            if($epixfunc->add_epi_x_func($id_epi, $id_func, $data_entrega, $quantidade)){
                              $cont++;
                            }
                            // echo '<td>quantidade: '.$quantidade." id: ".$id.'</td><br>';
                            // $arridepi[$i][0] = $idepi[$i][0];
                       }
                       if($cont == count($idepi)){
                          echo '<div class="msg">Equipamentos cadastrados com sucesso!</div>';
                       }else{
                          echo '<div class="msg">Erro ou cadastrar equipamentos!</div>';
                       }                      
                  }
              }              
              // if(isset($_POST['tipo']) && $_POST['tipo'] == "editar"){
              //     if(validate()){
              //          $epixfunc = new EpiXFunc();
              //          $class_epi_bd = new Epi();
              //          $nome_epi = $class_epi_bd;
              //          $id_func = $_POST['id_func'];
              //          $data_entrega = $_POST['data'];                                 
              //          $idepi = $_POST['selecionados'];
              //          $cont=0;
              //          //echo '<script>alert("'.$arridepi[$i][0].'");</script>';                       

              //          for ($i = 0; $i < count($idepi); $i++) {
              //               $quantidade = substr($idepi[$i], 1, strpos($idepi[$i],']')-1);//pega aquandidade que vem via post
              //               $id_epi = substr($idepi[$i], strpos($idepi[$i],']')+1);//pega o id
                            
              //               if($epixfunc->add_epi_x_func($id_epi, $id_func, $data_entrega, $quantidade)){
              //                 $cont++;
              //               }
              //               // echo '<td>quantidade: '.$quantidade." id: ".$id.'</td><br>';
              //               // $arridepi[$i][0] = $idepi[$i][0];
              //          }
              //          if($cont == count($idepi)){
              //             echo '<div class="msg">Equipamentos cadastrados com sucesso!</div>';
              //          }else{
              //             echo '<div class="msg">Erro ou cadastrar equipamentos!</div>';
              //          }                      
              //     }
              // }
        ?>
        
       
    </div>
    <?php include("informacoes_func_epi.php") ?>
</body>