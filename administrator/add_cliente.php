<?php
include("restrito.php"); 


// 0 = Acesso Total
// 1 = Acesso ViaCampos
// 2 = Acesso ControlPonto


// if($_SESSION['nivel_acesso'] == 0 || $_SESSION['nivel_acesso'] == 1){

// }

require_once("../model/class_cliente.php");
require_once("../model/class_endereco_bd.php");
require_once("../model/class_estado_bd.php");
require_once("../model/class_cidade_bd.php");


 ?>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style.css">

</head>

<?php 

	function validade(){

		if(isset($_POST['nome'])){return true;}else{return false;}
		if(isset($_POST['data_nasc'])){return true;}else{return false;}
		if(isset($_POST['cpf'])){return true;}else{return false;}
		if(isset($_POST['tel'])){return true;}else{return false;}
		if(isset($_POST['cel'])){return true;}else{return false;}
		if(isset($_POST['bairro'])){return true;}else{return false;}
		if(isset($_POST['rua'])){return true;}else{return false;}
		if(isset($_POST['numero'])){return true;}else{return false;}
		if(isset($_POST['cidade'])){return true;}else{return false;}
		if(isset($_POST['cep'])){return true;}else{return false;}

	}
 ?>

<script type="text/javascript">

	function confirma(id,nome, tipopess){
       if(confirm("Excluir cliente "+nome+" , tem certeza?") ){
          var url = '../ajax/ajax_excluir_cliente.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
          	
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
    }
	
	function tipo_form(){
		
		// if(document.getElementById("fornecedor").checked){
		// 	document.getElementById("fornecedor").value=0;
		// }else{
		// 	document.getElementById("fornecedor").value=1;
		// }

		if(document.getElementById("pessoa_fisica").checked == true){
			document.getElementById("razao_nome").innerHTML = "<span>Nome:</span>";
			document.getElementById("data_fun_data_nasc").innerHTML = "<span>Data de Nascimento:</span>";
			document.getElementById("cnpj_cpf").innerHTML = "<span>CPF:</span>";
			document.getElementById("cnpj").type = "hidden";
			document.getElementById("cnpj").value ="";
			document.getElementById("cpf").type="text";
			document.getElementById("inscricao_estadual_rg").innerHTML = "<span>RG:</span>";			
			document.getElementById("inscricao_estadual").type="hidden";
			document.getElementById("inscricao_estadual").value="";
			document.getElementById("rg").type="text";			
			document.getElementById("inscricao_municipal").type="hidden";
			document.getElementById("inscricao_municipal").value="";
			document.getElementById("inscricao_municipal_nulo").innerHTML = "";

		}

		if(document.getElementById("pessoa_juridica").checked == true){
			document.getElementById("razao_nome").innerHTML = "<span>Razao Social:</span>";
			document.getElementById("data_fun_data_nasc").innerHTML = "<span>Data Fundação:</span>";
			document.getElementById("cnpj_cpf").innerHTML = "<span>CNPJ:</span>";
			document.getElementById("cnpj").type = "text";
			document.getElementById("cpf").value ="";
			document.getElementById("cpf").type="hidden";	
			document.getElementById("inscricao_estadual_rg").innerHTML = "<span>Inscrição Estadual:</span>";
			document.getElementById("inscricao_estadual").name= "inscricao_estadual";
			document.getElementById("inscricao_estadual").type="text";
			document.getElementById("rg").type = "hidden";
			document.getElementById("rg").value = "";
			document.getElementById("inscricao_municipal").type="number";
			document.getElementById("inscricao_municipal_nulo").innerHTML="<span>Inscrição Municipal:</span>";
			document.getElementById("inscricao_municipal").name="inscricao_municipal";		
		}


	}

		

	 	function valida(f){
	        var erros = 0;
	        var msg = "";
	          for (var i = 0; i < f.length; i++) {

	          	//Dados Empresa ou dados Pessoais
	      

	         	if(document.getElementById("pessoa_fisica").checked == true) //
	         	{
	         		
	         	}else{
	         		      if(f[i].name == "nome"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "data_nasc"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "cpf" && document.getElementById("pessoa_juridica").checked != true){
		            if(f[i].value == ""){
		               alert("Digite um cpf");
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
		            if(!validarCPF(f[i].value)){
		               alert("Digite um cpf valido");
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "cel"){
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
		            	      if(f[i].name == "nome"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "data_nasc"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "cpf" && document.getElementById("pessoa_juridica").checked != true){
		            if(f[i].value == ""){
		               alert("Digite um cpf");
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
		            if(!validarCPF(f[i].value)){
		               alert("Digite um cpf valido");
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "cel"){
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

	         	
	        	 }

	         	//Dados de endereço 

	         	if(f[i].name == "bairro"){
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

	         	if(f[i].name == "numero"){
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

	         	if(f[i].name == "cep"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "site"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	//Dados de responsavel

	         	if(f[i].name == "nome_resp"){
		            if(f[i].value == ""){
		               f[i].style.border = "1px solid #FF0000";
		               erros++;
		            }else{
		               f[i].style.border = "1px solid #898989";
		            }
	         	}

	         	if(f[i].name == "cpf_resp"){
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
	         	}

	         	if(f[i].name == "email_resp"){
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

	 	    // inicio mascaras
    function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
      }
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
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
     // alert("id")
     return document.getElementById( el );
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

   window.onload = function(){ 

   	     		
   	  id('cnpj').onkeypress = function(){
              mascara( this, mcnpj );
      }
      id('cpf').onkeypress = function(){
           mascara( this, mcpf );
      }
      id('cpf_resp').onkeypress = function(){
          mascara( this, mcpf );
      }
      id('tel').onkeypress = function(){
          mascara( this, mtel );
      }
      id('cel').onkeypress = function(){
          mascara( this, mtel );
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
    function buscar_cid(id_est){
      var estado = id_est;  //codigo do estado escolhido
      //se encontrou o estado
      if(estado){
        var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function(dataReturn) {
          $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
        });
      }
    }

	function disparaLoadCidade(){
      setTimeout(function() {
         carregaCidade();
         carregaPostosTrabalho();
        }, 100);
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
    }  

</script>
<body>			

	
			<?php include_once("../view/topo.php"); ?>
			<div class='formulario' style="width:500px;">
			<?php if(isset($_GET['tipo']) && $_GET['tipo'] == "editar"){ //editar cliente pessoa fisica?>
					 <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR CLIENTE</span></div></div>

                    <?php 
                     $cli = new Cliente();
                     $cli = $cli->get_cli_id($_GET['id']);//buscando funcionario no banco
                     $endereco = new Endereco();
                     $endereco = $endereco->get_endereco( $cli->id_endereco );
                      
                      echo '<input type="hidden" id="id_cidade" value="'.$endereco[0][2].'">';
                    

                   ?>
    				<form form method="POST" id="add_cliente" action="add_cliente.php" onsubmit="return valida(this)">
    					  <input type="hidden" name="tipo_post" value="editar_pessoa_fisica"><?php //input envia o tipo da requisição, se é add cliente,  edita cliente p/fisica ou edita cliente p/juridica ?>
		                  <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $cli->id; ?>">
		                  <input type="hidden" id="id_endereco" name="id_endereco" value="<?php echo $cli->id_endereco; ?>">
					            <table id="table_dados_pes" class="table_dados_pes" border="0" >
					               <tr><td colspan="2" padding-top:='10px'><span class="dados_cadastrais_title"><b>Dados Cadastrais</b><span></td></tr>
					               <tr> <td ><span>Tipo:</span></td> <td>  
						               <?php if($cli->fornecedor){ ?>
					                          		<input type="checkbox" id="fornecedor" checked name="fornecedor" style="height:12px;"><span>Fornecedor</span>
					                   <?php }else{ ?>
					                          		<input type="checkbox" id="fornecedor"  name="fornecedor" style="height:12px;"><span>Fornecedor</span>
					                   <?php } ?>
					           	   </tr>
					               <tr> <td ><span>Nome:</span></td><td><input type="text" id="nome" name="nome" value="<?php echo $cli->nome; ?>" ></td></tr>
					                <tr> <td ><span>Data Nasc:</span></td> <td><input type="date" id="data_nasc" name="data_nasc" value="<?php echo $cli->data_nasc ?>" ></td></tr>
					                <tr> <td ><span>CPF:</span></td><td><input type="text" id="cpf" name="cpf" value="<?php echo $cli->cpf ?>" ></td></tr> 
					                <tr> <td ><span>Celular:</span></td> <td><input type="text" id="cel" name="cel" value="<?php echo $cli->telefone_cel ?>"></td></tr> 
					                <tr> <td ><span>Telefone:</span></td> <td><input type="text" id="tel" name="tel"value="<?php echo $cli->telefone_com ?>"></td></tr>                         
					                <tr> <td ><span>RG:</span></td> <td><input type="text" id="rg" name="rg" value="<?php echo $cli->rg ?>" ></td></tr>  
					                <tr> <td colspan="2"><span><b>Endereço</b></span></td></tr>
					                <tr> <td ><span>Bairro:</span></td> <td><input type="text" id="bairro" name="bairro"  value="<?php echo $endereco[0][4]; ?>" ></td></tr> 
					                <tr> <td ><span>Rua:</span></td> <td><input type="text" id="rua" name="rua" value="<?php echo $endereco[0][0]; ?>"></td></tr> 
					                <tr> <td ><span>Numero:</span></td> <td><input type="number" id="numero" name="numero" value="<?php echo $endereco[0][1]; ?>" ></td></tr>
					                <tr> <td ><span>UF:</span></td> 
					                  <td>
					                    <select id="estado" name="estado" onchange="buscar_cidades()">
					                      <option>Selecione o Estado</option>
					                      <?php 
					                         $estado = new Estado();
					                         $estado = $estado->get_name_all_uf();
					                         for( $aux = 0; $aux < count($estado) ; $aux++){
					                          echo '<option value="'.$estado[$aux][0].'">'.$estado[$aux][1].'</option>';
					                         }
					                      ?>
					                    </select>
					                  </td>
					                  <?php echo "<script> carregaUf(".$endereco[0][3].");</script>"; ?>
					                </tr> 
					                <tr> 
					                  <td><span>Cidade:</span></td>
					                  <td>
					                    <div id="load_cidades">
					                        <select name="cidade" id="cidade">
					                          <option value="">Selecione UF</option>
					                        </select>
					                      </div>
					                  </td>
					                  <?php echo "<script> buscar_cid('".$endereco[0][3]."'); </script>";  ?>
					                </tr>                     
					                <tr> <td ><span>CEP:</span></td> <td><input type="number" id="cep" name="cep" value="<?php echo $endereco[0][5]; ?>"></td></tr> 
					                <tr> <td ><span>Site:</span></td> <td><input type="text" id="site" name="site" value="<?php echo $cli->site ?>" ></td></tr>
					                <tr><td colspan="2"><span><b>Responsável</b></span></td></tr>
					                <tr> <td ><span>Nome:</span></td> <td><input type="text" id="nome_resp" name="nome_resp" value="<?php echo $cli->responsavel ?>" ></td></tr> 
					                <tr> <td ><span>CPF:</span></td> <td><input type="text" id="cpf_resp" name="cpf_resp" value="<?php echo $cli->cpf_responsavel ?>" ></td></tr> 
					                <tr> <td ><span>Data Nascimento:</span></td> <td><input type="date" id="datanasc_resp" name="datanasc_resp" value="<?php echo $cli->data_nasc_responsavel ?>" ></td></tr> 
					                <tr> <td ><span>E-mail:</span></td> <td><input type="text" id="email_resp" name="email_resp" value="<?php echo $cli->email_resp ?>"></td></tr>                     
					                <tr><td colspan="2"><span><b>Observação</b></span></td></tr>                     
					                <tr><td colspan="2"> <div align="center"><textarea align="center" rows="4" cols="50" id="observacao" name="observacao"><?php echo $cli->observacao ?></textarea></div> </td></tr>                     
					                <tr>
					                    	 <td colspan="2" style="text-align:center">
					                    	 	<input  class="button" type="submit" value="Editar">
					                    	 	<input class="button" type="button" value="Cancelar">
					                    	 </td>
					                    </tr> 
					           	 </table>
					        </form>



				<?php }else if(isset($_GET['tipo']) && $_GET['tipo'] == "editarj"){ //editar cliente pessoa juridica?>
							<div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR CLIENTE JURIDICO</span></div></div>
							<?php 
			                     $cli = new Cliente();
			                     $cli = $cli->get_cli_jur_id($_GET['id']);//buscando funcionario no banco
			                     $endereco = new Endereco();
			                     $endereco = $endereco->get_endereco( $cli->id_endereco );
			                     echo '<input type="hidden" id="id_cidade" value="'.$endereco[0][2].'">';
			                ?>
						    <form form method="POST" id="edita_cliente_jur" action="add_cliente.php" onsubmit="return valida(this)">
						    		<input type="hidden" name="tipo_post" value="editar_pessoa_juridica"><?php //input envia o tipo da requisição, se é add cliente,  edita cliente p/fisica ou edita cliente p/juridica ?>
						            <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $cli->id; ?>">
						            <input type="hidden" id="id_endereco" name="id_endereco"  value="<?php echo $cli->id_endereco; ?>">
						            <table id="table_dados_pes" class="table_dados_pes" border="0" >
						               <tr><td colspan="2" padding-top:='10px'><span class="dados_cadastrais_title"><b>Dados Cadastrais</b><span></td></tr>
						               <tr> <td ><span>Tipo:</span></td> <td>  
						               <?php if($cli->fornecedor){ ?>
					                          		<input type="checkbox" style="height:12px;" id="fornecedor" checked name="fornecedor"><span>Fornecedor</span>
					                   <?php }else{ ?>
					                          		<input type="checkbox" style="height:12px;" id="fornecedor"  name="fornecedor"><span>Fornecedor</span>
					                   <?php } ?>
					           	   		</tr>
						               <tr> <td ><div id="razao_nome"><span>Razao Social:</span></div></td><td><input type="text" id="nome" name="nome" value="<?php echo $cli->nome; ?>" ></td></tr>
						                   <tr> <td ><div id="data_fun_data_nasc"><span>Data Fundação:</span></div></td> <td><input type="date" id="data_nasc" name="data_nasc" value="<?php echo $cli->data_nasc ?>" ></td></tr>
						                   <tr> <td ><div id="cnpj_cpf"><span>CNPJ:</span></div></td><td><input type="text" id="cnpj" name="cnpj" value="<?php echo $cli->cpf ?>" ></td></tr> 
						                   <tr> <td ><span>Celular:</span></td> <td><input type="text" id="cel" name="cel" value="<?php echo $cli->telefone_cel ?>"></td></tr> 
						                   <tr> <td ><span>Telefone:</span></td> <td><input type="text" id="tel" name="tel"value="<?php echo $cli->telefone_com ?>"></td></tr>                         
						                   <tr> <td ><div id="inscricao_estadual_rg"><span>Inscrição Estadual:</span></div></td> <td><input type="text" id="inscricao_estadual" name="inscricao_estadual" value="<?php echo $cli->inscricao_estadual ?>" ></td></tr>
						                    <tr><td><div id="inscricao_municipal_rg"><span>Inscrição Municipal:</span></div></td><td><input type="text" id="inscricao_municipal" name="inscricao_municipal" value="<?php echo $cli->inscricao_municipal ?>"></td></tr>  
						                          <tr><td colspan="2"><span><b>Endereço</b></span></td></tr>
						                          <tr> <td ><span>Bairro:</span></td> <td><input type="text" id="bairro" name="bairro"  value="<?php echo $endereco[0][4]; ?>" ></td></tr> 
						                          <tr> <td ><span>Rua:</span></td> <td><input type="text" id="rua" name="rua" value="<?php echo $endereco[0][0]; ?>"></td></tr> 
						                          <tr> <td ><span>Numero:</span></td> <td><input type="number" id="numero" name="numero" value="<?php echo $endereco[0][1]; ?>" ></td></tr>
						                          <tr> <td ><span>UF:</span></td> 
						                            <td>
						                              <select id="estado" name="estado" onchange="buscar_cidades()">
						                                <option>Selecione o Estado</option>
						                                <?php 
						                                   $estado = new Estado();
						                                   $estado = $estado->get_name_all_uf();
						                                   for( $aux = 0; $aux < count($estado) ; $aux++){
						                                    echo '<option value="'.$estado[$aux][0].'">'.$estado[$aux][1].'</option>';
						                                   }
						                                ?>
						                              </select>
						                            </td>
						                            <?php echo "<script> carregaUf(".$endereco[0][3].");</script>"; ?>
						                          </tr> 
						                          <tr> 
						                            <td><span>Cidade:</span></td>
						                            <td>
						                              <div id="load_cidades">
						                                  <select name="cidade" id="cidade">
						                                    <option value="">Selecione UF</option>
						                                  </select>
						                                </div>
						                            </td>
						                            <?php echo "<script> buscar_cid('".$endereco[0][3]."'); </script>";  ?>
						                          </tr>                     
						                          <tr> <td ><span>CEP:</span></td> <td><input type="number" id="cep" name="cep" value="<?php echo $endereco[0][5]; ?>"></td></tr> 
						                          <tr> <td ><span>Site:</span></td> <td><input type="text" id="site" name="site" value="<?php echo $cli->site ?>" ></td></tr>
						                          <tr><td colspan="2"><span><b>Responsável</b></span></td></tr>
						                          <tr> <td ><span>Nome:</span></td> <td><input type="text" id="nome_resp" name="nome_resp" value="<?php echo $cli->responsavel ?>" ></td></tr> 
						                          <tr> <td ><span>CPF:</span></td> <td><input type="text" id="cpf_resp" name="cpf_resp" value="<?php echo $cli->cpf_responsavel ?>" ></td></tr> 
						                          <tr> <td ><span>Data Nascimento:</span></td> <td><input type="date" id="datanasc_resp" name="datanasc_resp" value="<?php echo $cli->data_nasc_responsavel ?>" ></td></tr> 
						                          <tr> <td ><span>E-mail:</span></td> <td><input type="text" id="email_resp" name="email_resp" value="<?php echo $cli->email_resp ?>"></td></tr>                     
						                          <tr><td colspan="2"><span><b>Observação</b></span></td></tr>                     
						                          <tr><td colspan="2"> <div align="center"><textarea align="center" rows="4" cols="50" id="observacao" name="observacao"><?php echo $cli->observacao ?></textarea></div> </td></tr>                     
						                          <tr>
							                    	 <td colspan="2" style="text-align:center">
							                    	 	<input  class="button" type="submit" value="Editar">
							                    	 	<input class="button" type="button" value="Cancelar">
							                    	 </td>
							                    </tr> 
						            </table>
						        </form>
				<?php }else{ //adicionar cliente?>

						<div class="title-box" style="float:left"><div style="float:left"><img src="../images/user_add.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRO DE CLIENTE</span></div></div>
						<form form method="POST" id="add_cliente" action="add_cliente.php" onsubmit="return valida(this)">
								<input type="hidden" name="tipo_post" value="add_cliente"><?php //input envia o tipo da requisição, se é add cliente,  edita cliente p/fisica ou edita cliente p/juridica ?>
								<table border="0" >
									 <tr><td colspan="2" padding-top:='10px'><span class="dados_cadastrais_title"><b>Dados Cadastrais</b><span></td></tr>
									 <tr> <td ><span>Tipo:</span></td>
									 	  <td> 	
											 <input type="radio" style="height:12px;" onclick="tipo_form()" id="pessoa_fisica" name="tipo" ><span>Pessoa Física</span>
											 <input type="radio" style="height:12px;" onclick="tipo_form()" id="pessoa_juridica" name="tipo" checked><span>Pessoa Juridica</span>
											 <input type="checkbox" style="height:12px;" onclick="tipo_form()" id="fornecedor" name="fornecedor"><span>Fornecedor</span>
										 </td>
									 </tr>
									 <tr> <td > <div id="razao_nome"><span>Razão Social:</span></div> </td><td><input type="text" id="nome" name="nome" ></td></tr>
							         <tr> <td > <div id="data_fun_data_nasc"><span>Data Fundação:</span></div> </td> <td><input type="date" id="data_nasc" name="data_nasc" ></td></tr>
							         <tr> <td > <div id="cnpj_cpf"><span>CNPJ:</span></div> </td><td><input type="text" id="cnpj" name="cnpj" ><input type="hidden" id="cpf" name="cpf"  ></td></tr> 
							         <tr> <td > <span>Celular:</span> </td> <td><input type="text" id="cel" name="cel" ></td></tr> 
							         <tr> <td > <span>Telefone:</span> </td> <td><input type="text" id="tel" name="tel" ></td></tr>			                    
							         <tr> <td > <div id="inscricao_estadual_rg"><span>Inscrição Estadual:</span></div> </td> <td><input type="number" id="inscricao_estadual" name="inscricao_estadual" > <input type="hidden" id="rg" name="rg"  ></td></tr>			                     
							         <tr> <td > <div id="inscricao_municipal_nulo"><span>Inscrição Municipal:</span></div> </td> <td><input type="number" id="inscricao_municipal" name="inscricao_municipal" ></td></tr></div>        
					                    <tr><td colspan="2"><span><b>Endereço</b></span> </td></tr>
					                    <tr> <td ><span>Bairro:</span></td> <td><input type="text" id="bairro" name="bairro" ></td></tr> 
					                    <tr> <td ><span>Rua:</span></td> <td><input type="text" id="rua" name="rua" ></td></tr> 
					                    <tr> <td ><span>Numero:</span></td> <td><input type="number" id="numero" name="numero" ></td></tr>
					                    <tr> <td ><span>UF:</span></td> 
					                    	<td>
					                    		<select id="estado" name="estado" onchange="buscar_cidades()">
					                    			<option>Selecione o Estado</option>
					                    			<?php 
					                    				 $estado = new Estado();
					                    				 $estado = $estado->get_name_all_uf();
					                    				 for( $aux = 0; $aux < count($estado) ; $aux++){
					                    				 	echo '<option value="'.$estado[$aux][0].'">'.$estado[$aux][1].'</option>';
					                    				 }
					                    			?>
					                    		</select>
					                    	</td>
					                    </tr> 
					                    <tr> 
					                    	<td><span>Cidade:</span></td>
					                    	<td>
					                    		<div id="load_cidades">
					                            <select name="cidade" id="cidade">
					                              <option value="">Selecione UF</option>
					                            </select>
					                          </div>
					                    	</td>
					                    </tr>                     
					                    <tr> <td ><span>CEP:</span></td> <td><input type="number" id="cep" name="cep" ></td></tr> 
					                    <tr> <td ><span>Site:</span></td> <td><input type="text" id="site" name="site" ></td></tr>
					                    <tr><td colspan="2"><span><b>Responsável</b></span></td></tr>
					                    <tr> <td ><span>Nome:</span></td> <td><input type="text" id="nome_resp" name="nome_resp" ></td></tr> 
					                    <tr> <td ><span>CPF:</span></td> <td><input type="text" id="cpf_resp" name="cpf_resp" ></td></tr> 
					                    <tr> <td ><span>Data Nascimento:</span></td> <td><input type="date" id="datanasc_resp" name="datanasc_resp" ></td></tr> 
					                    <tr> <td ><span>E-mail:</span></td> <td><input type="text" id="email_resp" name="email_resp" ></td></tr>                     
					                    <tr><td colspan="2"><span><b>Observação</b></span></td></tr>                     
					                    <tr><td colspan="2"> <div align="center"><textarea align="center" rows="4" cols="50" id="observacao" name="observacao" ></textarea></div> </td></tr>                     
					                    <tr>
					                    	 <td colspan="2" style="text-align:center">
					                    	 	<input  class="button" type="submit" value="Cadastrar">
					                    	 	<input class="button" type="button" value="Cancelar">
					                    	 </td>
					                    </tr> 

								</table>
						</form>
					<?php } //fim else?>

				<?php
				if(isset($_POST['tipo_post']) && $_POST['tipo_post'] == 'editar_pessoa_fisica'){
					
					if(validade()){// validate do editar cliente pessoa fisica
	                    
	                        $endereco = new Endereco();                        
	                        $cliente = new Cliente();
	                        $id = $_POST['id_cli'];
	                        $nome_razao_soc = $_POST['nome'];
	                        $data_nasc_data_fund = $_POST['data_nasc']; 
	                        $cpf_cnpj = $_POST['cpf']; 
	                        $telefone_cel = $_POST['cel'];
	                        $telefone_com = $_POST['tel'];                        
	                        $rg = $_POST['rg'];
	                        $tipo= 0;
	                        $responsavel = $_POST['nome_resp'];
	                        $cpf_responsavel = $_POST['cpf_resp'];
	                        $data_nasc_resp = $_POST['datanasc_resp'];
	                        $email_resp = $_POST['email_resp'];
	                        $site = $_POST['site'];
	                        $observacao = $_POST['observacao'];
	                        
	                        $fornecedor = ($_POST['fornecedor'])?1:0;
                        
	                        //recebendo endereco
	                        $rua = $_POST['rua'];
	                        $numero = $_POST['numero'];
	                        $id_cidade = $_POST['cidade'];
	                        $bairro = $_POST['bairro'];
	                        $cep = $_POST['cep'];
	                        

	                        $existe_endereco = $endereco->verifica_endereco($_POST['id_endereco']);

	                       if($existe_endereco){
	                            $endereco->atualiza_endereco($rua, $numero, $id_cidade, $_POST['id_endereco'], $bairro, $cep );
	                            $id_endereco = $_POST['id_endereco'];
	                        }else{
	                            $endereco->add_endereco($rua, $numero, $id_cidade, $bairro, $cep);
	                            $id_endereco = $endereco->add_endereco_bd();
	                        }

	                       if($cliente->atualiza_cli($id, $nome_razao_soc, $cpf_cnpj, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $rg, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_resp, $site, $observacao, $fornecedor)){
	                          echo '<div class="msg">Cliente editado com sucesso</div>';
	                       }else{
	                          echo '<div class="msg">Falha ao editar funcionário</div>';
	                       }
	                    }//fim validate
                 }//fim if isset($_POST['tipo_post']) && $_POST['tipo_post'] == 'editar_pessoa_fisica'


                 if(isset($_POST['tipo_post']) && $_POST['tipo_post'] == 'editar_pessoa_juridica'){//id editar pessoa juridica
                 	if(validade()){
                       
                      
                        $endereco = new Endereco();                        
                        $cliente = new Cliente();
                        $id = $_POST['id_cli'];
                        $nome_razao_soc = $_POST['nome'];
                        $data_nasc_data_fund = $_POST['data_nasc']; 
                        $cpf_cnpj = $_POST['cnpj']; 
                        $telefone_cel = $_POST['cel'];
                        $telefone_com = $_POST['tel'];                        
                        $inscricao_estadual = $_POST['inscricao_estadual'];
                        $inscricao_municipal = $_POST['inscricao_municipal'];
                        $tipo= 1;
                        $responsavel = $_POST['nome_resp'];
                        $cpf_responsavel = $_POST['cpf_resp'];
                        $data_nasc_resp = $_POST['datanasc_resp'];
                        $email_resp = $_POST['email_resp'];
                        $site = $_POST['site'];
                        $observacao = $_POST['observacao'];
                        $fornecedor = ($_POST['fornecedor'])?1:0;
                        
                        
                        //recebendo endereco
                        $rua = $_POST['rua'];
                        $numero = $_POST['numero'];
                        $id_cidade = $_POST['cidade'];
                        $bairro = $_POST['bairro'];
                        $cep = $_POST['cep'];
                        

                        $existe_endereco = $endereco->verifica_endereco($_POST['id_endereco']);

                       if($existe_endereco){
                            $endereco->atualiza_endereco($rua, $numero, $id_cidade, $_POST['id_endereco'], $bairro, $cep );
                            $id_endereco = $_POST['id_endereco'];
                        }else{
                            $endereco->add_endereco($rua, $numero, $id_cidade, $bairro, $cep);
                            $id_endereco = $endereco->add_endereco_bd();
                        }

                       if($cliente->atualiza_cli_jur($id, $nome_razao_soc, $cpf_cnpj, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $inscricao_estadual, $inscricao_municipal, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_resp, $site, $observacao, $fornecedor, $email_resp)){
                          echo '<div class="msg">Cliente editado com sucesso</div>';
                       }else{
                          echo '<div class="msg">Falha ao editar Cliente</div>';
                       }
                    }//fim if validate
                 }//fim if isset($_POST['tipo_post']) && $_POST['tipo_post'] == 'editar_pessoa_juridica'

                 if(isset($_POST['tipo_post']) && $_POST['tipo_post'] == 'add_cliente'){
						if(validade())//validate do add cliente
						{

							//recebendo cliente
							//dados com logica
							if($_POST['cpf'] != ""){
								$cpf_cnpj = $_POST['cpf'];	
							}
							if($_POST['cnpj'] != ""){		
								$cpf_cnpj = $_POST['cnpj'];
							}

							//dados sem logica
							$cliente = new Cliente();
							$nome_razao_soc = $_POST['nome'];
							$data_nasc_data_fund = $_POST['data_nasc'];	
							//$cpf_cnpj = $_POST['cnpj'];	
							$telefone_cel = $_POST['cel'];
							$telefone_com = $_POST['tel'];
							$tipo = $_POST['tipo'];
							$rg = $_POST['rg'];
							$inscricao_estadual = $_POST['inscricao_estadual'];
							$inscricao_municipal = $_POST['inscricao_municipal'];
							$responsavel = $_POST['nome_resp'];
							$cpf_responsavel = $_POST['cpf_resp'];
							$data_nasc_resp = $_POST['datanasc_resp'];
							$email_resp = $_POST['email_resp'];
							$site = $_POST['site'];
							$observacao = $_POST['observacao'];					
							$fornecedor = ($_POST['fornecedor'])?1:0;
							
							//recebendo endereco
							$endereco = new Endereco();
							$bairro = $_POST['bairro'];
							$rua = $_POST['rua'];
							$numero = $_POST['numero'];
							$cidade_id = $_POST['cidade'];

							$cep = $_POST['cep'];	
							$endereco->add_Endereco($bairro, $rua, $numero, $cidade_id, $cep);	
							$id_endereco = $endereco->add_endereco_bd();

							


							$cliente->add_cliente($nome_razao_soc, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $id_endereco, $tipo, $rg, $inscricao_estadual, $inscricao_municipal, $responsavel, $cpf_responsavel, $data_nasc_resp, $email_resp, $site, $observacao, $fornecedor);
							
							if($cliente->add_cliente_bd()){
								echo "Sucesso";
							}else{
								echo "falha";
							}
						}//fim validate
					}//fim isset($_POST['tipo_post']) && $_POST['tipo_post'] == 'editar_pessoa_fisica'

				?>





			</div>




			<?php include("informacoes_cliente.php"); ?>
	 
</body>
</html>