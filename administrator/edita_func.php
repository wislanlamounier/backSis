
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
include_once("../model/class_empresa_bd.php");


function validate(){
   if(!isset($_POST['nome']) || $_POST['nome'] == ""){
         return false;
   }
   if(!isset($_POST['cpf']) || $_POST['cpf'] == ""){
       return false;
   }
   if(!isset($_POST['telefone']) || $_POST['telefone'] == ""){
       return false;
   }
   if(!isset($_POST['email']) || $_POST['email'] == ""){
       return false;
   }
   if(!isset($_POST['empresa_filial']) || $_POST['empresa_filial'] == "Selecione a Empresa"){
       return false;
   }
   if(!isset($_POST['turno']) || $_POST['turno'] == "Selecione um turno"){
       return false;
   }

   return true;
}
function formata_salario($salario){
  $replace = array(".","R$ ");
  $string = str_replace($replace, "", $_POST['sal_base']);
  
  $findme   = ',';
  $pos = strpos($string, $findme);
  
  if($pos == true){
  
     $return = substr($string, 0, $pos-(strlen($string)) );
  }else{
    $return = $string;
  }
  
  return $return;
}
?>
<html>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script src="../javascript/jquery.maskMoney.js" type="text/javascript"></script>
<script type="text/javascript">
        
      $(function(){
          // alert("teste")
           $("#sal_base").maskMoney({symbol:'R$ ', 
          showSymbol:true, thousands:'.', decimal:',', symbolStay: true});
        })

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
      id('data_nasc').onkeypress = function(){
          mascara( this, dnasc );
      }
      id('telefone').onkeypress = function(){
          mascara( this, mtel );
      }
      id('data_admissao').onkeypress = function(){
          mascara( this, dnasc );
      }
      id('data_em_rg').onkeypress = function(){
          mascara( this, dnasc );
      }
   }
      // fim mascaras

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

      function carrega_postos(){
      // alert('chamou')
      var empresa = document.getElementById("empresa").value;
      
      if(empresa){

          var url = 'ajax_buscar_postos.php?empresa='+empresa;
          $.get(url, function(dateReturn){
            $('#load_postos').html(dateReturn);
          });
      }

    }


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
    function carregaUf_CartTrab(uf){
      var combo = document.getElementById("uf_cart_trab");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == uf)
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
    }
    function carregaSuperv(sup){
      var combo = document.getElementById("superv");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == sup)
        {
          combo.options[i].selected = true;
          
          break;
        }
      }
    }
    function buscar_postos(id_empresa){
      
      if(id_empresa){
        var url = 'ajax_buscar_postos.php?empresa='+id_empresa;  //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function(dataReturn) {
          $('#load_postos').html(dataReturn);  //coloco na div o retorno da requisicao
        });
      }
    }
    function carregaPostosTrabalho(){
      var combo = document.getElementById("empresa_filial");
      var posto = document.getElementById("id_posto").value;

      for (var i = 0; i < combo.length; i++)
      {

        if (combo.options[i].value == posto)
        {
          combo.options[i].selected = true;
          break;
        }
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

    function carregaEmpresa(empresa){
      
      var combo = document.getElementById("empresa");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == empresa)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
    function carregaTurno(turno){
      var combo = document.getElementById("turno");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == turno)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
    function carregaCBO(cbo){
      var combo = document.getElementById("cbo");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == cbo)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
    function disparaLoadCidade(){
      setTimeout(function() {
         carregaCidade();
         carregaPostosTrabalho();
        }, 100);

    }
</script>

<head>
   <title>Editar</title>
   <meta charset="UTF-8">
   <link rel="stylesheet" type="text/css" href="style.css">
   <link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Wallpoet' rel='stylesheet' type='text/css'>
</head>

<body onload="disparaLoadCidade()">
            <?php include_once("../view/topo.php"); ?>
            <div class="formulario">              
               <h1>Editar Funcionário</h1>
               <?php if(isset($_GET['verificador']) && $_GET['verificador'] == 1){ //se verificador estiver setado e for igual a 1 carregara os campos preenchidos?>

                  <?php 
                     $func = new Funcionario();
                     $func = $func->get_func_id($_GET['id']);//buscando funcionario no banco
                     $endereco = new Endereco();
                     $endereco = $endereco->get_endereco( $func->id_endereco );
                      // $endereco[0][0] Rua
                      // $endereco[0][1] Numero
                      // $endereco[0][2] Cidade
                      // $endereco[0][3] Estado

                     echo '<input type="hidden" id="id_cidade" value="'.$endereco[0][2].'">';
                     echo '<input type="hidden" id="id_posto" value="'.$func->id_empresa_filial.'">';
                      
                     $data_em_rg = explode("-", $func->data_em_rg);
                     $data_em_rg = $data_em_rg[2].'/'.$data_em_rg[1].'/'.$data_em_rg[0];
                     $data_nasc = explode("-", $func->data_nasc);
                     $data_nasc = $data_nasc[2].'/'.$data_nasc[1].'/'.$data_nasc[0];
                     $data_adm = explode("-", $func->data_adm);
                     $data_adm = $data_adm[2].'/'.$data_adm[1].'/'.$data_adm[0];
                     
                     // echo $func->printFunc();
                   ?>

                  <form method="POST" id="ad_func" name="ad_func" action="edita_func.php" onsubmit="return valida(this)">
                  <input type="hidden" id="id_func" name="id_func" value="<?php echo $func->id; ?>">
                  <input type="hidden" id="id_endereco" name="id_endereco" value="<?php echo $func->id_endereco; ?>">
                  <table border='0'>
                    <tr><td colspan="4" style="padding-top:10px; padding-bottom:10px;"><span style="color:#565656">Atenção: Se o campo senha ficar em branco a senha não sera alterada</span></td></tr>
                     <tr> <td><span>Nome:</span></td> <td colspan="3"><input type="text" id="nome" name="nome" value="<?php echo $func->nome; ?>"></td></tr> <!-- nome -->
                     <tr> <td><span>CPF:</span></td> <td><input type="text" id="cpf" name="cpf" value="<?php echo $func->cpf; ?>"></td></tr> <!-- CPF -->
                     <tr> <td><span>RG:</span></td> <td><input type="text" id="rg" name="rg" value="<?php echo $func->rg; ?>"></td><td><span>Org.Em:</span></td><td><input style="width:100px;" type="text" id="org_em_rg" name="org_em_rg" value="<?php echo $func->org_em_rg; ?>"></td></tr> <!-- RG -->
                     <tr> <td><span>Data Em. RG:</span></td> <td colspan="3"><input type="text" id="data_em_rg" name="data_em_rg" value="<?php echo $data_em_rg; ?>" title="Data de emissão do RG"></td></tr> <!-- data de emissão do rg -->
                     <tr> <td><span>Título Eleitoral:</span></td> <td colspan="3"><input type="text" id="titu_eleitoral" name="titu_eleitoral" value="<?php echo $func->num_tit_eleitor; ?>"></td></tr> <!-- Numero do titulo eleitoral -->
                     <tr> <td><span>Data Nasc.:</span></td> <td><input type="text" id="data_nasc" name="data_nasc" value="<?php echo $data_nasc; ?>"></td></tr> <!-- data nacimento -->
                     <tr> <td><span>Telefone:</span></td> <td><input type="text" id="telefone" name="telefone" value="<?php echo $func->telefone; ?>"></td></tr> <!-- telefone -->
                     <tr> <td><span>Email Pessoal:</span></td> <td><input type="text" id="email" name="email" value="<?php echo $func->email; ?>"></td></tr> <!-- email -->
                     <tr> <td><span>Email Empresarial:</span></td> <td><input type="text" id="email_emp" name="email_emp" value="<?php echo $func->email_empresa; ?>"></td></tr> <!-- email empresarial -->
                     <tr> <td><span>Senha:</span></td> <td><input type="text" id="senha" name="senha"></td></tr> <!-- senha -->
                     <tr>
                        <td><span>Empresa:</span></td>
                        <td>
                           <?php //buscar array de CBO
                              $empresa = new Empresa();
                              $empresas = $empresa->get_all_empresa();
                           ?>
                           <select name="empresa" id="empresa" onchange="carrega_postos()">
                              <option value="no_sel">Selecione</option>
                              <?php 
                                 foreach($empresas as $key => $empresa){
                                    echo '<option value="'.$empresas[$key][0].'">'.$empresas[$key][2].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                        <td><span>Data Adm.:</span></td><td><input type="text" id="data_admissao" style="width: 100px;" name="data_admissao" value="<?php echo $data_adm ?>" title="Data de admissão do funcionário"></td>
                        <?php echo "<script> carregaEmpresa('".$func->id_empresa."') </script>";  ?>
                     </tr>
                     <tr>
                        <td><span>Posto de trabalho:</span></td>
                        <td colspan="3">
                           <div id="load_postos">
                             <select name="empresa_filial" id="empresa_filial">
                               <option value="no_sel">Selecione uma empresa</option>
                             </select>
                           </div>
                        </td>
                        <?php echo '<script> buscar_postos('.$func->id_empresa.'); </script>'; ?> 
                     </tr>
                     <tr> <td><span>Salário Base:</span></td> <td><input type="text" id="sal_base" name="sal_base" value="<?php echo $func->salario_base; ?>"></td></tr> <!-- Salário base -->
                     <tr> <td><span>Qtd. Horas Semanais:</span></td> <td><input type="text" id="qtd_horas_sem" name="qtd_horas_sem" value="<?php echo $func->qtd_horas_sem; ?>"></td></tr> <!-- Quantidade de horas semanais -->
                     <tr> <td><span>Nº PIS:</span></td> <td colspan="3"><input type="text" id="pis" name="pis" value="<?php echo $func->num_pis; ?>"></td></tr> <!-- Numero do PIS -->
                     <tr> 
                        <td><span>Num. Cart. Trab.:</span></td>
                        <td><input type="text" id="num_cart_trab" name="num_cart_trab" value="<?php echo $func->num_cart_trab; ?>"></td>
                        <td colspan="2">
                           <?php //buscar array estados
                              $estado = new Estado();
                              $estados = $estado->get_name_all_uf();
                           ?>
                           <select name="uf_cart_trab" id="uf_cart_trab">
                              <option>Selecione UF</option>
                              <?php 
                                 foreach($estados as $key => $estado){
                                    echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                        </td>
                        <?php echo "<script> carregaUf_CartTrab('".$func->uf_cart_trab."') </script>";  ?>
                     </tr> <!-- numero da carteira de trabalho -->
                     <tr> <td><span>Num. Série Cart. Trab.:</span></td> <td><input type="text" id="num_serie_cart_trab" name="num_serie_cart_trab" value="<?php echo $func->num_serie_cart_trab; ?>"></td></tr> <!-- numero da carteira de trabalho -->
                     <tr>
                        <td><span>Turno:</span></td>
                        <td colspan="3">
                           <?php //buscar array de CBO
                              $turno = new Turno();
                              $turnos = $turno->get_name_all_turno();
                           ?>
                           <select name="turno" id="turno">
                              <option>Selecione um turno</option>
                              <?php 
                                 foreach($turnos as $key => $turno){
                                    echo '<option value="'.$turnos[$key][0].'">'.$turnos[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                        <?php echo "<script> carregaTurno('".$func->id_turno."') </script>";  ?>

                     </tr>
                     <tr>
                        <td><span>CBO:</span></td>
                        <td colspan="3">
                           <?php //buscar array de CBO
                              $cbo = new Cbo();
                              $cbos = $cbo->get_name_all_cbo();
                           ?>
                           <select name="cbo" id="cbo">
                              <option>Selecione um cbo</option>
                              <?php 
                                 foreach($cbos as $key => $cbo){
                                    echo '<option value="'.$cbos[$key][0].'">'.$cbos[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                        <?php echo "<script> carregaCBO('".$func->id_cbo."') </script>";  ?>
                     </tr>
                     <tr>
                        <td> <span>Rua: </span></td><td colspan="3"><input type="text" id="rua" name="rua" value="<?php echo $endereco[0][0]; ?>" > <span>Nº</span> <input style="width:30px;" type="text" id="num" name="num" value="<?php echo $endereco[0][1]; ?>"> </td>
                     </tr>
                      <tr>
                        <td> <span>Bairro: </span></td><td colspan="3"><input type="text" id="bairro" name="bairro" style="width:200px" value="<?php echo $endereco[0][4]; ?>"> <span> CEP </span> <input style="width:100px;" type="text" id="cep" name="cep" value="<?php echo $endereco[0][5]; ?>"> </td>
                     </tr>
                     <tr>
                        <td><span>Estado:</span></td>
                        <td>
                           <?php //buscar array de CBO
                              $estado = new Estado();
                              $estados = $estado->get_name_all_uf();
                                
                           ?>
                           <select name="estado" id="estado" onchange="buscar_cidades()">
                              <option value="0">Selecione um estado</option>
                              <?php 
                                 foreach($estados as $key => $estado){
                                    echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                 }
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                        <?php echo "<script> carregaUf('".$endereco[0][3]."') </script>";  ?>
                     </tr>
                     <tr>
                        <td><span>Cidades:</span></td>
                        <td colspan="3">
                           <div id="load_cidades">
                             <select name="cidade" id="cidade">
                               <option value="0">Selecione um estado</option>
                             </select>
                           </div>
                        </td>
                        <?php echo "<script> buscar_cid('".$endereco[0][3]."'); </script>";  ?>
                     </tr>
                     <tr>
                        <td><span>Supervisor:</span></td>
                        <td>
                           <?php //buscar array de CBO
                              $admin = new Funcionario();
                              $supervisores = $admin->get_admin();
                           ?>
                           <select name="superv" id="superv">
                              <option>Selecione um supervisor</option>
                              <?php 
                                 foreach($supervisores as $key => $admin){
                                    echo '<option value="'.$supervisores[$key][0].'">'.$supervisores[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                        <?php echo "<script> carregaSuperv('".$func->id_supervisor."') </script>";  ?>
                     </tr>
                     <tr> <td><span>Tornar adiministrador:</span></td>
                          <td>
                            <?php if($func->is_admin == 1){ ?>
                            <input type="checkbox" name="is_admin" checked id="is_admin">
                            <?php }else{ ?>
                            <input type="checkbox" name="is_admin" id="is_admin">
                            <?php } ?>

                          </td> </tr>
                     <tr> <td></td><td><input type="submit" name="button" id="button" value="Editar"></td> </tr>
                  </table>
               </form>

               <?php }else{ ?>
                    <form method="POST" class="search_func" id="search_func" name="search_func" action="edita_func.php">
                         <table>
                           <tr>
                              <td><span>Funcionário: </span></td>
                              <td><input type="text" id="name_search" name="name_search"></td>
                              <td><input type="submit" value="Buscar"></td>
                           </tr>
                        </table>
                      </form>
               <?php } ?>
               <?php
                     if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
                        $func = new Funcionario();
                        $funcs = $func->get_func_by_name($_POST['name_search']);
                        
                        if(count($funcs) == 0){
                          echo '<div class="msg">Nenhum registro encontrado!</div>';
                        }
                          echo '<table class="exibe_func">';
                          foreach($funcs as $key => $func){
                             echo '<tr>
                                      <td><a href="edita_func.php?verificador=1&id='.$funcs[$key][0].'">'.$funcs[$key][0]." ".$funcs[$key][1].'</a></td></tr>';
                          }
                          echo '</table>';
                     }
                     
                  ?>
                    <?php
                    // echo '<script> alert("'.substr($_POST['sal_base'], 3, -1).'"); </script>';
                    if(validate()){
                       
                       $func = new Funcionario();
                       $endereco = new Endereco();

                       
                       $id = $_POST['id_func'];
                       $nome = $_POST['nome'];
                       $cpf = $_POST['cpf'];

                       $data_nasc = explode("/", $_POST['data_nasc']);
                       $data_nasc = $data_nasc[2].'-'.$data_nasc[1].'-'.$data_nasc[0];

                       $telefone = $_POST['telefone'];
                       $email = $_POST['email'];
                       $senha = $_POST['senha'];
                       $id_empresa = $_POST['empresa'];
                       $id_empresa_filial = $_POST['empresa_filial'];
                       $id_turno = $_POST['turno'];
                       $id_cbo = $_POST['cbo'];
                       $is_admin = ($_POST['is_admin'])?1:0;

                       $rg = $_POST['rg'];
                       
                       $data_em_rg = explode("/", $_POST['data_em_rg']);
                       $data_em_rg = $data_em_rg = $data_em_rg[2].'-'.$data_em_rg[1].'-'.$data_em_rg[0];

                       $org_em_rg = $_POST['org_em_rg'];
                       $num_tit_eleitor = $_POST['titu_eleitoral'];
                       $email_empresa = $_POST['email_emp'];
                       
                       $data_adm = explode("/", $_POST['data_admissao']);
                       $data_adm = $data_adm = $data_adm[2].'-'.$data_adm[1].'-'.$data_adm[0];
                       
                       $salario_base = formata_salario($_POST['sal_base']);  // retorna salario formatado
                       
                       $qtd_horas_sem = $_POST['qtd_horas_sem'];
                       $num_cart_trab = $_POST['num_cart_trab'];
                       $num_serie_cart_trab = $_POST['num_serie_cart_trab'] ;
                       $uf_cart_trab = $_POST['uf_cart_trab'];
                       $num_pis = $_POST['pis'];
                       $id_supervisor = $_POST['superv'];

                       
                       $rua = $_POST['rua'];
                       $numero = $_POST['num'];
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

                       if($func->atualiza_func($id, $nome, $cpf, $data_nasc, $id_endereco, $telefone, $email, $senha, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $rg, $data_em_rg, $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor)){
                          echo '<div class="msg">Funcionário editado com sucesso</div>';
                       }else{
                          echo '<div class="msg">Falha ao editar funcionário</div>';
                       }
                    }
                    ?>
            </div>
         
   
</body>
</html>