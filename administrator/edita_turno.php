
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

function validate(){
   if(!isset($_POST['ini_exp_h']) || $_POST['ini_exp_h'] == ""){
         return false;
   }
   return true;
}

?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
     function validate(f){
      var erros=0;
      for(i=0; i < f.length; i++){
         if(f[i].name == "nome"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "ini_exp_h"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "ini_exp_m"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "ini_alm_h"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "ini_alm_m"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "fim_alm_m"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "fim_alm_h"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "fim_exp_h"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "fim_exp_m"){
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

   //mascaras
      function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
      }
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
      }
       function id( el ){
         // alert("id")
         return document.getElementById( el );
       }
      function mnum(v){
           if(v.length >=19){
              v = v.substring(0,(v.length - 1));
              return v;
           }
           v=v.replace(/\D/g,"");
           return v;
       }
       
      window.onload = function(){
         id('ini_exp_h').onkeypress = function(){
             mascara( this, mnum );
         }
         id('ini_exp_m').onkeypress = function(){
             mascara( this, mnum );
         }
         id('ini_alm_h').onkeypress = function(){
             mascara( this, mnum );
         }
         id('ini_alm_m').onkeypress = function(){
             mascara( this, mnum );
         }
         id('fim_alm_h').onkeypress = function(){
             mascara( this, mnum );
         }
         id('fim_alm_m').onkeypress = function(){
             mascara( this, mnum );
         }
         id('fim_exp_h').onkeypress = function(){
             mascara( this, mnum );
         }
         id('fim_exp_m').onkeypress = function(){
             mascara( this, mnum );
         }
      }
   //fim mascaras

</script>

<head>
   <title>Editar</title>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="style.css">
   <link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Wallpoet' rel='stylesheet' type='text/css'>
</head>

<body>
   <?php 
      if(validate()){
         
      }
   ?>
   
           <?php include("../view/topo.php") ?>
            <div class="formulario">
              <h1>Editar Turno</h1>
            <?php
                 
                 if(isset($_GET['verificador']) && $_GET['verificador'] == 1){ //ini if 1 
                  
                    $turno = new Turno();
                    // $turnos = $turno->get_func_by_name($_POST['name_search']);
                    $turno = $turno->getTurnoById($_GET['id']);
                    $nome = $turno->nome;
                                                                        //01234567
                    $ini_exp_h = $turno->ini_exp[0].$turno->ini_exp[1]; //08:00:00
                    $ini_exp_m = $turno->ini_exp[3].$turno->ini_exp[4];
                    $ini_alm_h = $turno->ini_alm[0].$turno->ini_alm[1];
                    $ini_alm_m = $turno->ini_alm[3].$turno->ini_alm[4];
                    $fim_alm_h = $turno->fim_alm[0].$turno->fim_alm[1];
                    $fim_alm_m = $turno->fim_alm[3].$turno->fim_alm[4];
                    $fim_exp_h = $turno->fim_exp[0].$turno->fim_exp[1];
                    $fim_exp_m = $turno->fim_exp[3].$turno->fim_exp[4];

                ?>
                  <form method="POST" class="ad_turno" id="ad_turno" name="ad_turno" action="edita_turno.php" onsubmit="return validate(this)">
                  <input type="hidden" name="confirm_ed" id="confirm_ed" value="1">
                  <input type="hidden" name="id_turno" id="id_turno" value="<?php echo $_GET['id']; ?>">
                  <table border="0">
                     <tr> <td><span>Nome:</span></td> <td ><input type="text" id="nome" name="nome" style="width:100px;" title="Digite um nome para esse turno" value="<?php echo $nome; ?>"></td></tr> <!-- nome-->
                     <tr> <td ><span>Início expediente:</span></td> <td><input type="text" id="ini_exp_h" name="ini_exp_h" value="<?php echo $ini_exp_h; ?>"><span>h</span><input type="text" id="ini_exp_m" name="ini_exp_m" value="<?php echo $ini_exp_m; ?>"><span>m</span></td></tr> <!-- ini exp -->
                     <tr> <td ><span>Início almoço:</span></td> <td><input type="text" id="ini_alm_h" name="ini_alm_h" value="<?php echo $ini_alm_h; ?>"><span>h</span><input type="text" id="ini_alm_m" name="ini_alm_m" value="<?php echo $ini_alm_m; ?>"><span>m</span></td></tr> <!-- ini alm -->
                     <tr> <td ><span>Fim almoço</span></td> <td><input type="text" id="fim_alm_h" name="fim_alm_h" value="<?php echo $fim_alm_h; ?>"><span>h</span><input type="text" id="fim_alm_m" name="fim_alm_m" value="<?php echo $fim_alm_m; ?>"><span>m</span></td></tr> <!-- fim alm -->
                     <tr> <td ><span>Fim expediente:</span></td> <td><input type="text" id="fim_exp_h" name="fim_exp_h" value="<?php echo $fim_exp_h; ?>"><span>h</span><input type="text" id="fim_exp_m" name="fim_exp_m" value="<?php echo $fim_exp_m; ?>"><span>m</span></td></tr> <!-- fim exp -->
                     
                     <tr><td colspan="3"><input style="width:80px;"type="submit" name="button" id="button" value="Editar"></td> </tr>
                  </table>
               </form>
                <?php

                 }else{ //fim if 1?>
                  <?php 
                    $turno = new Turno();
                    // $turnos = $turno->get_func_by_name($_POST['name_search']);
                    $turnos = $turno->get_name_all_turno_disponiveis();
                    
                    echo '<table class="exibe_func">';
                    foreach($turnos as $key => $turno){
                       echo '<tr>
                                <td><a href="edita_turno.php?verificador=1&id='.$turnos[$key][0].'">'.$turnos[$key][2].' - ' .$turnos[$key][1].'</a></td></tr>';
                    }
                    echo '</table>';
                   ?>

                  <?php }//fim else if 1

                    if( isset($_POST['confirm_ed']) && $_POST['confirm_ed'] == 1 ){
                    
                    if(validate()){
                         $turno = new Turno();
                         $id = $_POST['id_turno'];
                         $nome = $_POST['nome'];
                         $ini_exp = $_POST['ini_exp_h'].":".$_POST['ini_exp_m'].":00";
                         $ini_alm = $_POST['ini_alm_h'].":".$_POST['ini_alm_m'].":00";
                         $fim_alm = $_POST['fim_alm_h'].":".$_POST['fim_alm_m'].":00";
                         $fim_exp = $_POST['fim_exp_h'].":".$_POST['fim_exp_m'].":00";
                         $desc = "Das ".$_POST['ini_exp_h'].":".$_POST['ini_exp_m']." às "
                                 .$_POST['ini_alm_h'].":".$_POST['ini_alm_m']." e das "
                                 .$_POST['fim_alm_h'].":".$_POST['fim_alm_m']." às "
                                 .$_POST['fim_exp_h'].":".$_POST['fim_exp_m'];

                        if($turno->atualiza_turno($nome, $id, $desc, $ini_exp, $ini_alm, $fim_alm, $fim_exp)){
                            echo '<div class="msg">Turno editado com sucesso!</div>';
                        }else{
                            echo '<div class="msg">Falha ao editar turno!</div>';
                        }
                      }
                   }

                   ?>


            </div>
         
     
</body>
</html>