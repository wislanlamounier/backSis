<?php
include_once("restrito.php");
include_once("../model/class_unidade_medida_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_horarios_bd.php");
include_once("../model/class_turno_bd.php");
include_once("../model/class_sql.php");
include_once("../model/class_config.php");
include_once("config.php");


?>
<html>
<?php 


	function validade(){
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
     
     function hideall(x){
            if(document.getElementById(x).hidden == true){
                document.getElementById(x).hidden = false;
            }else{
                document.getElementById(x).hidden = true;
                document.getElementById(1).hidden = true;
                document.getElementById(2).hidden = true;
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

 </script>
<body>

            <?php include_once("../view/topo.php"); ?>
            <div class="formulario" >
               
                
                  <div class="title-box"><div style="float:left"><img src="../images/config.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Configurações</span></div></div>
                  
                  <div style="float:left; width: 100%; margin-top:20px; padding-top: 5px; padding-bottom: 5px; text-align: center; background:url(../images/footer_lodyas.png); " ><span style="color: #ddd;" class="title">PONTO</span><input type="button" style="background-color: rgba(000,000,000,0.1); border:0; float:right; color:#cc0000" value="Configurar" onclick="mostraTabela1('ponto')" ></div>
                  <div id="ponto" hidden="on" style="float:left">
                  <form method="POST" action="configuracoes.php">
                      <table border="0">
                          <tr>
                            <td ><span><b>Limite de atraso permitido: </b></span></td><td><input type="text" id="temp_limit_atraso" name="temp_limit_atraso" value="<?php echo $_SESSION['temp_limit_atraso']; ?>"></td><td><span style="color:#565656"> (Máximo permitido: 59 minutos)</span></td>
                          </tr>
                          <tr>
                            <td ><span><b>Empresa: </b></span></td><td><a href="<?php echo 'add_empresa.php?tipo=editar&id='.$_SESSION['id_empresa'] ?>"><span>Configurar dados</span></a></td><!-- <td><span style="color:#565656"> (Máximo permitido: 59 minutos)</span></td> -->
                          </tr>
                          <tr>
                            <td colspan="3" style="padding-top:20px; text-align:center"><input type="submit" class="button" value="Salvar"> <input type="button" class="button" value="Cancelar"></td>
                          </tr>
                      
                    </table>
                  </form>
                       <div>
                  <?php 
                    if(validate()){
                         $config = new Config();
                         $config->atualizaTempLimitAtraso($_POST['temp_limit_atraso']);
                         
                      }
                   ?>
                </div>
                      
                 </div>
                  <?php include_once("../view/unidade_medida.php")?>      
                
                
         </div>
         
     
</body>
</html>