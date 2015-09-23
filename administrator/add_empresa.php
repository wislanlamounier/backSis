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
   if(!isset($_POST['cnpj']) || $_POST['cnpj'] == ""){
         return false;
   }
   if(!isset($_POST['inscricao_estadual']) || $_POST['inscricao_estadual'] == ""){
         return false;
   }
   if(!isset($_POST['inscricao_municipal']) || $_POST['inscricao_municipal'] == ""){
         return false;
   }
   if(!isset($_POST['tel']) || $_POST['tel'] == ""){
         return false;
   }
   if(!isset($_POST['rua']) || $_POST['rua'] == ""){
         return false;
   }
   if(!isset($_POST['numero']) || $_POST['numero'] == ""){
         return false;
   }
   if(!isset($_POST['bairro']) || $_POST['bairro'] == ""){
         return false;
   }
   if(!isset($_POST['cep']) || $_POST['cep'] == ""){
         return false;
   }
   if(!isset($_POST['estado']) || $_POST['estado'] == ""){
         return false;
   }
   if(!isset($_POST['cidade']) || $_POST['cidade'] == ""){
         return false;
   }
   if(!isset($_POST['responsavel']) || $_POST['responsavel'] == ""){
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
              if(f[i].name == "nome_fantasia" && f[i].value == ""){
                msg += "Insira um Nome Fantasia para add_empresa_bd!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "nome Fantasia" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

             
              if(f[i].name == "inscricao_municipal"){
                if(f[i].value == ""){
                  msg += "Preencha o campo da inscrição municipal!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "inscricao_estadual"){
                if(f[i].value == ""){
                  msg += "Preencha o campo inscricao_estadual!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "tel"){
                if(f[i].value == ""){
                  msg += "Preencha o campo de telefone!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "cnpj"){
                if(f[i].value == ""){
                  msg += "Preencha o do cnpj!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "numero"){
                if(f[i].value == ""){
                  msg += "Preencha o campo de telefone!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }if(f[i].value <= 0){
                        msg += "Insira um valor acima de 0 no campo Número!\n";
                        f[i].style.border = "1px solid #FF0000";
                        erros++;
                    }else{
                        f[i].style.border = "1px solid #898989";
                    }
                  }
              if(f[i].name == "razao_social"){
                if(f[i].value == ""){
                  msg += "Preencha o campo de Razão Social!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "responsavel"){
                if(f[i].value == "no_res"){
                  msg += "Escolha uma opção no campo Responsavel!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
               if(f[i].name == "estado" && f[i].value == "Selecione um estado"){
                msg += "Selecione um Estado\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "estado" && f[i].value != "Selecione um estado"){
                f[i].style.border = "1px solid #898989";
              }

              if(f[i].name == "cidade"){
                if(f[i].value == ""){
                  msg += "Escolha uma cidade!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "telefone" && f[i].value == ""){
                msg += "Insíra um Telefone!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "telefone" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

              if(f[i].name == "rua" && f[i].value == ""){
                msg += "Preencha o campo Rua\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "rua" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

              if(f[i].name == "bairro"){
                  if(f[i].value == ""){
                     f[i].style.border = "1px solid #FF0000";
                     msg += "Selecione um bairro\n";
                     erros++;
                  }else{
                     f[i].style.border = "1px solid #898989";
                  }
               }
               if(f[i].name == "cep"){
                  if(f[i].value == ""){
                      msg += "Selecione um cep\n";
                     f[i].style.border = "1px solid #FF0000";
                     erros++;
                  }else{
                     f[i].style.border = "1px solid #898989";
                  }
               }
          }
          if(erros>0){
            
              alert(msg);
            
            return false;
          }
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
        var cidade = document.getElementById("id_cidade").value;
  
        for (var i = 0; i < 1000; i++)
         {
           if (combo.options[i].value == cidade)
               {
               combo.options[i].selected = true;
               break;
             }
           } 
      }
  function disparaLoadCidade(){
      setTimeout(function() {
         carregaCidade();
        }, 500);
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
	                 <table border='0' style="width:100%">                  
                     <tr> <td><span>Razão Social:</span></td> <td colspan="3"><input style="width:100%" type="text" id="razao_social" name="razao_social" value="<?php echo $empresa->razao_social; ?>" ></td></tr> <!-- nome -->
                     <tr> <td><span>Nome Fantasia:</span></td> <td><input style="width:100%" type="text" id="nome_fantasia" name="nome_fantasia"  value="<?php echo $empresa->nome_fantasia; ?>"></td></tr> <!-- CPF -->
                     <tr> <td><span>CNPJ:</span></td> <td><input style="width:100%" type="text" id="cnpj" name="cnpj"value="<?php echo $empresa->cnpj; ?>"></td></tr> <!-- RG -->
                     <tr> <td><span>Inscrição Estadual:</span></td> <td colspan="3"><input style="width:100%" type="text" id="inscricao_estadual" name="inscricao_estadual" value="<?php echo $empresa->ins_estadual; ?>" > </td></tr> <!-- data de emissão do rg -->
                     <tr> <td><span>Inscrição Municipal:</span></td> <td colspan="3"><input style="width:100%" type="text" id="inscricao_municipal" name="inscricao_municipal" value="<?php echo $empresa->ins_municipal; ?>"> </td></tr> <!-- Numero do titulo eleitoral -->
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
              		   <tr>
                          <td colspan="2" style="text-align:center">
                              <input  class="button" type="submit" value="Salvar" >
                              <input class="button" name="button" onclick="window.location.href='add_empresa.php'" id="button" value="Cancelar">
                          </td>
                      </tr> 
                	 </table>
                	 </form>
                	 
					<?php }else if(1 != 1){ ?> <!-- CADASTRAR Empresa NÃO SERÁ DISPONIVEL -->
					<form method="POST" id="ad_emp" name="add_empresa" action="add_empresa.php" onsubmit="return valida(this)">
					 <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Adicionar Empresa</span></div></div>
					 <input type="hidden" name="tipo" value="cadastrar">	                 
	                 <table border='0' style="width:100%">                  
                     <tr> <td><span>Razão Social:</span></td> <td colspan="3"><input style="width:100%" type="text" id="razao_social" name="razao_social"  ></td></tr> <!-- nome -->
                     <tr> <td><span>Nome Fantasia:</span></td> <td colspan="3"><input style="width:100%" type="text" id="nome_fantasia" name="nome_fantasia"></td></tr> <!-- CPF -->
                     <tr> <td><span>CNPJ:</span></td> <td><input style="width:100%" type="text" id="cnpj" name="cnpj"></td></tr> <!-- RG -->
                     <tr> <td><span>Inscrição Estadual:</span></td> <td ><input style="width:100%; text-transform:uppercase;"  type="text" id="inscricao_estadual" name="inscricao_estadual"> </td><td><span>Inscrição Municipal:</span></td> <td><input style="width:100%; text-transform:uppercase; padding-left:-30px;" type="text" id="inscricao_municipal" name="inscricao_municipal" ></td></tr> <!-- data de emissão do rg -->
                     <tr> </tr> <!-- Numero do titulo eleitoral -->
                     <tr> <td><span>Telefone:</span></td><td ><input style="width:100%" type="text" id="tel" name="tel"></td></tr>
                     <tr><td colspan="2"><span><b>Endereço</b></span></td></tr>
                     <tr><td> <span>Rua: </span></td><td colspan="1"><input style="width:100%" type="text" id="rua" name="rua" ></td><td><span>Numero:</span><input style="width:40%" type="number" id="numero" name="numero"></td></tr>
                     <tr></tr>
                     <tr><td> <span>Bairro: </span></td><td colspan="3"><input style="width:100%" type="text" id="bairro" name="bairro" > </td></tr>
                     <tr><td> <span> CEP </span></td><td><input style="width:100%" type="text" id="cep" name="cep"> </td></tr>                     
                     <tr><td><span>Estado:</span></td>
                        <td colspan="2">
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
                        <td colspan="2">
                           <div id="load_cidades">
                             <select name="cidade" id="cidade" style="width:100%">
                               <option value="">Selecione um estado</option>
                             </select>
                           </div>
                        </td>
                     </tr>
                     <tr><td><span><b>Responsável</b></span></td>
					 <td colspan="2"><select id="responsavel" name="responsavel" style="width:100%">
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
					            <tr>
                        <td colspan="2" style="text-align:center">
                          <input  class="button" type="submit" value="Cadastrar">
                          <input class="button" name="button" onclick="window.location.href='principal.php'" id="button" value="Cancelar">
                        </td>
                      </tr> 					 	
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
                             $nivel_acesso = $_SESSION['nivel_acesso'];	
                  					 $endereco->add_Endereco($bairro, $rua, $numero, $cidade_id, $cep);	
                  					 $id_endereco = $endereco->add_endereco_bd();                     
                             $empresa->add_empresa($cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal,  $telefone, $id_responsavel, $id_endereco, $nivel_acesso);

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
                                    echo '<script>alert("Empresa atualizada com sucesso")</script>';
                                    echo '<script>window.location.href=\'principal.php\'</script>';
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