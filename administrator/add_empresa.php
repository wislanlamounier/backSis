<?php 
include("restrito.php");
require_once("../model/class_cliente.php");
require_once("../model/class_endereco_bd.php");
require_once("../model/class_estado_bd.php");
require_once("../model/class_cidade_bd.php");

	function validade(){
   if(!isset($_POST['nome_fantasia']) || $_POST['nome_fantasia'] == ""){
         return false;
   }
   if(!isset($_POST['razao_social']) || $_POST['razao_social'] == ""){
         return false;
   }
   return true;
	}

 ?>
 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>Principal</title>
 	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style.css"> 	
 </head>
 

 
 <script type="text/javascript"> 
 function confirma(id,nome){

       if(confirm("Excluir Empresa "+nome+" , tem certeza?")){
          var url = '../ajax/ajax_excluir_Empresa.php?id='+id+'&nome='+nome;  //caminho do arquivo php que irá buscar as cidades no BD
          $.get(url, function(dataReturn) {
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
    }


function valida(f){
	        var erros = 0;
	        var msg = "";
	          for (var i = 0; i < f.length; i++) {
	          	if(f[i].name == "razao_social"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "nome_fantasia"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "tel"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "cnpj"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "inscricao_estadual"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "inscricao_municipal"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "rua"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "bairro"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "cep"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	          }
	          if(f[i].name == "numero"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         if(f[i].name == "nome_resp"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "email_resp"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "datanasc_resp"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
		        if(f[i].name == "cpf_resp"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "estado"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "cidade"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}
	         	if(f[i].name == "tel_resp"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
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
		function validarCPF(cpf) {
   
		    cpf = cpf.replace(/[^\d]+/g,'');    
		    if(cpf == '') return false; 
		    // Elimina CPFs invalidos conhecidos    
		    if (cpf.length != 11 || 
		        cpf == "00000000000" || 
		        cpf == "11111111111" || 
		        cpf == "22222222222" || 
		        cpf == "33333333333" || 
		        cpf == "44444444444" || 
		        cpf == "55555555555" || 
		        cpf == "66666666666" || 
		        cpf == "77777777777" || 
		        cpf == "88888888888" || 
		        cpf == "99999999999")
		            return false;       
		    // Valida 1o digito 
		    add = 0;    
		    for (i=0; i < 9; i ++)       
		        add += parseInt(cpf.charAt(i)) * (10 - i);  
		        rev = 11 - (add % 11);  
		        if (rev == 10 || rev == 11)     
		            rev = 0;    
		        if (rev != parseInt(cpf.charAt(9)))     
		            return false;       
		    // Valida 2o digito 
		    add = 0;    
		    for (i = 0; i < 10; i ++)        
		        add += parseInt(cpf.charAt(i)) * (11 - i);  
		    rev = 11 - (add % 11);  
		    if (rev == 10 || rev == 11) 
		        rev = 0;    
		    if (rev != parseInt(cpf.charAt(10)))
		        return false;       
		    return true;   
		}

	// mascaras
      function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
      }
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
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
       function mtel(v){
           if(v.length >=15){                                          // alert("mtel")
             v = v.substring(0,(v.length - 1));
             return v;
           }
           v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
           v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
           v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
           
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
        function mcnpj(v){
           if(v.length >=19){                                          // alert("mtel")
             v = v.substring(0,(v.length - 1));
             return v;
           }
           v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
           v=v.replace(/^(\d{2})(\d{3})/g,"$1.$2."); 
           v=v.replace(/(\d{3})(\d{4})/,"$1/$2"); 
           v=v.replace(/(\d)(\d{2})$/,"$1-$2"); 
           
           return v;
       }
       function mnum(v){
          if(v.length >=19){                                          // alert("mtel")
             v = v.substring(0,(v.length - 1));
             return v;
          }
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          return v;
       }
        
       function id( el ){
         // alert("id")
         return document.getElementById( el );
       }
       function mcep(v){
          if(v.length >= 10){
            v=v.substring(0,(v.length - 1));
            return v;
          }
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          v=v.replace(/^(\d{5})(\d{3})$/,"$1-$2");

          return v;
       }
       window.onload = function(){
          
          id('tel').onkeypress = function(){
              mascara( this, mtel );
          }
          id('cnpj').onkeypress = function(){
              mascara( this, mcnpj );
          }
          id('numero').onkeypress = function(){
              mascara( this, mnum );
          }
          id('cep').onkeypress = function(){
            mascara( this, mcep );
          }         
        }
      //fim mascaras

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
      var cidade = document.getElementById("cidade").value;

      for (var i = 0; i < 1000; i++)
      {
        if (combo.options[i].value == cidade)
        {
          combo.options[i].selected = true;
          break;
        }
      }
      
    }

    function carregaUf(uf){
      var combo = document.getElementById("estado");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == uf)
        {
          combo.options[i].selected = true;
          
          break;
        }
      }
      buscar_cidades();
    } 
    function carregaResponsavel(id_resp){
      var combo = document.getElementById("responsavel");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == id_resp)
        {
          combo.options[i].selected = true;
          
          break;
        }
      }
    }
    function disparaLoadCidade(){
      setTimeout(function() {
         carregaCidade();
        }, 100);

    }
 </script>

 <body onload="disparaLoadCidade()">  		
 		<?php include_once("../view/topo.php"); ?>
 		<div class="formulario">
              		<?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){ ?> 
              		 	<?php  
                        $id = $_GET['id'];
                        $empresa = new Empresa();
                        $empresa = $empresa->get_empresa_by_id($id);
                        $endereco = new Endereco();
                        $endereco = $endereco->get_endereco($empresa->id_endereco);

                        echo '<input type="hidden" id="id_cidade" value="'.$endereco[0][2].'">';                        
                     	?>
                     <form method="POST" id="ad_emp" name="add_empresa" action="add_empresa.php" onsubmit="return valida(this)">
					 <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Editar Empresa</span></div></div>
					 <input type="hidden" name="tipo" value="editar">
					 <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
					 <input type="hidden" id="id_endereco" name="id_endereco" value="<?php echo $empresa->id_endereco; ?>"> 	                 
	                 <table border='1' style="width:100%">                  
                     <tr> <td><span>Razão Social:</span></td> <td colspan="3"><input style="width:100%" type="text" id="razao_social" name="razao_social" value="<?php echo $empresa->razao_social; ?>" ></td></tr> <!-- nome -->
                     <tr> <td><span>Nome Fantasia:</span></td> <td><input style="width:100%" type="text" id="nome_fantasia" name="nome_fantasia"  value="<?php echo $empresa->nome_fantasia; ?>"></td></tr> <!-- CPF -->
                     <tr> <td><span>CNPJ:</span></td> <td><input style="width:100%" type="text" id="cnpj" name="cnpj"value="<?php echo $empresa->cnpj; ?>"></td></tr> <!-- RG -->
                     <tr> <td><span>Inscrição Estadual:</span></td> <td colspan="3"><input style="width:100%" type="text" id="inscricao_estadual" name="inscricao_estadual" value="<?php echo $empresa->ins_estadual; ?>" > </td></tr> <!-- data de emissão do rg -->
                     <tr> <td><span>Inscricao Municipal:</span></td> <td colspan="3"><input style="width:100%" type="text" id="inscricao_municipal" name="inscricao_municipal" value="<?php echo $empresa->ins_municipal; ?>"> </td></tr> <!-- Numero do titulo eleitoral -->
                     <tr> <td><span>Telefone:</span></td> <td><input style="width:100%" type="text" id="tel" name="tel" value="<?php echo $empresa->telefone; ?>"></td></tr>
                     <tr><td colspan="2"><span><b>Endereço</b></span></td></tr>
                     <tr><td> <span>Rua: </span></td><td colspan="3"><input style="width:100%" value="<?php echo $endereco[0][0]; ?>" type="text" id="rua" name="rua" > </td></tr>
                     <tr><td> <span>Numero: </span></td><td colspan="3"><input  style="width:100%" value="<?php echo $endereco[0][1]; ?>" type="number" id="numero" name="numero" > </td></tr>
                     <tr><td> <span>Bairro: </span></td><td colspan="3"><input style="width:100%" value="<?php echo $endereco[0][4]; ?>" type="text" id="bairro" name="bairro" > </td></tr>
                     <tr><td> <span> CEP </span></td><td><input type="text" style="width:100%" id="cep" name="cep" value="<?php echo $endereco[0][5]; ?>"> </td></tr>                     
                     <tr><td><span>Estado:</span></td>
                        <td>
                           <?php //buscar array de CBO
                              $estado = new Estado();
                              $estados = $estado->get_name_all_uf();
                           ?>
                           <select name="estado" id="estado" onchange="buscar_cidades()" style="width:100%">
                              <option>Selecione um estado</option>
                              <?php 
                                 foreach($estados as $key => $estado){
                                    echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                           <?php echo "<script> carregaUf('".$endereco[0][3]."'); </script>" ?>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                     </tr>
                     <tr><td><span>Cidades:</span></td>                       
                        <td colspan="3">
                           <div id="load_cidades" style="width:100%">
                             <select name="cidade" id="cidade" style="width:100%">
                               <option value="">Selecione um estado</option>
                             </select>
                           </div>
                        </td>
                         <?php echo "<script> carregaCidade('".$endereco[0][2]."'); </script>" ?>
                     </tr>
                     <tr><td><span><b>Responsável</b></span></td>
					 <td><select id="responsavel" name="responsavel" style="width:100%">
                              <option value="no_res">Selecione o Responsável</option>
                              <?php 
                                 $func = new Funcionario();
                                 $func = $func->get_admin();
                                 for ($i=0; $i < count($func) ; $i++) { 
                                    echo '<option value="'.$func[$i][0].'">'.$func[$i][1].'</option>';
                                 }
                               ?>
                           </select>
                       </td>
                       <?php echo "<script> carregaResponsavel('".$empresa->id_responsavel."'); </script>" ?>
                     </tr>
					 <tr><td colspan="2" style="text-align:center"><input  class="button" type="submit" value="editar"><input class="button" type="button" value="Cancelar"></td></tr> 
                	 </table>
                	 </form>
                	 
					<?php }else{ ?> <!-- CADASTRAR Empresa -->					
					<form method="POST" id="ad_emp" name="add_empresa" action="add_empresa.php" onsubmit="return valida(this)">
					 <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Adicionar Empresa</span></div></div>
					 <input type="hidden" name="tipo" value="cadastrar">	                 
	                 <table border='0' style="width:100%">                  
                     <tr> <td><span>Razão Social:</span></td> <td colspan="3"><input style="width:100%" type="text" id="razao_social" name="razao_social"  ></td></tr> <!-- nome -->
                     <tr> <td><span>Nome Fantasia:</span></td> <td><input style="width:100%" type="text" id="nome_fantasia" name="nome_fantasia"></td></tr> <!-- CPF -->
                     <tr> <td><span>CNPJ:</span></td> <td><input style="width:100%" type="text" id="cnpj" name="cnpj"></td></tr> <!-- RG -->
                     <tr> <td><span>Inscrição Estadual:</span></td> <td colspan="3"><input style="width:100%" type="text" id="inscricao_estadual" name="inscricao_estadual"> </td></tr> <!-- data de emissão do rg -->
                     <tr> <td><span>Inscricao Municipal:</span></td> <td colspan="3"><input style="width:100%" type="text" id="inscricao_municipal" name="inscricao_municipal" ></td></tr> <!-- Numero do titulo eleitoral -->
                     <tr> <td><span>Telefone:</span></td> <td><input style="width:100%" type="text" id="tel" name="tel"></td></tr>
                     <tr><td colspan="2"><span><b>Endereço</b></span></td></tr>
                     <tr><td> <span>Rua: </span></td><td colspan="3"><input style="width:100%" type="text" id="rua" name="rua" ></td></tr>
                     <tr><td> <span>Numero: </span></td><td colspan="3"><input style="width:100%" type="number" id="numero" name="numero"   ></td></tr>
                     <tr><td> <span>Bairro: </span></td><td colspan="3"><input style="width:100%" type="text" id="bairro" name="bairro" > </td></tr>
                     <tr><td> <span> CEP </span></td><td><input style="width:100%" type="text" id="cep" name="cep"> </td></tr>                     
                     <tr><td><span>Estado:</span></td>
                        <td>
                           <?php //buscar array de CBO
                              $estado = new Estado();
                              $estados = $estado->get_name_all_uf();
                           ?>
                           <select name="estado" id="estado" onchange="buscar_cidades()" style="width:100%">
                              <option>Selecione um estado</option>
                              <?php 
                                 foreach($estados as $key => $estado){
                                    echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                     </tr>
                     <tr><td><span>Cidades:</span></td>                       
                        <td colspan="3">
                           <div id="load_cidades">
                             <select name="cidade" id="cidade" style="width:100%">
                               <option value="">Selecione um estado</option>
                             </select>
                           </div>
                        </td>
                     </tr>
                     <tr><td><span><b>Responsável</b></span></td>
					 <td><select id="responsavel" name="responsavel" style="width:100%">
                              <option value="no_res">Selecione o Responsável</option>
                              <?php 
                                 $func = new Funcionario();
                                 $func = $func->get_admin();
                                 for ($i=0; $i < count($func) ; $i++) { 
                                    echo '<option value="'.$func[$i][0].'">'.$func[$i][1].'</option>';
                                 }
                               ?>
                           </select>
                       </td>
                     </tr>
					 <tr><td colspan="2" style="text-align:center"><input  class="button" type="submit" value="Cadastrar"><input class="button" type="button" value="Cancelar"></td></tr> 					 	
                	 </table>
                	 </form>               	
                	 

			 		<?php }?>
			 				 		
			 		
            		<?php
                    if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                    if(validade()){                     
                     $empresa = new Empresa();
                     $cnpj = $_POST['cnpj'];
                     $razao_social = $_POST['razao_social'];
                     $nome_fantasia = $_POST['nome_fantasia'];
                     $ins_estadual = $_POST['inscricao_estadual'];
                     $ins_municipal = $_POST['inscricao_municipal'];
                     $telefone = $_POST['tel'];
                     $id_responsavel = $_POST['responsavel'];
                     $endereco = new Endereco();
					 $bairro = $_POST['bairro'];
					 $rua = $_POST['rua'];
					 $numero = $_POST['numero'];
					 $cidade_id = $_POST['cidade']; 
					 $cep = $_POST['cep'];	
					 $endereco->add_Endereco($bairro, $rua, $numero, $cidade_id, $cep);	
					 $id_endereco = $endereco->add_endereco_bd();                     
                     $empresa->add_empresa($cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal,  $telefone, $id_responsavel, $id_endereco);
                     if($empresa->add_empresa_bd()){
                        echo '<div class="msg">Empresa cadastrada com sucesso!</div>';
                     }else{
                        echo '<div class="msg">Erro ao cadastrar empresa!</div>';
                     }
                     }
                     }
                  	
                   	if(isset($_POST["tipo"]) && $_POST['tipo'] == "editar"){
                   		if(isset($_POST['id'])){
                            if(validade()){
                                 $empresa = new Empresa();
                                 $endereco = new Endereco();

                                 $id = $_POST['id'];
                                 $cnpj = $_POST['cnpj'];
                                 $razao_social = $_POST['razao_social'];
                                 $nome_fantasia = $_POST['nome_fantasia'];
                                 $ins_estadual = $_POST['inscricao_estadual'];
                                 $ins_municipal = $_POST['inscricao_municipal'];
                                 $telefone = $_POST['tel'];
                                 $id_responsavel = $_POST['responsavel'];                                 
                                 $rua = $_POST['rua'];
                                 $num = $_POST['numero'];
                                 $id_cidade = $_POST['cidade'];
                                 $bairro = $_POST['bairro'];
                                 $cep = $_POST['cep'];
                                 

                                 $existe_endereco = $endereco->verifica_endereco($_POST['id_endereco']);
                                 if($existe_endereco){
                                    $endereco->atualiza_endereco($rua, $num, $id_cidade, $_POST['id_endereco'], $bairro, $cep );
                                    $id_endereco = $_POST['id_endereco'];
                                }else{
                                    $endereco->add_endereco($rua, $num, $id_cidade, $bairro, $cep);
                                    $id_endereco = $endereco->add_endereco_bd();
                                }
                                 
                                 // $empresa->atualiza_empresa($cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal, $telefone, $id_responsavel);
                                 
                                 if($empresa->atualiza_empresa($id, $cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal, $telefone, $id_responsavel, $id_endereco)){
                                    echo '<div class="msg">Empresa atualizada com sucesso!</div>';
                                 }else{
                                    echo '<div class="msg">Erro ao atualizar empresa!</div>';
                                 }
                                 // echo $empresa->printEmpresa();
                              
                            }
                          }
                   	}
                   	?>
            </div>   
 			<?php include("informacoes_empresa.php");?> 
 </body>
 </html>