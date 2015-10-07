<?php
include("restrito.php"); 
include_once("../model/class_empresa_bd.php");
include_once("../model/class_cliente.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_cor_bd.php");
include_once("../model/class_marca_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");

function validate(){
   if(!isset($_POST['matricula']) || $_POST['matricula'] == ""){
         return false;
    }
         return true;
   
    }
         
function formataMoney($valor){
  
    $replace = array(".","R$ ");
    $string = str_replace($replace, "", $valor);

    $replace = array(",");
    $string = str_replace($replace, ".", $string);
    
    $return = $string;
    return $return;
}
//verifica o valor antes de carregar no text de edição
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
	 <script type="text/javascript">
  

  function confirma2(id, nome, tipopess){
   
       if(confirm("Excluir Veículo "+nome+" , tem certeza?") ){
          var url = '../ajax/ajax_excluir_veiculo.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
            
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
       }

    function confirma0(id, nome, tipopess){  
    if(confirm("Excluir Patrimonio "+nome+" , tem certeza?") ){
       var url = '../ajax/ajax_excluir_patrimonio_geral.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
       
       $.get(url, function(dataReturn) {
         
         $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
       });
    }
    }
    function confirma1(id, nome, tipopess){  
    if(confirm("Excluir Maquinario "+nome+" , tem certeza?") ){
       var url = '../ajax/ajax_excluir_maquinario.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
       
       $.get(url, function(dataReturn) {
         
         $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
       });
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

    function mplaca(v){
      
       if(v.length >=8){                                          // alert("mtel")
         v = v.substring(0,(v.length - 1));
         
         return v;
       }
       v=v.replace('-',"");             //Remove tudo o que não é dígito
       v=v.replace(/(\D{3})(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
       
       
       return v;
      
    }
    
   function id( el ){
     // alert("id")
     return document.getElementById( el );
   }
   window.onload = function(){
      mascara( id('valor'), mmoney );

      // id('valor').onclick = function(){ 
      //     mascara( this, mmoney );
      // }
      id('valor').onkeypress = function(){ 
          mascara( this, mmoney );
      }
      id('placa').onkeypress = function(){
        mascara(this, mplaca);
      }
    }

      function validate(f){
        var erros = 0;
        var msg = "";
          for (var i = 0; i < f.length; i++) {
              if(f[i].name == "matricula"){
                  if(f[i].value == ""){
                     msg += "Insira codigo no campo matricula!\n";
                     f[i].style.border = "1px solid #FF0000";
                     erros++;
                  }else{
                      f[i].style.border = "1px solid #898989";
                  }
              }
              if(f[i].name == "chassi_nserie" && f[i].value == ""){
                msg += "Insira um código no campo chassi Nº Serie!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "modelo"){
                if(f[i].value == ""){
                  msg += "Preencha o campo modelo!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "fabricante"){
                if(f[i].value == ""){
                  msg += "Preencha o campo fabricante!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              
              if(f[i].name == "data_compra"){
                if(f[i].value == ""){
                  msg += "Preencha o campo Data de Compra!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "responsavel"){
                if(f[i].value == "no_sel"){
                  msg += "Selecione uma Forncedor!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989";
                }
              }
               if(f[i].name == "fornecedor"){
                if(f[i].value == "no_sel"){
                  msg += "Selecione uma Forncedor!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989";
                }
              }
              if(f[i].name == "hr_inicial"){
                if(f[i].value ==""){
                  msg += "Preencha o campo Horimetro!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "valor"){
                if(f[i].value == ""){
                  msg += "Preencha o campo de Valor!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
            
              if(f[i].name == "nome"){
                if(f[i].value == ""){
                  msg += "Preencha o campo de Nome!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }
              if(f[i].name == "descricao"){
                if(f[i].value == ""){
                  msg += "Preencha o campo de descricao!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }

              if(f[i].name == "marca"){
                if(f[i].value == ""){
                  msg += "Preencha o campo Marca!\n";
                  f[i].style.border = "1px solid #FF0000";
                  erros++;
                }else{
                  f[i].style.border = "1px solid #898989"; 
                }
              }

              if(f[i].name == "placa" && f[i].value == ""){
                msg += "Preencha o campo de Placa!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
           

              if(f[i].name == "renavam" && f[i].value == ""){
                msg += "Preencha o campo renavam\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
             

              if(f[i].name == "chassi" && f[i].value == ""){
                msg += "Preencha o campo de Chassi!\n";
                f[i].style.border = "1px solid #FF0000";
                erros++;
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
              

         }
          if(erros>0){            
              alert(msg);
            return false;
          }
      }

   function tipo_form(){
    if(document.getElementById("seguro").checked == true){
        document.getElementById("seguro").value = 1;
        document.getElementById("data_ini_seg").disabled = false;
        document.getElementById("data_fim_seg").disabled = false;
     }else{
         document.getElementById("seguro").value = 0;
         document.getElementById("data_ini_seg").disabled = true;
         document.getElementById("data_fim_seg").disabled = true;
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
   function carregaCor(cor){
      
      var combo = document.getElementById("cor");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == cor)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
    function carregaAno(ano){
      
      var combo = document.getElementById("ano");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == ano)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
    function carregaMarca(marca){
      
      var combo = document.getElementById("marca");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == marca)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }
    function carregaFornecedor(fornecedor){
      
      var combo = document.getElementById("fornecedor");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == fornecedor)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }

    function buscar_responsavel(){         
          var empresa = document.getElementById("empresa").value;  //codigo do estado escolhido

          //se encontrou o estado
          if(empresa){

            var url = '../ajax/ajax_buscar_responsavel.php?empresa='+empresa;  //caminho do arquivo php que irá buscar as cidades no BD

            $.get(url, function(dataReturn) {
              $('#load_responsavel').html(dataReturn);  //coloco na div o retorno da requisicao
            });
          }
        }

       
   
	 </script>
</head>

<body onload="disparaLoadCidade()" >	
			<?php include_once("../view/topo.php"); ?>

			 
             <?php if(!isset($_GET['menu']) && !isset($_GET['controle']))/*MENU PARA ESCOLHA DE CADASTRO*/{?>
            <div id="content">   
            <div class="formulario" id="menu">
             <div class="menu_patrimonio">
                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">PATRIMONIO</span></div></div>

              <form>                
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_maquinario">
                <input type="hidden" id="tipo" name="menu" value="0">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Maquinário"></td></tr>
              </form>
              <form>
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_patrimonio_geral">
                <input type="hidden" id="tipo" name="menu" value="0">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Geral"></td></tr>
              </form>              
              <form>
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_veiculo">
                <input type="hidden" id="tipo" name="menu" value="0">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Veículo"></td></tr>
              </form>
              </div>
              
              <?php /*ADIÇÕES DE DADOS NO BANCO */
                    if(isset($_POST['maquinario']) && $_POST['maquinario'] == "cadastrar_maquinario"){
                    // echo '<script>alert("'.formataMoney($_POST['valor_compra']).'")</script>';                    
                    if(validate()){
                       $matricula = $_POST['matricula'];      
                       $chassi_nserie = $_POST['chassi_nserie'];
                       $fabricante = $_POST['fabricante'];
                       $modelo = $_POST['modelo'];
                       $cor = $_POST['cor'];
                       $tipo_consumo = $_POST['tipo_consumo'];
                       // echo"<br>". $tipo = $_POST['tipo'];
                       $ano = $_POST['ano'];
                       $data_compra = $_POST['data_compra'];
                       $seguro = (isset($_POST['seguro']))?(($_POST['seguro'])?1:0):0;
                       if($seguro == 1){
                           $data_ini_seg = $_POST['data_ini_seg'];
                           $data_fim_seg = $_POST['data_fim_seg'];
                       }else{
                           $data_ini_seg = "0000-00-00";
                           $data_fim_seg = "0000-00-00";
                       }
                       $valor = formataMoney($_POST['valor']);
                       $valor_custo = formataMoney($_POST['valor_custo']);
                       $horimetro_inicial = $_POST['hr_inicial'];
                       $id_empresa = $_POST['empresa'];
                       $id_fornecedor = $_POST['fornecedor'];
                       $id_responsavel = $_POST['responsavel'];
                       $observacao = $_POST['observacao'];


                      $maquinario = new Maquinario();
                      $maquinario->add_maquinario($matricula, $chassi_nserie, $modelo, $tipo_consumo, $ano, $cor, $fabricante, $data_compra, $seguro, $data_ini_seg, $data_fim_seg, $horimetro_inicial, $id_empresa, $id_fornecedor, $id_responsavel, $observacao, $valor, $valor_custo);
    
                      if($maquinario->add_maquinario_bd()){
                        echo '<div class="msg" style="float: left;">Maquinario adicionado com sucesso !</div>';
                        echo '<script>alert("Maquinário adicionado com sucesso!")</script>';
                        if(isset($_POST['local']) && $_POST['local'] == 'addobra'){//se $_POST['local'] == addobra quer dizer que a pagina add_patrimonio foi chamada da add_obra, então tem que retornar pra la
                             echo '<script>window.location.href=\'add_obra.php?t=a_p_o\'</script>';
                        }
                      }else{
                        echo '<div class="msg" style="float: left;">Falha ao adicionar Maquinario!</div>';
                      }                      
                      
                      }
                   }
                  if(isset($_POST['veiculo']) && $_POST['veiculo'] == "cadastrar_veiculo"){
                    // echo '<script>alert("'.formataMoney($_POST['valor_compra']).'")</script>';
                 
                    if(validate()){
                                                                                          
                         $matricula = $_POST['matricula'];
                         $chassi = $_POST['chassi'];
                         $renavam = $_POST['renavam'];
                         $placa = $_POST['placa'];
                         $id_marca = $_POST['marca'];
                         $modelo = $_POST['modelo'];
                         $ano = $_POST['ano'];
                         $id_cor = $_POST['cor'];
                         $valor = formataMoney($_POST['valor']);
                         $valor_custo = formataMoney($_POST['valor_custo']);
                         $data_compra = $_POST['data_compra'];
                         $seguro = (isset($_POST['seguro']))?(($_POST['seguro'])?1:0):0;
                           if($seguro == 1){                      
                            
                             $data_ini_seg = $_POST['data_ini_seg'];
                             $data_fim_seg = $_POST['data_fim_seg'];
                           }else{
                              $data_ini_seg = "0000-00-00";
                                $data_fim_seg = "0000-00-00";
                           }
                         $km_inicial = $_POST['km_inicial'];
                         $tipo_combustivel = $_POST['combustivel'];              
                         $id_empresa = $_POST['empresa'];
                         $id_fornecedor = $_POST['fornecedor'];
                         $id_responsavel = $_POST['responsavel'];
                           
                          
                          $veiculo = new Veiculo();
                         
                         
                          $veiculo->add_veiculo($matricula, $chassi, $renavam, $placa, $id_marca, $modelo, $ano, $id_cor, $valor, $valor_custo, $data_compra, $seguro, $data_ini_seg, $data_fim_seg, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel);
                          
                          if($veiculo->add_veiculo_bd()){
                            echo '<div class="msg" style="float: left;">Veiculo adicionado com sucesso !</div>';
                            echo '<script>alert("Veículo adicionado com sucesso!")</script>';
                            if(isset($_POST['local']) && $_POST['local'] == 'addobra'){//se $_POST['local'] == addobra quer dizer que a pagina add_patrimonio foi chamada da add_obra, então tem que retornar pra la
                                echo '<script>window.location.href=\'add_obra.php?t=a_p_o\'</script>';
                            }
                          }else{
                            echo '<div class="msg" style="float: left;">Falha ao adicionar Veiculo!</div>';
                          }                      
                      
                      }
                   }

                   if(isset($_POST['cadastrar_patrimonio_geral']) && $_POST['cadastrar_patrimonio_geral'] == "cadastrar_patrimonio_geral"){
                   //echo '<script>alert("'.formataMoney($_POST['valor']).'")</script>';  
                                
                    if(validate()){

               
                         $matricula = $_POST['matricula'];           
                         $nome = $_POST['nome'];
                         $marca = $_POST['marca'];
                         $descricao = $_POST['descricao'];
                         $quantidade = $_POST['quantidade'];
                         $valor = formataMoney($_POST['valor']); 
                         $valor_custo = formataMoney($_POST['valor_custo']);
                         $id_empresa = $_POST['empresa'];
                        


                      $patrimonio = new Patrimonio_geral();
                      $patrimonio->add_patrimonio_geral($nome, $matricula, $marca, $descricao, $quantidade, $valor, $valor_custo, $id_empresa);
    
                      if($patrimonio->add_patrimonio_geral_bd()){
                        echo '<div class="msg" style="float: left;">Patrimonio adicionado com sucesso !</div>';
                        echo '<script>alert("Patrimonio geral adicionado com sucesso!")</script>';
                            if(isset($_POST['local']) && $_POST['local'] == 'addobra'){//se $_POST['local'] == addobra quer dizer que a pagina add_patrimonio foi chamada da add_obra, então tem que retornar pra la
                                echo '<script>window.location.href=\'add_obra.php?t=a_p_o\'</script>';
                            }
                      }else{
                        echo '<div class="msg" style="float: left;">Falha ao adicionar Patrimonio!</div>';
                      }                      
                      
                      }
                   }
 
       /*FIM ADIÇÕES DE DADOS NO BANCO */  ?>   

<?php /*INICIO EDITAR */ ?>
                 <?php if(isset($_POST['atualiza_patrimonio_geral']) =='editar_patrimonio_geral'){?> 
                     <?php 

                      $id = $_POST['id'];
                      $matricula = $_POST['matricula'];       
                      $nome = $_POST['nome'];
                      $marca = $_POST['marca'];
                      $descricao = $_POST['descricao'];
                      $quantidade = $_POST['quantidade'];
                      $valor = formataMoney($_POST['valor']);
                      $valor_custo = formataMoney($_POST['valor_custo']);
                      $id_empresa = $_POST['empresa'];
                      
                      
                      $patrimonio = new Patrimonio_geral();                     
    
                      if($patrimonio->atualiza_patrimonio_geral($nome, $matricula, $marca, $descricao, $quantidade, $valor, $valor_custo, $id_empresa, $id)){
                        
                        echo '<div class="msg" style="float: left;">Patrimonio atualizado com sucesso !</div>';
                        echo '<script>alert("Patrimonio Geral atualizado com sucesso")</script>';
                                                      
                      }else{
                        echo '<div class="msg" style="float: left;"> Falha ao atualizar Patrimonio!</div>';
                      }  
                                            
                       ?> 

           <?php }?>
            <?php if(isset($_POST['atualiza_veiculo']) =='editar_veiculo'){?> 
              <?php 

                     $id = $_POST['id'];
                     $matricula = $_POST['matricula'];
                     $chassi = $_POST['chassi'];
                     $renavam = $_POST['renavam'];
                     $placa = $_POST['placa'];
                     $marca = $_POST['marca'];
                     $modelo = $_POST['modelo'];
                     $ano = $_POST['ano'];
                     $cor = $_POST['cor'];
                     $valor = formataMoney($_POST['valor']);
                     $valor_custo = formataMoney($_POST['valor_custo']);
                     $data_compra = $_POST['data_compra'];
                     $seguro = (isset($_POST['seguro']))?(($_POST['seguro'])?1:0):0;
                     if($seguro == 1){
                         $data_ini_seg = $_POST['data_ini_seg'];
                         $data_fim_seg = $_POST['data_fim_seg'];
                       }else{
                         $data_ini_seg = "0000-00-00";
                         $data_fim_seg = "0000-00-00";
                       }            
                     $km_inicial = $_POST['km_inicial'];
                     $tipo_combustivel = $_POST['combustivel'];
                     $id_empresa = $_POST['empresa'];
                     $id_fornecedor = $_POST['fornecedor'];
                     $id_responsavel = $_POST['responsavel'];       
                                       
                                         
                      $patrimonio = new Veiculo(); 
                      if($patrimonio->atualiza_veiculo($matricula, $chassi, $renavam, $placa, $marca, $modelo, $ano, $cor, $valor, $valor_custo, $data_compra, $seguro, $data_ini_seg, $data_fim_seg, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel ,$id)){
                        echo '<div class="msg" style="float: left;">Veículo atualizado com sucesso !</div>';
                        echo '<script>alert("Veículo atualizado com sucesso")</script>';
                      }else{
                        echo '<div class="msg" style="float: left;">Falha ao atualizar Veículo!</div>';
                      }                      
                       ?>               
            <?php }?>

            <?php if(isset($_POST['atualiza_maquinario']) =='editar_maquinario'){?>
                <?php 

                $id= $_POST['id'];
                $matricula = $_POST['matricula'];      
                $chassi_nserie = $_POST['chassi_nserie'];
                $fabricante = $_POST['fabricante'];
                $modelo = $_POST['modelo'];
                $cor = $_POST['cor'];
                $tipo_consumo = $_POST['tipo_consumo'];
                // $tipo = $_POST['tipo'];
                $ano = $_POST['ano'];
                $data_compra = $_POST['data_compra'];
                $seguro = (isset($_POST['seguro']))?(($_POST['seguro'])?1:0):0;
                if($seguro == 1){
                    $data_ini_seg = $_POST['data_ini_seg'];
                    $data_fim_seg = $_POST['data_fim_seg'];
                }else{
                    $data_ini_seg = "0000-00-00";
                    $data_fim_seg = "0000-00-00";
                }

                $valor = formataMoney($_POST['valor']);
                $valor_custo = formataMoney($_POST['valor_custo']);
                $horimetro_inicial = $_POST['hr_inicial'];
                $id_empresa = $_POST['empresa'];
                $id_fornecedor = $_POST['fornecedor'];
                $id_responsavel = $_POST['responsavel'];
                $observacao = $_POST['observacao'];

                  $patrimonio = new Maquinario(); 
                      if($patrimonio->atualiza_maquinario($matricula, $chassi_nserie, $modelo, $tipo_consumo, $ano, $cor,
                   $fabricante, $data_compra, $seguro, $data_ini_seg, $data_fim_seg, $horimetro_inicial, $id_empresa,
                                 $id_fornecedor, $id_responsavel, $observacao,  $valor, $valor_custo, $id)){
                        echo '<div class="msg" style="float: left;">Máquinario atualizado com sucesso !</div>';
                        echo '<script>alert("Maquinário atualizado com sucesso")</script>';
                      }else{
                        echo '<div class="msg" style="float: left;">Falha ao atualizar Máquinario!</div>';
                      }                      
                                    

                ?>
            <?php }?> 


            </div>
          </div>
              <?php }?>
              
          
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_maquinario') /*TABELA DE CADASTRO MAQUINARIO*/{?>
                                <?php 
                               //verifica se todas as dependencias do funcionario estão cadastradas

                               $cont = 0;
                               $msg = 'ATENÇÃO!\n\nPara cadastrar um funcionário é necessario:\n\n';


                               $cliente = new Cliente();
                               $cliente = $cliente->get_all_fornecedor();

                               if(!$cliente){
                                  $msg .= ($cont+1).'º Cadastrar um Fornecedor';
                                  $cont++;
                               }

                               if($cont > 0)
                                 echo '<script>alert("'.$msg.'");</script>';
                                ?>
            <div id="content">   
            <div class="formulario">                  
                      <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <input type="hidden" id="local" name="local" value="<?php echo $_GET['local'] ?>"><?php //armazena o local da requisição da pagina ?>
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR MAQUINÁRIO</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
                        <input type="hidden" id="maquinario" name="maquinario" value="cadastrar_maquinario">
                          <table border="0" style="max-width:100%">                          
                              <tr><td><span>Matricula:</span></td> <td><input title="Controle interno da empresa" class="uppercase" type="text" name="matricula" id="matricula"></td><td><span> N° Série / Chassi:</span></td> <td><input class="uppercase" type="text" name="chassi_nserie" id="chassi_nserie"></td></tr>
                              <tr><td><span>Fabricante:</span></td><td><input type="text" name="fabricante" id="fabricante"> <td><span> Modelo:</span></td><td><input type="text" name="modelo" id="modelo"></td></td></tr>            
                              <tr><td><span>Cor:</span></td><td>
                                  <select id="cor" name="cor"  style="width:100%; ">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $cor = new Cor();
                                       $cor = $cor->get_all_cor();
                                       for ($i=0; $i < count($cor) ; $i++) { 
                                          echo '<option value="'.$cor[$i][0].'">'.$cor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select></td></tr>
                              <tr><td><span>Tipo de consumo:</span></td><td>  <select name="tipo_consumo" id="tipo_consumo">
                                                    <option value="Combustivel">Combustível</option>
                                                    <option value="Eletrico">Elétrico</option>                                                    
                                                    </select>
                                </td></tr>  
                              <tr>
                                    <!-- <td>
                                        <span>Tipo:</span>
                                    </td>
                                    <td>
                                        <input type="text" name="tipo" id="tipo">
                                    </td> -->
                                    <td><span>Ano:</span></td>
                                    <td>
                                           <select name="ano" id="ano">
                                            <?php $ano_atual=date("Y"); ?>
                                            
                                                <?php 
                                                           
                                                   for ($ano = $ano_atual; $ano >1950 ; $ano--) { 
                                                              echo '<option value="'.$ano.'">'.$ano.'</option>';
                                                   }
                                                         ?>
                                           </select>
                                    </td>
                              </tr> 
                              <tr><td><span>Data de Compra:</span></td><td><input type="date" name="data_compra" id="data_compra"></td></tr>
                              <tr>
                                  <td>
                                      <span>Seguro: </span><input type="checkbox" class="seguro"  style="height:13px" onclick="tipo_form()" id="seguro" name="seguro" value="0">
                                  </td>
                                  <td colspan="3">
                                      <span>Data inicio:</span><input title="Data início do seguro" id="data_ini_seg" name="data_ini_seg"disabled type="date" style="width:135px">
                                      <span>Data fim:</span><input title="Data Final do seguro" id="data_fim_seg" name="data_fim_seg" disabled  type="date" style="width:135px">
                                  </td>
                              </tr>   
                              <tr><td><span>Valor: </span></td><td><input type="numeric" name="valor" id="valor"></td><td><span>Horimetro:</span></td><td><input title="Horimetro inicial do maquinário" type="number" name="hr_inicial" id="hr_inicial"></td></tr>
                              <tr><td><span>Valor de custo:</span></td><td><input type="numeric" name="custo" id="custo"></td></tr>
                              <tr><td><span>Forncedor:</span></td><td>
                                  <select id="fornecedor" name="fornecedor"  style="width:100%" title="Selecione o fornecedor do maquinário">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $fornecedor = new Cliente();
                                       $fornecedor = $fornecedor->get_all_fornecedor();
                                       for ($i=0; $i < count($fornecedor) ; $i++) { 
                                          echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select></td></tr>
                
                              <td colspan="4" style="text-align:center">
                                      <span><b>Informações do veículo ligado a empresa</b></span>
                              </td></tr>
                              <tr><td><span>Empresa:</span></td><td>
                                  <select id="empresa" name="empresa"  style="width:100%" onchange="buscar_responsavel()">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }
                                     ?>
                                 </select><td><span> Funcionário Responsável: </span></td>
                            <td colspan="2">
                               <div id="load_responsavel">
                                 <select name="responsavel" id="responsavel" style="width:100%" >
                                   <option   value="no_sel" placeholder="Selecione uma empresa">Selecione a empresa</option>
                                 </select>
                               </div>
                            </td></tr>
                            <tr><td><span><b>Observação</b></span></td></tr>                     
                              <tr><td colspan="4"> <textarea align="center" rows="4" cols="80" id="observacao" name="observacao" style="max-width:488px; max-height: 150px" ></textarea> </td></tr>                              
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
                       </form>
                         </div>
                     </div>  
                       <?php include_once("informacoes_maquinario.php") ?>

            <?php /* FIM TABELA MAQUINARIO !!!*/  }?>

            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_veiculo')/*TABELA CADASTRO VEICULO*/{?>
               <?php 
                  //verifica se todas as dependencias do funcionario estão cadastradas
                  
                  $cont = 0;
                  $msg = 'ATENÇÃO!\n\nPara cadastrar um funcionário é necessario:\n\n';
                

                  $cliente = new Cliente();
                  $cliente = $cliente->get_all_fornecedor();

                  if(!$cliente){
                     $msg .= ($cont+1).'º Cadastrar um Fornecedor';
                     $cont++;
                  }
                  
                  if($cont > 0)
                    echo '<script>alert("'.$msg.'");</script>';
               ?>
            
            <div id="content">   
            <div class="formulario">              
                       <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR VEÍCULO</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
                        <input type="hidden" id="local" name="local" value="<?php echo $_GET['local'] ?>"><?php //armazena o local da requisição da pagina ?>
                        <input type="hidden" id="veiculo" name="veiculo" value="cadastrar_veiculo">
                          <table border="0">                          
                                <tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula"></td><td><span>Renavam:</span></td> <td><input type="text" name="renavam" id="renavam" class="uppercase"></td></tr>                             	
                             	<tr><td><span>Placa:</span></td><td><input class="uppercase" type="text" name="placa" id="placa"><td><span> Chassi:</span></td><td><input type="text" name="chassi" id="chassi" class="uppercase"></td></td></tr>
                             	<tr><td><span>Marca:</span></td><td>
                                  <select id="marca" name="marca"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $marca = new Marca();
                                       $marca = $marca->get_all_marca();
                                       for ($i=0; $i < count($marca) ; $i++) { 
                                          echo '<option value="'.$marca[$i][0].'">'.$marca[$i][1].'</option>';
                                       }
                                     ?>
                                 </select></td><td><span>Modelo:</span></td><td><input type="text" name="modelo" id="modelo"></td></tr>                                         
                             	<tr><td><span>Cor:</span></td><td>
                                  <select id="cor" name="cor"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $cor = new Cor();
                                       $cor = $cor->get_all_cor();
                                       for ($i=0; $i < count($cor) ; $i++) { 
                                          echo '<option value="'.$cor[$i][0].'">'.$cor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select></td></tr>
                                 <tr><td><span>Ano:</span></td><td>
                                                    <select name="ano" id="ano">
                                                      <?php $ano_atual=date("Y"); ?>
                                                    <option><?php echo $ano_atual ?></option>
                                                        <?php 
                                                           
                                                           for ($ano = $ano_atual; $ano >1950 ; $ano--) { 
                                                              echo '<option value="'.$ano.'">'.$ano.'</option>';
                                                           }
                                                         ?>
                                                     </select></td></tr>
                             	<tr><td><span>Combustível:</span></td><td>	<select name="combustivel" id="combustivel">
                             												<option value="Gasolina">Gasolina</option>
                             												<option value="Flex">Flex</option>
                             												<option value="Alcool">Álcool</option>
                             												</select>
                              	</td></tr>	
                             	<tr>
                                  <td>
                                      <span>Data de Compra:</span>
                                  </td>
                                  <td>
                                      <input type="date" name="data_compra" id="data_compra">
                                  </td>
                              </tr>
                              <tr>
                                  <td>
                                      <span>Seguro: </span><input type="checkbox" class="seguro"  style="height:13px;" onclick="tipo_form()" id="seguro" name="seguro" value="0">
                                  </td>
                                  <td colspan="3">
                                      <span>Data inicio:</span><input title="Data início do seguro" id="data_ini_seg" name="data_ini_seg" disabled type="date" style="width:135px">
                                      <span>Data fim:</span><input title="Data Final do seguro" id="data_fim_seg" name="data_fim_seg" disabled  type="date" style="width:135px">
                                  </td>
                              </tr>   
                             	<tr><td><span>Valor:</span></td><td><input type="numeric" name="valor" id="valor"></td><td><span>Quilometragem:</span></td><td><input type="numeric" name="km_inicial" id="km_inicial"></td></tr>
                                 <tr><td><span>Valor de Custo:</span></td><td><input type="custo" name="custo" id="custo"></td></tr>
                             	<tr><td><span>Forncedor:</span></td><td>
                             			<select id="fornecedor" name="fornecedor"  style="width:100%">
			                              <option value="no_sel">Selecione</option>
			                              <?php 
			                                 $fornecedor = new Cliente();
			                                 $fornecedor = $fornecedor->get_all_fornecedor();
			                                 for ($i=0; $i < count($fornecedor) ; $i++) { 
			                                    echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
			                                 }
			                               ?>
			                           </select></td></tr>
								
								<div><td colspan="3" style="text-align:center"><span><b>Informações do veículo ligado a empresa</b></span></td></tr></div>
                             	<tr><td><span>Empresa:</span></td><td>
                             			<select id="empresa" name="empresa"  style="width:100%" onchange="buscar_responsavel()">
			                              <option value="no_sel">Selecione</option>
			                              <?php 
			                                 $empresa = new Empresa();
			                                 $empresa = $empresa->get_all_empresa();
			                                 for ($i=0; $i < count($empresa) ; $i++) { 
			                                    echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
			                                 }
			                               ?>
			                           </select><td><span> Funcionario Responsável: </span></td>
		                        <td colspan="2">
		                           <div id="load_responsavel">
		                             <select name="responsavel" id="responsavel" style="width:100%">
		                               <option value="no_sel">Selecione </option>
		                             </select>
		                           </div>
		                        </td></tr>                             	
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
                       </form>
                       </div>
                      </div>
                    <?php include_once("informacoes_veiculo.php") ?>

            <?php /* FIM TABELA VEICULO*/ }?>

              <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_patrimonio_geral'){/*TABELA DE CADASTRO PATRIMONIOS EM GERAL*/?>    
            

             <div id="content">   
            <div class="formulario">
             <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
              <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR PATRIMONIO EM GERAL</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
               <input type="hidden" id="local" name="local" value="<?php echo $_GET['local'] ?>"><?php //armazena o local da requisição da pagina ?>
               <input type="hidden" id="cadastrar_patrimonio_geral" name="cadastrar_patrimonio_geral" value="cadastrar_patrimonio_geral"> 
              <table border="0">
                  <tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula"></td></tr>                               
                  <tr><td><span>Nome:</span></td><td><input type="text" name="nome" id="nome"><td><span> Marca:</span></td><td><input type="text" name="marca" id="marca"></td></td></tr>
                  <tr><td><span>Quantidade:</span></td><td><input type="text" name="quantidade" id="quantidade"> <td><span> Descricao:</span></td><td><input type="text" name="descricao" id="descricao"></td></td></tr>
                  <tr><td><span>Valor:</span></td><td><input type="numeric" name="valor" id="valor"></td><td></tr>
                   <tr><td><span>Valor de custo:</span></td><td><input type="valor_custo" name="valor_custo" id="valor"></td></tr>
                  <tr><td><span>Empresa:</span></td><td>
                                  <select id="empresa" name="empresa"  style="width:100%" onchange="buscar_responsavel()">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }
                                     ?>
                                 </select><td></tr>
                  
                  <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="submit" id="button" value="Cadastrar"> <input type="button" name="button" class="submit" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
              </table>
             </form>             
            </div>
          </div>
        <?php include_once("informacoes_patrimonio_geral.php") ?>
            <?php /*FIM CADASTRO DE PATRIMONIO GERAL*/}?>  
	 	     

	 	    

                     <?php if(isset($_GET['tipo']) =='editar' && isset($_GET['controle']) && $_GET['controle'] == "1"){// EDITAR MAQUINARIO?>                     

                      <?php 
                         
                          $maquinario = new Maquinario();
                          $maquinario = $maquinario->get_maquinario_id($_GET['id']);
                          
                          $funcionario = new Funcionario();
                          $funcionario = $funcionario->get_func_id($maquinario->id_responsavel);
                          
                          
                       ?>
                    <div class="formulario">
                      <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR MAQUINÁRIO</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
                        <input type="hidden" id="atualiza_maquinario" name="atualiza_maquinario" value="editar_maquinario">
                        <input type="hidden" id="id" name="id" value="<?php echo $maquinario->id ?>">
                          <table border="0">                          
                              <tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula" value="<?php echo $maquinario->matricula ?>" ></td><td><span> N° Série / Chassi:</span></td> <td><input class="uppercase" type="text" name="chassi_nserie" id="chassi_nserie" value="<?php echo $maquinario->chassi_nserie ?>" ></td></tr>
                              <tr><td><span>Fabricante:</span></td><td><input type="text" name="fabricante" id="fabricante" value="<?php echo $maquinario->fabricante ?>" > <td><span> Modelo:</span></td><td><input type="text" name="modelo" id="modelo" value="<?php echo $maquinario->modelo ?>"></td></td></tr>            
                               <tr><td><span>Cor:</span></td><td>
                                  <select id="cor" name="cor"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $cor = new Cor();
                                       $cor = $cor->get_all_cor();
                                       for ($i=0; $i < count($cor) ; $i++) { 
                                          echo '<option value="'.$cor[$i][0].'">'.$cor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select>
                               <?php echo "<script> carregaCor('".$maquinario->id_cor."') </script>";  ?>
                             </td></tr>

                              <tr><td><span>Tipo de consumo:</span></td><td>  <select name="tipo_consumo" id="tipo_consumo">
                                                    <option value="<?php echo $maquinario->tipo_consumo ?>"><?php echo $maquinario->tipo_consumo ?></option>
                                                    <option value="combustivel">Combustível</option>
                                                    <option value="eletrico">Elétrico</option>                                                    
                                                    </select>
                                </td></tr>  
                              <tr><!--<td><span>Tipo:</span></td><td><input type="text" name="tipo" id="tipo" value="<?php //echo $maquinario->tipo ?>"></td> -->
                              <td><span>Ano:</span></td>
                              <td>
                                    <select name="ano" id="ano">
                                       <?php $ano_atual = Date("Y"); ?>
                                    <option><?php echo $ano_atual ?></option>
                                         <?php 
                                            
                                            for ($ano = $ano_atual; $ano >1950 ; $ano--) { 
                                               echo '<option value="'.$ano.'">'.$ano.'</option>';
                                            }
                                          ?>
                                      </select>
                                    </td>
                                    
                                    <?php echo "<script> carregaAno('".$maquinario->ano."') </script>";  ?>

                            </tr>
                              <tr>
                                  <td><span>Data de Compra:</span></td>
                                  <td><input type="date" name="data_compra" id="data_compra" value="<?php echo $maquinario->data_compra ?>"></td>
                                  
                           </tr> 


                           <tr>
                                  <!-- <td>
                                      <span>Seguro: </span><input type="checkbox" class="seguro"  style="height:13px;" onclick="tipo_form()" id="seguro" name="seguro" value="0">
                                  </td> -->
                                  <td >
                                        <span>Seguro</span> <input type="checkbox" style="height:12px;width:12px" id="seguro" <?php ($maquinario->seguro == 1)?print 'checked':'' ?> name="seguro">                             
                                  </td>
                                  <td colspan="3">
                                      <span>Data inicio:</span><input title="Data início do seguro" name="data_ini_seg" id="data_ini_seg" <?php ($maquinario->seguro == 1)?print '':print 'disabled' ?> type="date" value="<?php ($maquinario->seguro == 1)?print $maquinario->data_ini_seg:''  ?>" style="width:135px">
                                      <span>Data fim:</span><input title="Data Final do seguro" name="data_fim_seg" id="data_fim_seg" <?php ($maquinario->seguro == 1)?print '':print 'disabled' ?> value="<?php ($maquinario->seguro == 1)?print $maquinario->data_fim_seg:''  ?>" type="date" style="width:135px">
                                  </td>
                              </tr>

                              
                            <tr><td><span>Valor:</span></td><td><input type="numeric" name="valor" id="valor" value="<?php echo verificaValor($maquinario->valor) ?>"></td><td><span>Horimetro:</span></td><td><input type="numeric" name="hr_inicial" id="hr_inicial" value="<?php echo $maquinario->horimetro_inicial ?>"></td></tr>
                            <tr><td><span>Valor de custo:</span></td><td><input type="numeric" name="custo" id="custo" value="<?php echo verificaValor($maquinario->valor_custo) ?>"></td></tr>
                            <tr> <td ><span>Fornecedor: </span></td>
                            <td colspan="2">
                               <select id="fornecedor" name="fornecedor"  style="width:100%">
                                  <option value="no_sel">Selecione um Fornecedor</option>
                                  
                                  <?php 
                                     $fornecedor = new Cliente();
                                     $fornecedor = $fornecedor->get_all_fornecedor();
                                     
                                     for ($i=0; $i < count($fornecedor) ; $i++) { 
                                        echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
                                     }
                                      
                                     ?>
                                 </select>
                               
                                 <?php echo "<script> carregaForncedor('".$maquinario->id_fornecedor."') </script>";  ?>
                              </td>
                              </tr>
                              <td colspan="4" style="text-align:center"><span><b>Informações do veículo ligado a empresa</b></span></td></tr>
                              <tr><td><span>Empresa:</span></td><td>
                                  <select id="empresa" name="empresa"  style="width:100%" onchange="buscar_responsavel()">
                                    <option value="no_sel">Selecione uma Empresa</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }
                                     ?>
                                 </select>
                                 <?php echo "<script> carregaEmpresa('".$maquinario->id_empresa."') </script>";  ?>
                         <td><span> Funcionario Responsável: </span></td>
                              <td colspan="2">
                                 <div id="load_responsavel">
                                   <select name="responsavel" id="responsavel" style="width:100%">
                                     <option value="<?php $maquinario->id_responsavel ?>"><?php echo $funcionario->nome; ?></option>
                                   </select>
                                   <?php echo "<script> buscar_responsavel() </script>";  ?>
                                 </div>
                              </td>
                              <?php echo "<script> carregaResp() </script>";  ?></tr>
                            <tr><td><span><b>Observação</b></span></td></tr>                     
                              <tr><td colspan="4"> <div align="center"><textarea align="center" rows="4" cols="50" id="observacao" name="observacao" ><?php echo $maquinario->observacao ?> </textarea></div> </td></tr>                              
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Confirmar"> <input type="button" name="button" class="button" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
                       </form>                         
                    </div>
                  <?php }?>

                  <?php if(isset($_GET['tipo']) =='editar' && isset($_GET['controle']) && $_GET['controle'] == "2"){?>
                     <?php 
                          
                          $veiculo = new Veiculo();
                          $veiculo = $veiculo->get_veiculo_id($_GET['id']);
                       ?>

                    <div id="content">   
            <div class="formulario">              
                       <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR VEÍCULO</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
                        <input type="hidden" id="atualiza_veiculo" name="atualiza_veiculo" value="editar_veiculo">
                        <input type="hidden" id="id" name="id" value="<?php echo $veiculo->id ?>">
                          <table border="0">                          
                              <tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula" value="<?php echo $veiculo->matricula ?>"></td><td><span>Renavam:</span></td> <td><input type="text" name="renavam" id="renavam" value="<?php echo $veiculo->renavam ?>"></td></tr>                               
                              <tr><td><span>Placa:</span></td><td><input class="uppercase" type="text" name="placa" id="placa" value="<?php echo $veiculo->placa ?>"><td><span> Chassi:</span></td><td><input type="text" name="chassi" id="chassi" class="uppercase" value="<?php echo $veiculo->chassi ?>"></td></td></tr>
                              <tr><td><span>Marca:</span></td><td>
                                  <select id="marca" name="marca"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $marca = new Marca();
                                       $marca = $marca->get_all_marca();
                                       for ($i=0; $i < count($marca) ; $i++) { 
                                          echo '<option value="'.$marca[$i][0].'">'.$marca[$i][1].'</option>';
                                       }
                                     ?>
                                 </select><?php echo "<script> carregaMarca('".$veiculo->id_marca."') </script>";  ?></td><td><span> Modelo:</span></td><td><input type="text" name="modelo" id="modelo" value="<?php echo $veiculo->modelo ?>"></td></td></tr>            
                              <tr><td><span>Cor:</span></td><td>
                                  <select id="cor" name="cor"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $cor = new Cor();
                                       $cor = $cor->get_all_cor();
                                       for ($i=0; $i < count($cor) ; $i++) { 
                                          echo '<option value="'.$cor[$i][0].'">'.$cor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select><?php echo "<script> carregaCor('".$veiculo->id_cor."') </script>";  ?></td><td>
                                 <span>Ano:</span></td><td>
                                                    <select name="ano" id="ano">
                                                      <?php $ano_atual=$veiculo->ano; ?>
                                                    <option><?php echo $ano_atual ?></option>
                                                        <?php 
                                                           
                                                           for ($ano = $ano_atual; $ano >1950 ; $ano--) { 
                                                              echo '<option value="'.$ano.'">'.$ano.'</option>';
                                                           }
                                                         ?>
                                                     </select></td></tr>
                              <tr><td><span>Combustível:</span></td><td>  <select name="combustivel" id="combustivel">
                                                    <option value="<?php echo $veiculo->tipo_combustivel ?>"><?php echo $veiculo->tipo_combustivel ?></option>
                                                    <option value="Gasolina">Gasolina</option>
                                                    <option value="Flex">Flex</option>
                                                    <option value="Alcool">Álcool</option>
                                                    </select>
                                </td></tr>  
                               </tr>
                              <tr>
                                  <td><span>Data de Compra:</span></td>
                                  <td><input type="date" name="data_compra" id="data_compra" value="<?php echo $veiculo->data_compra ?>"></td>
                                  
                           </tr> 


                           <tr>
                                  <!-- <td>
                                      <span>Seguro: </span><input type="checkbox" class="seguro"  style="height:13px;" onclick="tipo_form()" id="seguro" name="seguro" value="0">
                                  </td> -->
                                  <td >
                                        <span>Seguro</span> <input type="checkbox" style="height:12px;width:12px" id="seguro" <?php ($veiculo->seguro == 1)?print 'checked':'' ?> name="seguro">                             
                                  </td>
                                  <td colspan="3">
                                      <span>Data inicio:</span><input title="Data início do seguro" name="data_ini_seg" id="data_ini_seg" <?php ($veiculo->seguro == 1)?print '':print 'disabled' ?> type="date" value="<?php ($veiculo->seguro == 1)?print $veiculo->data_ini_seg:''  ?>" style="width:135px">
                                      <span>Data fim:</span><input title="Data Final do seguro" name="data_fim_seg" id="data_fim_seg" <?php ($veiculo->seguro == 1)?print '':print 'disabled' ?> value="<?php ($veiculo->seguro == 1)?print $veiculo->data_fim_seg:''  ?>" type="date" style="width:135px">
                                  

                                  </td>
                              </tr>
                              <tr><td><span>Valor:</span></td><td><input type="numeric" name="valor" id="valor" value="<?php echo verificaValor($veiculo->valor) ?>"></td><td><span>Quilometragem:</span></td><td><input type="numeric" name="km_inicial" id="km_inicial" value="<?php echo $veiculo->km_inicial ?>"></td></tr>
                              <tr><td><span>Valor de custo:</span></td><td><input type="numeric" name="custo" id="custo" value="<?php echo verificaValor($veiculo->valor_custo) ?>"></td></tr>
                              <tr> <td ><span>Fornecedor: </span></td>
                              <td colspan="2">
                                 <select id="fornecedor" name="fornecedor"  style="width:100%">
                                    <option value="no_sel">Selecione um Fornecedor</option>
                                    <?php 
                                       $fornecedor = new Cliente();
                                       $fornecedor = $fornecedor->get_all_fornecedor();
                                       for ($i=0; $i < count($fornecedor) ; $i++) { 
                                          echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select>
                                 <?php echo "<script> carregaFornecedor('".$veiculo->id_fornecedor."') </script>";  ?>
                              </td>
                              </tr>
                
                <div><td colspan="3" style="text-align:center"><span><b>Informações do veículo ligado a empresa</b></span></td></tr></div>
                              <tr><td><span>Empresa:</span></td><td>
                                  <select id="empresa" name="empresa"  style="width:100%" onchange="buscar_responsavel()">
                                    <option value="no_sel">Selecione uma Empresa</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }
                                     ?>
                                 </select>
                                 <?php echo "<script> carregaEmpresa('".$veiculo->id_empresa."') </script>";  ?>
                         <td><span> Funcionario Responsável: </span></td>
                              <td colspan="2">
                                 <div id="load_responsavel">
                                   <select name="responsavel" id="responsavel" style="width:100%">
                                     <option value="no_sel">Selecione um Eesponsável</option>
                                   </select>
                                   <?php echo "<script> buscar_responsavel() </script>";  ?>
                                 </div>
                              </td>
                              <?php echo "<script> carregaResp() </script>";  ?></tr> 
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Confirmar"> <input type="button" name="button" class="button" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
                       </form>
                       </div>
                      </div>
                  <?php /*FIM EDITAR*/}?>

                  <?php if(isset($_GET['tipo']) =='editar' && isset($_GET['controle']) && $_GET['controle'] == "0"){?> 
                  <?php 
                    
                    $patrimonio_geral = new Patrimonio_geral();
                    $patrimonio_geral = $patrimonio_geral->get_patrimonio_geral_id($_GET['id']);

                   ?>
            <div id="content">   
            <div class="formulario">
             <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
              <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR PATRIMONIO EM GERAL</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
               <input type="hidden" id="atualiza_patrimonio_geral" name="atualiza_patrimonio_geral" value="editar_patrimonio_geral">
               <input type="hidden" id="id" name="id" value="<?php echo $patrimonio_geral->id ?>"> 
              <table border="0">
                  <tr><td><span>Matricula:</span></td> <td><input class="uppercase" value="<?php echo $patrimonio_geral->matricula ?>" type="text" name="matricula" id="matricula"></td></tr>                               
                  <tr><td><span>Nome:</span></td><td><input type="text" name="nome" id="nome" value="<?php echo $patrimonio_geral->nome ?>"><td><span> Marca:</span></td><td><input type="text" name="marca" id="marca"value="<?php echo $patrimonio_geral->marca ?>"></td></td></tr>
                  <tr><td><span>Quantidade:</span></td><td><input type="text" name="quantidade" id="quantidade" value="<?php echo $patrimonio_geral->quantidade ?>"> <td><span> Descricao:</span></td><td><input type="text" name="descricao" id="descricao" value="<?php echo $patrimonio_geral->descricao?>"></td></td></tr>
                  <tr><td><span>Valor:</span></td><td><input type="numeric" name="valor" id="valor" value="<?php echo verificaValor($patrimonio_geral->valor) ?>"></td><td></tr>
                  <tr><td><span>Valor de custo:</span></td><td><input type="numeric" name="valor_custo" id="valor_custo" value="<?php echo verificaValor($patrimonio_geral->valor_custo) ?>">></td></tr>
                  <tr><td><span>Empresa:</span></td><td>
                                  <select id="empresa" name="empresa"  style="width:100%" onchange="buscar_responsavel()">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }
                                     ?>                                     
                                 </select><td></tr>
                   <?php echo "<script> carregaEmpresa('".$patrimonio_geral->id_empresa."') </script>";  ?>
                  <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="submit" id="button" value="Confirmar"> <input type="button" name="button" class="submit" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
              </table>
             </form>             
            </div>
          </div>
                  <?php }?>

          
</body>
</html>