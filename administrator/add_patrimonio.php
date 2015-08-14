<?php
include("restrito.php");
include_once("../model/class_empresa_bd.php");
include_once("../model/class_patrimonio_bd.php");
include_once("../model/class_grupo_bd.php");
include_once("../model/class_cliente.php");
include_once("../model/class_custo_bd.php");
function validate(){
   if(!isset($_POST['nome']) || $_POST['nome'] == ""){
         return false;
   }
   return true;
}

// formata o valor antes de enviar para o banco de dados
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
    //pega quantidade de caracteres - posisão do .
    if(strlen($valor) - strpos($valor, '.') < 3){
       $valor.='0';
    }else if(strpos($valor, '.') == 0){
      $valor.='.00';
    }
    return $valor;
}

 ?>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <script src="../javascript/jquery.maskMoney.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">

</head>

<script type="text/javascript">

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
    
    
   function id( el ){
     // alert("id")
     return document.getElementById( el );
   }
   window.onload = function(){
      id('valor_compra').onkeypress = function(){ 
          mascara( this, mmoney );
      }
      id('valor_hora').onkeypress = function(){ 
          mascara( this, mmoney );
      }
   }
   // fim mascaras



function confirma(id,nome, tipopess){
       if(confirm("Excluir cliente "+nome+" , tem certeza?") ){
          var url = '../ajax/ajax_excluir_patrimonio.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
            
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
    }


function valida(f){
   
          var erros = 0;
          var msg = "";
          for (var i = 0; i < f.length; i++) {
                if(f[i].name == "grupo"){
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
                if(f[i].name == "desc"){
                    if(f[i].value == ""){
                       f[i].style.border = "1px solid #FF0000";
                       erros++;
                    }else{
                       f[i].style.border = "1px solid #898989";
                    }
                }
                if(f[i].name == "valor_compra"){
                    if(f[i].value == ""){
                       f[i].style.border = "1px solid #FF0000";
                       erros++;
                    }else{
                       f[i].style.border = "1px solid #898989";
                    }
                }
                if(f[i].name == "valor_hora"){
                    if(f[i].value == ""){
                       f[i].style.border = "1px solid #FF0000";
                       erros++;
                    }else{
                       f[i].style.border = "1px solid #898989";
                    }
                }
                if(f[i].name == "fornecedor"){
                    if(f[i].value == "no_sel"){
                       f[i].style.border = "1px solid #FF0000";
                       erros++;
                    }else{
                       f[i].style.border = "1px solid #898989";
                    }
                }
                if(f[i].name == "empresa"){
                    if(f[i].value == "no_sel"){
                       f[i].style.border = "1px solid #FF0000";
                       erros++;
                    }else{
                       f[i].style.border = "1px solid #898989";
                    }
                }
                if(f[i].name == "responsavel"){
                    if(f[i].value == "no_sel"){
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
function carregaGrupo(grupo){      
      
      var combo = document.getElementById("grupo");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == grupo)
        {
          combo.options[i].selected = true;
          break;
        }
      }
    }

function carregaForncedor(fornecedor){
      
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


function carregaResp(){      
      var responsavel = document.getElementById('id_responsavel').value;
      var combo = document.getElementById("responsavel");
      for (var i = 0; i < combo.options.length; i++)
      {
        if (combo.options[i].value == responsavel)
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
  function disparaLoadCidade(){
      // mascara( document.getElementById('valor_hora'), mmoney );
     
      setTimeout(function() {
          carregaResp();
          setTimeout(function() {mascara( document.getElementById('valor_compra'), mmoney )},250);
          setTimeout(function() {mascara( document.getElementById('valor_hora'), mmoney )},200);
        }, 100);

       
  }

</script>

<body onload="disparaLoadCidade()">			
	
			<?php include_once("../view/topo.php"); ?>
			<div id="content">                                               
            <div class="formulario">
			<?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){ ?>            	
					<?php 
            		 $id = $_GET['id'];
                     $patrimonio = new Patrimonio();
                     $custo = new Custo();
                     $patrimonio = $patrimonio->get_patrimonio_id($id);
                	   $id = $patrimonio->id;
                     $nome = $patrimonio->nome;
                     $descricao = $patrimonio->descricao;
                     $valor_compra = verificaValor($patrimonio->valor_compra);
                     $id_custo = $patrimonio->id_custo;                                          
                     $custo = $custo->get_valor_id($id_custo);
                     $valor_hora = verificaValor($custo->valor_hora);
                     //  echo strpos($valor_compra, '.');
                     // if(strlen($valor_compra) - strpos($valor_compra, '.') < 3){
                     //    $valor_compra.='0';
                     // }


                     $id_grupo = $patrimonio->id_grupo;
                     $id_fornecedor = $patrimonio->id_fornecedor;
                     $id_responsavel = $patrimonio->id_responsavel;
                     $id_empresa = $patrimonio->id_empresa;

            	 ?>
                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR PATRIMONIO</span></div></div>
                       <form form method="POST" id="add_patrimonio" action="add_patrimonio.php" onsubmit="return valida(this)">
                            <input type="hidden" id="tipo" name="tipo" value="editar">
                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                            <input type="hidden" id="id_custo" name="id_custo" value="<?php echo $id_custo ?>"> 
                            <input type="hidden" id="id_responsavel" name="id_responsavel" value="<?php echo $id_responsavel ?>">                          
                            <table border="0">
                              <tr> <td ><span>Grupo:</span></td>
                              <td colspan="2">
                                 <select id="grupo" name="grupo"  style="width:100%">
                                    <option value="no_sel">Selecione um Grupo</option>
                                    <?php 
                                       $grupo = new Grupo();
                                       $grupo = $grupo->get_name_all_grupo();
                                       for ($i=0; $i < count($grupo) ; $i++) { 
                                          echo '<option value="'.$grupo[$i][0].'">'.$grupo[$i][1].'</option>';
                                       }
                                     ?>

                                 </select>
                                  <?php echo "<script> carregaGrupo('".$patrimonio->id_grupo."') </script>";  ?>                              
                              </td>                            
                              </tr>                          
                           		<tr><td><span>Nome: </span></td> <td><input type="text" name="nome" id="nome" value="<?php echo $nome ?>" ></td></tr>
                          		<tr><td><span>Descricão: </span></td><td><input type="text" name="desc" id="desc" value="<?php echo $descricao ?>"></td></tr>
                          		<tr><td><span>Valor Compra: </span></td><td><input type="text" name="valor_compra" id="valor_compra" value="<?php echo $valor_compra ?>" ></td></tr>
                          		<tr><td><span>Valor hora: </span></td><td><input type="text" name="valor_hora" id="valor_hora" value="<?php echo $valor_hora ?>"  ></td></tr>
                              <tr> <td ><span>Fornecedor: </span></td>
                              <td colspan="2">
                                 <select id="fornecedor" name="fornecedor"  style="width:100%">
                                    <option value="no_sel">Selecione um Fornecedor</option>
                                    <?php 
                                       $fornecedor = new Cliente();
                                       $fornecedor = $fornecedor->get_all_cliente();
                                       for ($i=0; $i < count($fornecedor) ; $i++) { 
                                          echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select>
                                 <?php echo "<script> carregaForncedor('".$patrimonio->id_fornecedor."') </script>";  ?>
                              </td>
                              </tr>
                              <tr> <td ><span>Empresa:</span></td>
                              <td colspan="2">
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
                                 <?php echo "<script> carregaEmpresa('".$patrimonio->id_empresa."') </script>";  ?>
                              </td>
                              </tr>
                              <tr>
                              <td><span> Funcionario Responsável: </span></td>
                              <td colspan="2">
                                 <div id="load_responsavel">
                                   <select name="responsavel" id="responsavel" style="width:100%">
                                     <option value="no_sel">Selecione um Eesponsável</option>
                                   </select>
                                   <?php echo "<script> buscar_responsavel() </script>";  ?>
                                 </div>
                              </td>
                              <?php echo "<script> carregaResp() </script>";  ?>
                              </tr>                                           
                           <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Salvar"> <input type="button" name="button" class="button" onclick="window.location.href='add_grupo.php'" id="button" value="Cancelar"></td></tr>  
                            </table>                            
                       </form>              
            <?php }else{ ?>              
                       <form method="POST" class="add_patrimonio" id="add_patrimonio" name="add_patrimonio" action="add_patrimonio.php" onsubmit="return valida(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">ADICIONAR PATRIMONIO</span></div></div>
                        <input type="hidden" id="tipo" name="tipo" value="cadastrar">                        
                          <table border="0">
                         	    <tr> <td ><span>Grupo:</span></td>
			                        <td colspan="2">
			                           <select id="grupo" name="grupo"  style="width:100%" onchange="carrega_postos()">
			                              <option value="no_sel">Selecione um Grupo</option>
			                              <?php 
			                                 $grupo = new Grupo();
			                                 $grupo = $grupo->get_name_all_grupo();
			                                 for ($i=0; $i < count($grupo) ; $i++) { 
			                                    echo '<option value="'.$grupo[$i][0].'">'.$grupo[$i][1].'</option>';
			                                 }
			                               ?>
			                           </select>                                 
			                        </td>		                         
			                        </tr>                                                        
                          		<tr><td><span>Nome: </span></td> <td><input type="text" name="nome" id="nome"></td></tr>
                          		<tr><td><span>Descricão: </span></td><td><input type="text" name="desc" id="desc"></td></tr>
                          		<tr><td><span>Valor Compra: </span></td><td><input type="text" name="valor_compra" id="valor_compra"></td></tr>
                          		<tr><td><span>Valor hora: </span></td><td><input type="text" name="valor_hora" id="valor_hora"></td></tr>
                          		<tr> <td ><span>Fornecedor: </span></td>
			                        <td colspan="2">
			                           <select id="fornecedor" name="fornecedor"  style="width:100%">
			                              <option value="no_sel">Selecione um Fornecedor</option>
			                              <?php 
			                                 $fornecedor = new Cliente();
			                                 $fornecedor = $fornecedor->get_all_cliente();
			                                 for ($i=0; $i < count($fornecedor) ; $i++) { 
			                                    echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
			                                 }
			                               ?>
			                           </select>
			                        </td>
			                    </tr>                                                       	
                             	<tr> <td ><span>Empresa:</span></td>
			                        <td colspan="2">
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
			                        </td>
			                        </tr>
                             	 </tr>                                                       	
                             	<tr>
		                        <td><span> Funcionario Responsável: </span></td>
		                        <td colspan="2">
		                           <div id="load_responsavel">
		                             <select name="responsavel" id="responsavel" style="width:100%">
		                               <option value="no_sel">Selecione um funcionario responsavel</option>
		                             </select>
		                           </div>
		                        </td>
		                        </tr>
                              	
                          		<tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
                          </table>                          
                       </form>
            <?php }?>         
            <?php 

                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                		echo '<script>alert("'.formataMoney($_POST['valor_compra']).'")</script>';
                    if(validate()){
                      $custo = new Custo();
                      $nome = $_POST['nome'];
                      $descricao = $_POST['desc'];                    
                      $id_grupo = $_POST['grupo'];                      
                      $id_fornecedor = $_POST['fornecedor'];
                      $id_responsavel = $_POST['responsavel'];
                      $id_empresa = $_POST['empresa'];                     
                      $valor_compra = formataMoney($_POST['valor_compra']);
                      $valor_hora = formataMoney($_POST['valor_hora']);

                      $custo->add_custo($valor_hora);
                      $id_custo = $custo->add_custo_bd();                      
  
                      $patrimonio = new Patrimonio();
                      $patrimonio->add_patrimonio($id_custo, $id_grupo, $id_responsavel, $id_fornecedor, $id_empresa, $valor_compra, $nome, $descricao);
    
                      if($patrimonio->add_patrimonio_bd()){
                        echo '<div class="msg">Patrimonio adicionado com sucesso !</div>';
                      }else{
                        echo '<div class="msg">Falha ao adicionar Patrimonio!</div>';
                      }                      
                			
                      }
                   }

                if(isset($_POST['tipo']) && $_POST['tipo'] == 'editar'){
                  
                            if(validate()){
                               $custo = new Custo();
                               $patrimonio = new Patrimonio();
                               $id = $_POST['id'];
                               $nome = $_POST['nome'];
                               $descricao = $_POST['desc'];                    
                               $id_grupo = $_POST['grupo'];                      
                               $id_fornecedor = $_POST['fornecedor'];
                               $id_responsavel = $_POST['id_responsavel'];
                               $id_empresa = $_POST['empresa'];                     
                               $valor_compra = formataMoney($_POST['valor_compra']);                               
                               $id_custo = $_POST['id_custo'];
                               $valor_hora = formataMoney($_POST['valor_hora']);
                               $custo->atualiza_valor($valor_hora, $id_custo);                             

                               
                               $patrimonio->add_patrimonio($nome, $descricao, $id_grupo, $id_fornecedor, $id_responsavel, $id_empresa, $id_custo, $valor_compra, $id);
                              if($patrimonio->atualiza_patrimonio($nome, $descricao, $id_grupo, $id_fornecedor, $id_responsavel, $id_empresa, $id_custo, $valor_compra, $id)){
                                 echo '<div class="msg">Atualizado com sucesso!</div>';

                              }else{
                                 echo '<div class="msg">Falha na atualização!</div>';
                              }                              
                         }                
                  }
                
            ?>   
	</div>
	
</div> 
<?php  include_once("informacoes_patrimonio.php");?>
</body>
</html>