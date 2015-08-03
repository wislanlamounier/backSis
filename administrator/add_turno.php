
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
   if(!isset($_POST['ini_exp_h']) || $_POST['ini_exp_m'] == ""){
         return false;
   }
   if(!isset($_POST['ini_alm_h']) || $_POST['ini_alm_m'] == ""){
         return false;
   }
   if(!isset($_POST['fim_alm_h']) || $_POST['fim_alm_m'] == ""){
         return false;
   }
   if(!isset($_POST['fim_exp_h']) || $_POST['fim_exp_m'] == ""){
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
   <title>Adicionar</title>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="style.css">   
</head>

<body>
   <?php 
      if(validate()){
         $turno = new Turno();
         $nome = $_POST['nome'];
         $ini_exp = $_POST['ini_exp_h'].":".$_POST['ini_exp_m'].":00";
         $ini_alm = $_POST['ini_alm_h'].":".$_POST['ini_alm_m'].":00";
         $fim_alm = $_POST['fim_alm_h'].":".$_POST['fim_alm_m'].":00";
         $fim_exp = $_POST['fim_exp_h'].":".$_POST['fim_exp_m'].":00";
         $desc = "Das ".$_POST['ini_exp_h'].":".$_POST['ini_exp_m']." às "
                 .$_POST['ini_alm_h'].":".$_POST['ini_alm_m']." e das "
                 .$_POST['fim_alm_h'].":".$_POST['fim_alm_m']." às "
                 .$_POST['fim_exp_h'].":".$_POST['fim_exp_m'];

         $turno->cadTurno($nome, $desc, $ini_exp, $ini_alm, $fim_alm, $fim_exp);
         $turno->add_turno_bd();

      }

   ?>
  <?php include_once("../view/topo.php"); ?> 
   <div id="content">     
       
            <div class="formulario">
               <h1>Adicionar Turno</h1>
                <div class="title">
                  <span style="font-size:14px; color:#555;">Atenção: use o formato de 24 horas para o preenchimento de um novo turno, de 0 à 24 horas e de 0 aos 59 minutos</span>
               </div>
               <form method="POST" class="ad_turno" id="ad_turno" name="ad_turno" action="add_turno.php" onsubmit="return validate(this)">
                  <table border="0">
                     <tr> <td><span>Nome:</span></td> <td ><input type="text" id="nome" name="nome" style="width:100px;" title="Digite um nome para esse turno"></td></tr> <!-- nome-->
                     <tr> <td ><span>Início expediente:</span></td> <td><input type="text" id="ini_exp_h" name="ini_exp_h"><span>h</span><input type="text" id="ini_exp_m" name="ini_exp_m"><span>m</span></td></tr> <!-- ini exp -->
                     <tr> <td ><span>Início almoço:</span></td> <td><input type="text" id="ini_alm_h" name="ini_alm_h"><span>h</span><input type="text" id="ini_alm_m" name="ini_alm_m"><span>m</span></td></tr> <!-- ini alm -->
                     <tr> <td ><span>Fim almoço</span></td> <td><input type="text" id="fim_alm_h" name="fim_alm_h"><span>h</span><input type="text" id="fim_alm_m" name="fim_alm_m"><span>m</span></td></tr> <!-- fim alm -->
                     <tr> <td ><span>Fim expediente:</span></td> <td><input type="text" id="fim_exp_h" name="fim_exp_h"><span>h</span><input type="text" id="fim_exp_m" name="fim_exp_m"><span>m</span></td></tr> <!-- fim exp -->
                     
                     <tr>
                        <td colspan="3">
                           <input style="width:80px;"type="submit" name="button" id="button" value="Cadastrar">
                           <input style="width:80px;" name="button" onclick="window.location.href='logado.php'" id="button" value="Cancelar">
                        </td>
                     </tr>
                  </table>
               </form>
            </div>
         
      <?php include("informacoes_turno.php") ?>
   </div>
</body>
</html>