<?php
include("restrito.php"); 

include_once("../model/class_sql.php");
include("../model/class_empresa_bd.php");
include("../model/class_unidade_medida_bd.php");
include("../model/class_material_bd.php");
include("../model/class_tipo_custo_bd.php");
include("../model/class_valor_custo_bd.php");

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
                          if(f[i].name == "valor_custo" && f[i].value == ""){
                msg += "Insira o valor de custo do funcionario!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "valor_custo" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
              
              if(f[i].name == "tipo_custo" && f[i].value == "no_sel"){
                msg += "Insira tip de custo!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "tipo_custo" && f[i].value != "no_sel"){
                f[i].style.border = "1px solid #898989";
              }
                  }
                  		
                    if(erros>0){
                        return false;
			}else{
                    return true;
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
                     $id_valor_custo = $material->id_valor_custo;
                     
                     $valor_custo = new Valor_custo();
                     $valor_custo = $valor_custo->get_valor_custo_id($id_valor_custo);
                     
                     
                     
                     $u_m = new Unidade_medida(); //u_m UNIDADE DE MEDIDA
                     $u_m = $u_m->get_unidade_medida_by_id($material->id_unidade_medida);
            	 ?>

                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR MATERIAL</span></div></div>
                       <form method="POST" id="add_material" action="add_material.php" onsubmit="return validate(this)">
                            <input type="hidden" id="tipo" name="tipo" value="editar">
                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>"> 
                            <input type="hidden" id="id_custo" name="id_custo" value="<?php echo $valor_custo->id ?>">
                            <table border="0">
                                <tr><td><span>Nome:</span></td> <td><input type="text" name="nome" id="nome"  value="<?php echo $nome ?>"></td></tr>                                
                                <tr><td><span>Valor de Custo:</span></td> <td><input type="text" name="valor_custo" id="valor_custo" value="<?php echo  $valor_custo->valor; ?>"></td>
                                  <td>
                                      <select id="tipo_custo" name="tipo_custo"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $tipo_custo = new Tipo_custo();
                                       $tipo_custo = $tipo_custo->get_all_tipo_custo();                                       
                                       foreach ($tipo_custo as $key => $value) {
                                           echo '<option value="'.$value[0].'">'.$value[1].'</option>';
                                       }
//                                       for ($i=0; $i < count($empresa) ; $i++) { 
//                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
//                                       }
                                     ?>
                                    <?php echo "<script> carregaTipo_custo('".$valor_custo->id_tipo_custo."'); </script>" ?> 
                                 </select>
                                  </td>
                              </tr>
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
                        <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                          <table border="0">                          
                            <tr><td><span>Nome:</span></td> <td><input type="text" name="nome" id="nome"></td><td><span>Unidade de medida:</span></td><td>
                                  <select id="medida" name="medida"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $medida = new Unidade_medida();
                                       $medida = $medida->get_all_unidade_medida();
                                       for ($i=0; $i < count($medida) ; $i++) { 
                                          echo '<option value="'.$medida[$i][0].'">'.$medida[$i][2].'</option>';
                                       }
                                     ?>
                                 </select><td></tr>
  
                              <tr><td><span>Empresa:</span></td><td>
                                  <select id="empresa" name="empresa"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }
                                     ?>
                                 </select>
                              </td>
                              </tr>
                              <tr><td><span>Valor de Custo:</span></td> <td><input type="text" name="valor_custo" id="valor_custo"></td>
                                  <td>
                                      <select id="tipo_custo" name="tipo_custo"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $tipo_custo = new Tipo_custo();
                                       $tipo_custo = $tipo_custo->get_all_tipo_custo();                                       
                                       foreach ($tipo_custo as $key => $value) {
                                           echo '<option value="'.$value[0].'">'.$value[1].'</option>';
                                       }
//                                       for ($i=0; $i < count($empresa) ; $i++) { 
//                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
//                                       }
                                     ?>
                                 </select>
                                      
                                  </td>
                              </tr>
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_material.php'" id="button" value="Cancelar"></td></tr>
                       </form>          
                       
            <?php }?>               
			
			<?php 
                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                   if(validate()){

                    if($_POST['medida']!= "no_sel" && $_POST['empresa']!="no_sel"){
                     $material = new Material();
                     
                     $valor_custo = new Valor_custo();                                        
                     if(isset($_POST['valor_custo'])!= ""){
                         $id_tipo_custo = $_POST['tipo_custo'];
                         $valor = $_POST['valor_custo'];
                         $valor_custo->add_valor_custo($valor, $id_tipo_custo);
                         $id_valor_custo = $valor_custo->add_valor_custo_bd();
                     }
                     $material->add_material($_POST['nome'], $id_valor_custo ,$_POST['medida'], $_POST['empresa']); 
                      
                     if($material->add_material_bd()){
                        echo '<div class="msg">Cadastrado com sucesso!</div>';
                     }else{
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     }
                  	}else{
                
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     } 
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
                               
                               $id_custo = $_POST['id_custo'];
                               
                                   if(isset($_POST['valor_custo'])!= ""){
                                   
                                     $id_tipo_custo = $_POST['tipo_custo'];
                                     $valor = $_POST['valor_custo'];
                                     $id_custo = $valor_custo->atualiza_valor_custo($valor, $id_tipo_custo, $id_custo);
                                };
                     
                              if($material->atualiza_material($nome, $id_custo, $id_unidade_medida, $id )){                                 
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