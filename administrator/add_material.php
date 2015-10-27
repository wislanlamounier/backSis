<?php
include("restrito.php"); 

include_once("../model/class_sql.php");
include("../model/class_empresa_bd.php");
include("../model/class_unidade_medida_bd.php");
include("../model/class_material_bd.php");


function validate(){
   if(!isset($_POST['nome']) || $_POST['nome'] == ""){
        return false;
   	}
   		   return true;
    }
function formata_salario($valor){
    $replace = array(".","R$ ");
    $string = str_replace($replace, "", $valor);

    $replace = array(",");
    $string = str_replace($replace, ".", $string);
    
    $return = $string;
    return $return;
}

function verificaValor($valor){
        
    if(!strpos($valor, '.')){// se não existe . na string (EX R$ 15) tem que adicionar .00 para ficar (R$ 15.00)
       $valor .= '.00';

    /**** Comments else if ****
      se (tamanho da string) - (posisão do ponto) for < 3 
      EX:
      len ->  12345
      str ->  100.5
      pos ->  01234
      
      len == 5; pos == 3;

      (5-3) == 2; 2 < 3

    */
    }else if(strlen($valor) - strpos($valor, '.') < 3){
        $valor .= '0';
    }
    
    return $valor;
}
    
    
 ?>

<html>
    
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style.css">

</head>
<script type="text/javascript">
        function valida(f){
	        var erros = 0;
	        var msg = "";
	          for (var i = 0; i < f.length; i++) {
                      if(f[i].name == "empresa"){
		            if(f[i].value == "no_sel"){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
                        if(f[i].name == "nome"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
                        if(f[i].name == "medida"){
		            if(f[i].value == "no_sel"){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
         
                    if(erros>0){
                        return false;
			}else{
                    return true;
			}
                     }
                 }
	function confirma(id,nome){
            
       if(confirm("Excluir Material "+nome+" , tem certeza?") ){
          var url = '../ajax/ajax_excluir_material.php?id='+id+'&nome='+nome;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
          	
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
    }
    function carregaU_M(uf){

          var combo = document.getElementById("medida");
          for (var i = 0; i < combo.options.length; i++)
          {
            if (combo.options[i].value == uf)
            {
              combo.options[i].selected = true;

              break;
            }
          }
        }
    function carregaEmp(emp,j){
          var combo = document.getElementById(j+":empresa");
          for (var i = 0; i < combo.options.length; i++)
          {
            if (combo.options[i].value == emp)
            {
              combo.options[i].selected = true;

              break;
            }
          }
        }    
    function carregaTipo_custo(tc){
           
      var combo = document.getElementById("tipo_custo");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == tc)
        {
          combo.options[i].selected = true;
          
          break;
        }
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
    function mmoney(v){
       if(v.length >=18){                                          // alert("mtel")
         v = v.substring(0,(v.length - 1));
         return v;
       }
       v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
       v=v.replace(/(\d)(\d{11})$/,"$1.$2");    //Coloca hífen entre o quarto e o quinto dígitos
       v=v.replace(/(\d)(\d{8})$/,"$1.$2");    //Coloca hífen entre o quarto e o quinto dígitos
       v=v.replace(/(\d)(\d{5})$/,"$1.$2");    //Coloca hífen entre o quarto e o quinto dígitos
       v=v.replace(/(\d)(\d{2})$/,"$1,$2");    //Coloca hífen entre o quarto e o quinto dígitos
       
       return 'R$ '+v;
    }
   function mtel(v){
       if(v.length >=15){
         v = v.substring(0,(v.length - 1));
         return v;
       }
       v=v.replace(/\D/g,"");
       v=v.replace(/^(\d{2})(\d)/g,"($1) $2");
       v=v.replace(/(\d)(\d{4})$/,"$1-$2");
       return v;
   }
    function mcpf(v){
       if(v.length >=15){  
         v = v.substring(0,(v.length - 1));
         return v;
       }
       v=v.replace(/\D/g,""); 
       v=v.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/,"$1.$2.$3-$4");
       return v;
    }
    function dnasc(v){
       if(v.length >=10){      
         v = v.substring(0,(v.length - 1));
         return v;
       }
       v=v.replace(/\D/g,""); 
       v=v.replace(/^(\d{2})(\d{2})(\d{4})/,"$1/$2/$3");  
       return v;
   }
    function mrg(v){
       if(v.length >=13){
         v = v.substring(0,(v.length - 1));
         return v;
       }
       v=v.replace(/^(\d{2})(\d{3})(\d{3})(\d{1})/,"$1.$2.$3-$4");
       return v;
   }
   function id( el ){
     return document.getElementById( el );
   }
   window.onload = function(){
      mascara( id('custo'), mmoney );
      
      id('sal_base').onkeypress = function(){ 
          mascara( this, mmoney );
      }
      id('custo').onkeypress = function(){ 
          mascara( this, mmoney );
      }
      id('cpf').onkeypress = function(){ 
          mascara( this, mcpf );
      }
      
      id('telefone').onkeypress = function(){
          mascara( this, mtel );
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
</script>

<body>	
			<?php include_once("../view/topo.php"); ?>

			<div id="content">                                               
            <div class="formulario">
            
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){?>
            	<?php 
                     $id = $_GET['id'];
                     $material = new Material();
                     $material = $material->get_material_id($id);
                     $id = $material->id;
                     $nome = $material->nome;
                   
                     
                     
                     
                     $u_m = new Unidade_medida(); //u_m UNIDADE DE MEDIDA
                     $u_m = $u_m->get_unidade_medida_by_id($material->id_unidade_medida);
            	 ?>

                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR MATERIAL</span></div></div>
                       <form method="POST" id="add_material" action="add_material.php" onsubmit="return validate(this)">
                            
                            <input type="hidden" id="tipo" name="tipo" value="editar">
                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">                             
                            <table border="0">
                                <tr><td><span>Nome:</span></td> <td><input type="text" name="nome" id="nome"  value="<?php echo $nome ?>"></td></tr>  
                                
                                <tr><td><span>Unidade de medida:</span></td><td><select id="medida" name="medida"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $medida = new Unidade_medida();
                                       $medida = $medida->get_all_unidade_medida();
                                       for ($i=0; $i < count($medida) ; $i++) { 
                                          echo '<option value="'.$medida[$i][0].'">'.$medida[$i][2].'</option>';
                                       }
                                     ?>
                                       <?php echo "<script> carregaU_M('".$u_m->id."'); </script>" ?> 
                                 </select><td></tr>
                            
                           <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Editar"> <input type="button" name="button" class="button" onclick="window.location.href='add_material.php'" id="button" value="Cancelar"></td></tr>  
                            </table>                            
                       </form>              
            <?php }else{ ?>       
                
                
               
                
                       <form method="POST" class="add_material" id="add_material" name="add_material" action="add_material.php" onsubmit="return valida(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">MATERIAIS</span></div></div>
                         <div id="menu-materiais" name="menu-materiais" class="menu-materiais">
                    <span style="margin-left: 15%;"><b>Nome</span>
                    <span style="margin-left: 4%;">Unidade</span>
                    <span style="margin-left: 2%;">Empresa</span>
                    
                    

                </div>
                         <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                        <?php 
                        $limite = 1;
                        if(isset($_POST['quantidade'])){
                            $limite = $_POST['quantidade'];
                        }
                       
                        ?> 
                         
                         <div><span style='margin-top:20px;'>Quantos materias deseja adicionar ?</span>
                            <select name="quantidade" style='margin-top:20px; margin-left: 20px;'>
                                <option value='5'>5</option>
                                <option value='10'>10</option>
                                <option value='15'>15</option>                                
                            </select>
                             <input type="submit" value="ir">
                        </div>
                        <?php
                        
                       for($j = 0 ; $j<$limite; $j++){ //* Dentro deste for os J e contador para deixar os names e ids de input *//
                             ?>
                         
                          <table border="0">                          
                            <tr><td><input type="text" name="<?php echo $j.":nome" ?>" id="<?php echo $j.":nome" ?>"></td><td>
                                  <select id="<?php echo $j.":medida" ?>" name="<?php echo $j.":medida" ?>"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $medida = new Unidade_medida();
                                       $medida = $medida->get_all_unidade_medida();
                                       for ($i=0; $i < count($medida) ; $i++) { 
                                          echo '<option value="'.$medida[$i][0].'">'.$medida[$i][2].'</option>';
                                       }
                                     ?>
                                     
                                 </select></td>
                                 
                              <td>
                                  <select id="<?php echo $j.":empresa" ?>" name="<?php echo $j.":empresa" ?>"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }      
                                     ?>                                      
                                 </select>
                                          <?php echo "<script>carregaEmp(".$_SESSION['id_empresa'].','.$j.")</script>"; ?>
                              </td>
                              </tr>
                              
                             
                          </table>
                            <?php
                        }
                        ?>
                      
                          <div colspan="3" style=" margin-top: 10px;"><input type="submit" name="button" class="button" id="button" value="Cadastrar">
                          <input type="button" name="button" class="button" onclick="window.location.href='add_material.php'" id="button" value="Cancelar"></div>
                       </form>      
     
            <?php }?>               
			
			<?php 
                        
                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){ //* Recebendo comando POST e verificando condição para adição
                    
                    $i = 0; $adicionados=0;
                    foreach ($_POST as $key => $value){
                        
                        if($key != "quantidade" && $key != "tipo" && $key != "button" ){ /* Comando para não ajudar o array sem entrtar quantidade tipo e button**/
                         
                         $data = explode(":",$key);
                                                    
                          if($data[1] == "nome"){
                              
                             $nome = $value;
                             $i++;
                          }
                           if($data[1] == "medida"){
                               $medida = $value;
                             $i++;
                          }
                           if($data[1] == "empresa"){                              
                               $empresa = $value."<br>";
                              $i++;
                          }
                          if($i == 3){                                                                  /*condição de adição, quando naa estiver vazio*/
                              if($nome != "" && $medida != "no_sel" && $empresa != "no_sel"){
                                $material = new Material();
                                $material->add_material($nome, $medida, $empresa);
                                if($material->add_material_bd()){
                                    $adicionados++;
                                }
                                }
                            $i = 0;
                          }                          
                         }
                        }
                        if($adicionados != 0){
                            echo '<script>alert("Adicionado com sucesso!")</script>';
                        }
                    }
                   
                if(isset($_POST['tipo']) && $_POST['tipo'] == "editar"){
                    
                	if(isset($_POST['id'])){
                              
                            if(validate()){
                               $valor_custo = new Valor_custo();
                               $material = new Material();
                               $id = $_POST['id'];
                               $nome = $_POST['nome'];
                               $id_unidade_medida = $_POST['medida'];
                     
                              if($material->atualiza_material($nome, $id_unidade_medida, $id )){                                 
                              }else{
                                 echo '<div class="msg">Falha na atualização!</div>';
                              }
                              
	                       }
	                   }                         
                        }
	           	
		 		?>
	 	    </div> 
                         <?php include_once("informacoes_material.php") ?> 
                    </div> 

</body>
</html>