<?php 
include("restrito.php");
include_once("../model/class_sql.php");
include_once("../model/class_cbo_bd.php");
include_once("../model/class_cidade_bd.php");
include_once("../model/class_estado_bd.php");
include_once("../model/class_endereco_bd.php");
include_once("../model/class_cliente.php");
 ?>	

<html>
<head>
	<title>Editar Cliente</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>

  <script type="text/javascript">  
    function buscar_cidades(){
          
          var estado = document.getElementById("estado").value;  //codigo do estado escolhido
          //se encontrou o estado

          if(estado){

            var url = 'ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD

            $.get(url, function(dataReturn) {
              $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
            });
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
    }
    function buscar_cid(id_est){
      var estado = id_est;  //codigo do estado escolhido
      //se encontrou o estado
      if(estado){
        var url = 'ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
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

    function valida(f){
        var erros = 0;
        var msg = "";

          for (var i = 0; i < f.length; i++) {            

              if(f[i].name == "nome" && f[i].value == ""){
               
                msg += "Insira um Nome!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
                alert(erros);
              }
              if(f[i].name == "nome" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
              if(f[i].name == "cpf"){
                  if(f[i].value == ""){
                    msg += "Insira um CPF!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    if(!validarCPF(f[i].value)){
                      msg += "Insira um CPF válido!\n";
                      f[i].style.border = "1px solid #FF0000";
                      erros++;
                    }
                  }
                  if(f[i].value != "" && validarCPF(f[i].value)){
                    f[i].style.border = "1px solid #898989";
                  }
              }
              if(f[i].name == "rg"){
                  if(f[i].value == ""){
                    msg += "Insira um RG!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "org_em_rg"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Órgão Emissor!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "data_em_rg"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Data Emissão!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "titu_eleitoral"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Título Eleitoral!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "email_emp"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Email Empresarial!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "data_admissao"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Data de Admissão!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "sal_base"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Salário Base!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "qtd_horas_sem"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Quant. de Horas Semanais!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "pis"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo PIS!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "num_cart_trab"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Nº Car. Trabalho!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "uf_cart_trab"){
                  if(f[i].value == "Selecione UF"){
                    msg += "Selecione um Estado Para Carteira de Trab.!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "num_serie_cart_trab"){
                  if(f[i].value == ""){
                    msg += "Preencha o campo Nº de. Série!\n";
                    f[i].style.border = "1px solid #FF0000";
                    erros++;
                  }else{
                    f[i].style.border = "1px solid #898989"; 
                  }
              }
              if(f[i].name == "data_nasc" && f[i].value == ""){
                msg += "Insira uma Data de Nascimento!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "data_nasc" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

              if(f[i].name == "telefone" && f[i].value == ""){
                msg += "Insíra um Telefone!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "telefone" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
              if(f[i].name == "email" && f[i].value == ""){
                msg += "Insira um Email!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "email" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

              if(f[i].name == "empresa"){
                if(f[i].value == "no_sel"){
                  msg += "Selecione uma empresa!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989";
                }

              }

              if(f[i].name == "turno" && f[i].value == "Selecione um turno"){
                msg += "Selecione um Turno!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "turno" && f[i].value != "Selecione um turno"){
                f[i].style.border = "1px solid #898989";
              }

              if(f[i].name == "cbo" && f[i].value == "Selecione um cbo"){
                msg += "Selecione um CBO!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "cbo" && f[i].value != "Selecione um cbo"){
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

              if(f[i].name == "num" && f[i].value == ""){
                msg += "Preencha o campo Número\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "num" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

              if(f[i].name == "estado" && f[i].value == "0"){
                msg += "Selecione um Estado\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "estado" && f[i].value != "0"){
                f[i].style.border = "1px solid #898989";
              }
              if(f[i].name == "superv"){
                
                if(!document.getElementById("is_admin").checked && f[i].value == "Selecione um supervisor"){
                  msg += "Selecione um Supervisor\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989";  
                }

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
          if( erros > 0 ){
            alert(msg);
            return false;
          }
      }

      // inicio mascaras
      // inicio mascaras
    function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
      }
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
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
   window.onload = function(){
     
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
      // fim mascaras

    
  </script>

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

</head>

<body onload="disparaLoadCidade()" >  
	<?php include("../view/topo.php");  ?>
	<div class="formulario">
		 <h1>Editar Cliente Pessoa Juridica</h1>
                  <?php if(isset($_GET['verificador']) && $_GET['verificador'] == 1){ //se verificador estiver setado e for igual a 1 carregara os campos preenchidos?>
                    <?php 
                     $cli = new Cliente();
                     $cli = $cli->get_cli_id($_GET['id']);//buscando funcionario no banco
                     $endereco = new Endereco();
                     $endereco = $endereco->get_endereco( $cli->id_endereco );
                      
                      echo '<input type="hidden" id="id_cidade" value="'.$endereco[0][2].'">';
                    

                   ?>
    <form form method="POST" id="edita_cliente_jur" action="edita_cliente_jur.php" onsubmit="return valida(this)">
                  <input type="hidden" id="id_cli" name="id_cli" value="<?php echo $cli->id; ?>">
                  <input type="hidden" id="id_endereco" name="id_endereco" value="<?php echo $cli->id_endereco; ?>">
            <table id="table_dados_pes" class="table_dados_pes" border="0" >
               <tr><td colspan="2" padding-top:='10px'><span class="dados_cadastrais_title"><b>Dados Cadastrais</b><span></td></tr>
               <tr> <td ><span>Tipo:</span></td> <td>  
               <br><input type="checkbox" id="fornecedor" name="fornecedor" value="1">Fornecedor               
               <br><br></td></tr>
               <tr> <td ><div id="razao_nome">Razao Social:</div></td><td><input type="text" id="nome" name="nome" value="<?php echo $cli->nome; ?>" ></td></tr>
                   <tr> <td ><div id="data_fun_data_nasc">Data Fundação:</div></td> <td><input type="date" id="data_nasc" name="data_nasc" value="<?php echo $cli->data_nasc ?>" ></td></tr>
                   <tr> <td ><div id="cnpj_cpf">CNPJ:</div></td><td><input type="text" id="cnpj" name="cnpj" value="<?php echo $cli->cpf ?>" ></td></tr> 
                   <tr> <td ><span>Celular:</span></td> <td><input type="text" id="cel" name="cel" value="<?php echo $cli->telefone_cel ?>"></td></tr> 
                   <tr> <td ><span>Telefone:</span></td> <td><input type="text" id="tel" name="tel"value="<?php echo $cli->telefone_com ?>"></td></tr>                         
                   <tr> <td ><div id="inscricao_estadual_rg">Inscrição Estadual:</div></td> <td><input type="text" id="inscricao_estadual" name="inscricao_estadual" value="<?php echo $cli->inscricao_estadual ?>" ></td></tr>
                    <tr><td><div id="inscricao_municipal_rg">Inscrição Municipal:</div></td><td><input type="text" id="inscricao_municipal" name="inscricao_municipal" value="<?php echo $cli->inscricao_municipal ?>"></td></tr>  
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
                          <tr><td colspan="2"><input class="botao_submit" type="submit" value="Enviar" ></td></tr> 



            </table>
        </form>

               <?php } ?>
             
                   <!--  <?php                  
                  

                       // if($func->atualiza_func($id, $nome, $cpf, $data_nasc, $id_endereco, $telefone, $email, $senha, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $rg, $data_em_rg, $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor)){
                       //    echo '<div class="msg">Funcionário editado com sucesso</div>';
                       // }else{
                       //    echo '<div class="msg">Falha ao editar funcionário</div>';
                       // }
                    
                    ?> -->




                  

		<form method="POST" action="edita_cliente_jur.php">
			<table>				
				<td><span>Cliente: <input type="text" id="name_search" name="name_search"></td> <td><input type="submit" value="Buscar"></td>
			</table>
		</form>

		<?php
           if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
              $cli = new Cliente();
              $clis = $cli->get_cli_by_name($_POST['name_search']);
              
              if(count($clis) == 0){
                echo '<div class="msg">Nenhum registro encontrado!</div>';
              }
                echo '<table>';
                foreach($clis as $key => $cli){
                   echo '<tr>
                            <td><a href="edita_cliente_jur.php?verificador=1&id='.$clis[$key][0].'">'.$clis[$key][0]." ".$clis[$key][1].'</a></td></tr>';
                }
                echo '</table>';
           }                     
        ?>    

             <?php                   // echo '<script> alert("'.substr($_POST['sal_base'], 3, -1).'"); </script>';
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
                        $fornecedor = 0;
                        
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

                       if($cliente->atualiza_cli($id, $nome_razao_soc, $cpf_cnpj, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $tipo, $inscricao_estadual, $inscricao_municipal, $id_endereco,  $responsavel, $cpf_responsavel, $data_nasc_resp, $site, $observacao, $fornecedor)){
                          echo '<div class="msg">Funcionário editado com sucesso</div>';
                       }else{
                          echo '<div class="msg">Falha ao editar funcionário</div>';
                       }
                    }
                    ?> 
	</div>


</body>
</html>