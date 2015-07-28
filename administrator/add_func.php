
<?php
session_start();
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
   if(!isset($_POST['senha']) || $_POST['senha'] == ""){
       return false;
   }
   if(!isset($_POST['empresa_filial']) || $_POST['empresa_filial'] == "Selecione a empresa_filial"){
       return false;
   }
   if(!isset($_POST['turno']) || $_POST['turno'] == "Selecione um turno"){
       return false;
   }
   if(!isset($_POST['cbo']) || $_POST['cbo'] == "Selecione um cbo"){
       return false;
   }
   if(!isset($_POST['rua']) || $_POST['rua'] == ""){
       return false;
   }
   if(!isset($_POST['num']) || $_POST['num'] == ""){
       return false;
   }
   if(!isset($_POST['estado']) || $_POST['estado'] == "Selecione um estado"){
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



<head>
   <title>Adicionar</title>
   <meta charset="UTF-8">
   
   <link rel="stylesheet" type="text/css" href="style.css">
   <script src="../javascript/jquery.maskMoney.js" type="text/javascript"></script>
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Wallpoet' rel='stylesheet' type='text/css'>
</head>

<script type="text/javascript">
    $(function(){
          
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
                  msg += "Preencha o campo Email empresarial!\n";
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

              if(f[i].name == "senha" && f[i].value == ""){
                msg += "Insira uma Senha!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "senha" && f[i].value != ""){
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

              if(f[i].name == "estado" && f[i].value == "Selecione um estado"){
                msg += "Selecione um Estado\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "estado" && f[i].value != "Selecione um estado"){
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
          if(erros>0){
            
              alert(msg);
            
            return false;
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


</script>
<body>
      <div id="content">
            <?php include_once("../view/topo.php"); ?>
            <div class='formulario'>
              
               <span><b>Adicionar Funcionário</b></span>
               <form method="POST" id="ad_func" name="ad_func" action="add_func.php" onsubmit="return valida(this)">
                  <table border="0">
                     <tr>
                        <td>
                          <span>Nome:</span>
                        </td>
                        <td colspan="3">
                            <input type="text" id="nome" name="nome" style="width:370px;">
                        </td>
                     </tr> <!-- nome -->
                     <!-- campo input com texto dentro -->
                     <!-- <tr> <td><span>CPF:</span></td> <td colspan="3"><input style="width:370px;" type="text" id="cpf" name="cpf" value='Insira seu email aqui' onclick="this.value='';" onblur="javascript:if (this.value=='') {this.value='Insira seu email aqui'};"></td></tr> -->
                     <tr> <td><span>CPF:</span></td> <td colspan="3"><input style="width:370px;" type="text" id="cpf" name="cpf"></td></tr> <!-- CPF -->
                     <tr> <td><span>RG:</span></td> <td><input type="text" id="rg" name="rg"></td><td><span>Org.Emissor:</span></td><td><input style="width:100px;" type="text" id="org_em_rg" name="org_em_rg" ></td></tr> <!-- RG -->
                     <tr> <td><span>Data Em. RG:</span></td> <td colspan="3"><input type="text" id="data_em_rg" name="data_em_rg"  title="Data de emissão do RG"></td></tr> <!-- data de emissão do rg -->
                     <tr> <td><span>Título Eleitoral:</span></td> <td colspan="3"><input type="text" id="titu_eleitoral" name="titu_eleitoral" ></td></tr> <!-- Numero do titulo eleitoral -->
                     <tr> <td><span>Data Nasc.:</span></td> <td><input type="text" id="data_nasc" name="data_nasc"></td></tr> <!-- data nacimento -->
                     <tr> <td><span>Telefone:</span></td> <td><input type="text" id="telefone" name="telefone" ></td></tr> <!-- telefone -->
                     <tr> <td><span>Email Pessoal:</span></td> <td colspan="3"><input style="width:370px;" type="text" id="email" name="email"></td></tr> <!-- email -->
                     <tr> <td><span>Email empresarial:</span></td> <td colspan="3"><input style="width:370px;" type="text" id="email_emp" name="email_emp"></td></tr> <!-- email empresa_filialrial -->
                     <tr> <td><span>Senha:</span></td> <td><input type="password" id="senha" name="senha" ></td></tr> <!-- senha -->
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
                        <td><span>Data Adm.:</span></td><td><input type="text" id="data_admissao" style="width: 100px;" name="data_admissao"  title="Data de admissão do funcionário"></td>
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
                     </tr>
                     <tr> <td><span>Salário Base:</span></td> <td><input type="text" id="sal_base" name="sal_base" ></td></tr> <!-- Salário base -->
                     <tr> <td><span>Qtd. Horas Semanais:</span></td> <td><input type="text" id="qtd_horas_sem" name="qtd_horas_sem" ></td></tr> <!-- Quantidade de horas semanais -->
                     <tr> <td><span>Nº PIS:</span></td> <td colspan="3"><input type="text" id="pis" name="pis" ></td></tr> <!-- Numero do PIS -->
                     <tr> 
                        <td><span>Nº Cart. Trab.:</span></td>
                        <td colspan="3"><input type="text" id="num_cart_trab" name="num_cart_trab" style="width:100px;" ><span> Nº Série <span><input type="text" id="num_serie_cart_trab" name="num_serie_cart_trab" style="width:100px">
                        
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
                     </tr> <!-- numero da carteira de trabalho -->
                     <!-- <tr> <td><span>Num. Série Cart. Trab.:</span></td> <td><input type="text" id="num_serie_cart_trab" name="num_serie_cart_trab"></td></tr>  numero da carteira de trabalho -->
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
                                    echo '<option value="'.$turnos[$key][0].'">'.$turnos[$key][2].' - ' .$turnos[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                     </tr>
                     <tr>
                        <td><span>CBO:</span></td>
                        <td colspan="3">
                           <?php //buscar array de CBO
                              $cbo = new Cbo();
                              $cbos = $cbo->get_name_all_cbo();
                           ?>
                           <select name="cbo" id="cbo" style="width:375px">
                              <option>Selecione um cbo</option>
                              <?php 
                                 foreach($cbos as $key => $cbo){
                                    echo '<option value="'.$cbos[$key][0].'">'.$cbos[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                     </tr>
                     <tr>
                        <td> <span>Rua: </span></td><td colspan="3"><input type="text" id="rua" name="rua" style="width:300px"> <span> Nº </span> <input style="width:50px;" type="text" id="num" name="num" > </td>
                     </tr>
                     <tr>
                        <td> <span>Bairro: </span></td><td colspan="3"><input type="text" id="bairro" name="bairro" style="width:235px"> <span> CEP </span> <input style="width:100px;" type="text" id="cep" name="cep" > </td>
                     </tr>
                     <tr>
                        <td><span>Estado:</span></td>
                        <td>
                           <?php //buscar array de CBO
                              $estado = new Estado();
                              $estados = $estado->get_name_all_uf();
                           ?>
                           <select name="estado" id="estado" onchange="buscar_cidades()">
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
                     <tr>
                        <td><span>Cidades:</span></td>
                        <td colspan="3">
                           <div id="load_cidades">
                             <select name="cidade" id="cidade">
                               <option value="">Selecione um estado</option>
                             </select>
                           </div>
                        </td>
                     </tr>
                     <tr>
                        <td><span>Supervisor:</span></td>
                        <td colspan="3">
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
                     </tr>
                     <tr> <td><span>Tornar adiministrador:</span></td><td><input type="checkbox" name="is_admin" id="is_admin"></td> </tr>
                     <tr> <td></td>
                           <td><input type="submit" name="button" id="button" value="Cadastrar">
                              <input style="width:80px;" name="button" onclick="window.location.href='logado.php'" id="button" value="Cancelar">
                           </td></tr>
                  </table>
               </form>
               <?php
                    if(validate()){
                       $func = new Funcionario();
                       $end = new Endereco();

                       $rua = $_POST['rua'];
                       $numero = $_POST['num'];
                       $id_cidade = $_POST['cidade'];
                       $bairro = $_POST['bairro'];
                       $cep = $_POST['cep'];

                       $end->add_endereco($rua, $numero, $id_cidade, $bairro, $cep);
                       
                       $id_endereco = $end->add_endereco_bd();

                       $nome = $_POST['nome'];
                       $cpf = $_POST['cpf'];
                       $rg = $_POST['rg'];
                       
                       $data_nasc = explode("/", $_POST['data_nasc']);
                       $data_nasc = $data_nasc[2].'-'.$data_nasc[1].'-'.$data_nasc[0];
                       
                       $telefone = $_POST['telefone'];
                       $email = $_POST['email'];
                       $senha = $_POST['senha'];
                       $id_empresa = $_POST['empresa'];
                       $id_empresa_filial = $_POST['empresa_filial'];
                       $id_turno = $_POST['turno'];
                       
                       $data_em_rg = explode("/", $_POST['data_em_rg']);
                       $data_em_rg = $data_em_rg[2].'-'.$data_em_rg[1].'-'.$data_em_rg[0];


                       $org_em_rg = strtoupper($_POST['org_em_rg']);
                       $num_tit_eleitor = $_POST['titu_eleitoral'];
                       $email_empresa_filial = $_POST['email_emp'];
                       
                       $data_adm = explode("/", $_POST['data_admissao']);
                       $data_adm = $data_adm[2].'-'.$data_adm[1].'-'.$data_adm[0];


                       $salario_base = formata_salario($_POST['sal_base']);
                       $qtd_horas_sem = $_POST['qtd_horas_sem'];
                       $num_cart_trab = $_POST['num_cart_trab'];
                       $num_serie_cart_trab = $_POST['num_serie_cart_trab'] ;
                       $uf_cart_trab = $_POST['uf_cart_trab'];
                       $num_pis = $_POST['pis'];
                       $id_supervisor = $_POST['superv'];

                       $id_cbo = $_POST['cbo'];
                       $is_admin = ($_POST['is_admin'])?1:0;

                       $func->add_func($nome, $cpf, $rg, $data_nasc, $telefone, $email, $senha, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $id_endereco, $data_em_rg, $org_em_rg, $num_tit_eleitor, $email_empresa_filial, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor);
                       // echo $func->printFunc();
                       if($func->add_func_bd()){
                           echo '<div class="msg">Funcionário cadastrado com sucesso!</div>';
                       }else{
                            echo '<div class="msg">Falha ao cadastrar funcionário!</div>';
                       }
                       
                    }
                 ?>
            </div>
         
      
   </div>
</body>
</html>