<?php
include_once("restrito.php");
include_once("../model/class_unidade_medida_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_horarios_bd.php");
include_once("../model/class_turno_bd.php");
include_once("../model/class_sql.php");
include_once("../model/class_config.php");
include_once("../model/class_cidade_bd.php");
include_once("../model/class_estado_bd.php");
include_once("../model/class_material_bd.php");
include_once("../model/class_regiao_bd.php");
include_once("../config.php");


?>
<html>
<?php 


	function validateUniMed(){
		if(isset($_POST['nome'])){return true;}else{return false;}
		if(isset($_POST['grandeza'])){return true;}else{return false;}
		if(isset($_POST['sigla'])){return true;}else{return false;}
	}
 
    
  function validate(){
      if(isset($_POST['temp_limit_atraso'])){
        if($_POST['temp_limit_atraso'] >= 0 && $_POST['temp_limit_atraso'] <= 60){
         $string = $_POST['temp_limit_atraso'];

    
         if(!preg_match("/^([0-59]+)$/i",$string)){
            echo '<div class="msg">Por favor, digite um valor de 0 à 59</div>';
            return false;
         }
         
         return true;
      }else{
          echo '<div class="msg">Por favor, digite um valor de 0 à 59</div>';
          return false;  
      }
    }
  }
 ?>

<head>
     <title>Configurações</title>
    
     <meta charset="UTF-8">
     <script src="../javascript/angular.min.js" type="text/javascript"></script>
     <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
     <link rel="stylesheet" type="text/css" href="style.css"> 
     <link rel="stylesheet" type="text/css" href="Styles/config_gerais.css"> 
     <link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
     <link href='http://fonts.googleapis.com/css?family=Wallpoet' rel='stylesheet' type='text/css'>
</head>
 <script type="text/javascript">
     
     
    function confirma(teste){
        data = teste.split(" ");
        id = data[0];
        nome = data[1];
        pesq = data[2];
        
        
       if(confirm("Excluir unidade "+nome+" , tem certeza?") ){
          var url = '../ajax/ajax_excluir_unidade_medida.php?id='+id+'&nome='+nome;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
            window.location.href='configuracoes.php?nome='+pesq;
          });
       }
    }
    
   
    function busca(){
        
       if(document.getElementById('nome_e').value !=0 ){
           var nome = document.getElementById('nome_e').value;
         
       }
       window.location = 'configuracoes.php?nome='+nome;

    }
    function atualizar(unidade){
        data = unidade.split(" ");
       
        alert("A unidade de medida "+ data[1] +" será alterada");
               
    }
    function valida(f){ 
      var erros=0;   
      for(i=0; i<f.length; i++){
        
         if(f[i].name == "temp_limit_atraso"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
         }
         if(f[i].name == "nome"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
         }
         if(f[i].name == "sigla"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
         }
         if(f[i].name == "grandeza"){
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
     
     function carregaU_M(um){
          data = um.split(":");
          var aux = data[0];          
          var aux2 = data[1];
         
          var combo = document.getElementById(aux2+":medida");
          for (var i = 0; i < combo.options.length; i++)
          {
            if (combo.options[i].value == aux)
            {
              combo.options[i].selected = true;

              break;
            }
          }
        }
        
      function hideall(x){
            if(document.getElementById(x).hidden == true){
                document.getElementById(x).hidden = false;
            }else{
                document.getElementById(x).hidden = true;
                document.getElementById(1).hidden = true;
                document.getElementById(2).hidden = true;
                document.getElementById(3).hidden = true;
                document.getElementById(4).hidden = true;
                document.getElementById("opcoes-materiais").hidden = true;
            }
        }
     
     function ocultaTabela(x){
          if(document.getElementById(x).hidden == true){
                document.getElementById(x).hidden = false;
            }else{
                document.getElementById(x).hidden = true;
            }
     }
     function mostraTabela1(x){
            
            if(document.getElementById(2).hidden == false){
                document.getElementById(2).hidden = true;
            }
            
            
            if(document.getElementById(x).hidden == true){
                document.getElementById(x).hidden = false;
            }else{
                document.getElementById(x).hidden = true;
            }
            
     }
   
     function mostraTabela2(x){
            if(document.getElementById(1).hidden == false){
                document.getElementById(1).hidden = true;
            }
            
            if(document.getElementById(x).hidden == true){
                document.getElementById(x).hidden = false;
            }else{
                document.getElementById(x).hidden = true;
            }
            
     }
     
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
          id('temp_limit_atraso').onkeypress = function(){
              mascara( this, mnum );
          }
       }
       
    function carregaUf(uf){
         data = uf.split(" ");
          var aux = data[0];
         
          var aux2 = data[1];
        
        
      var combo = document.getElementById(aux2+"xestado");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == aux)
        {
          combo.options[i].selected = true;
          
          break;
        }
      }
      buscar_cidades(aux2+"xestado");
    } 
    
    function buscar_cidades(x){ 
          
          var estado = document.getElementById(x).value;  //codigo do estado escolhido
          data = x.split("x");
          var aux = data[0];
          var aux2 = data[1];
         
          //se encontrou o estado
          if(estado){
            var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function(dataReturn) {
              $('#'+aux+'load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
            });
          }
    }
       function buscar_cidades(){ 
          
          var estado = document.getElementById("estado").value;  //codigo do estado escolhido
          
          //se encontrou o estado
          if(estado){
            var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
            $.get(url, function(dataReturn) {
              $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
            });
          }
    }
    
    function carregaCidade(){
                
                
                var combo = document.getElementById("cidade");
                var cidade = document.getElementById("id_cidade").value;
                
                for (var i = 0; i < combo.length; i++)
                {

                  if (combo.options[i].value == cidade)
                  {
                    combo.options[i].selected = true;
                    break;
                  }
                }      
    }
   
   
 </script>
<body>

            <?php include_once("../view/topo.php"); ?>
    <div class="formulario">
             
               
        <div class="title-box"><div style="float:left"><img src="../images/config.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Configurações</span></div></div>
                  
        <div>
        <?php include_once("../view/ponto.php"); ?> 
        </div>

        <div>
        <?php include_once("../view/unidade_medida.php"); ?> <!--DEIXAR SEMPRE POR ULTIMO NO MENU-->
        </div>
        
        <div>
        <?php include_once("../view/layout.php"); ?>
        </div>
        
        <div>
        <?php include_once("../view/configuracoes_gerais.php"); ?>
        </div>
       
                   
     </div>
</body>
</html>