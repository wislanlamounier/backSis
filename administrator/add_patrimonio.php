// <?php
include("restrito.php"); 
include_once("../model/class_empresa_bd.php");
include_once("../model/class_cliente.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_maquinario_bd.php");
function validate(){
   if(!isset($_POST['cor']) || $_POST['cor'] == ""){
         return false;
   }
   return true;
}
 ?>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style.css">
	 <script type="text/javascript">


   function tipo_form(){
    if(document.getElementById("seguro").checked == true){
      document.getElementById("seguro").value = 1;
     }else{
      document.getElementById("seguro").value = 0;
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

<body>	
			<?php include_once("../view/topo.php"); ?>

			<div id="content">   

            <div class="formulario">

             <?php if(!isset($_GET['menu'])){?>
             <div class="menu_patrimonio">
                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">PATRIMONIO</span></div></div>

              <form>                
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_maquinario">
                <input type="hidden" id="tipo" name="menu" value="0">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Maquinário"></td></tr>
              </form>
              <form>
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_geral">
                <input type="hidden" id="tipo" name="menu" value="0">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Geral"></td></tr>
              </form>              
              <form>
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_veiculo">
                <input type="hidden" id="tipo" name="menu" value="0">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Veículo"></td></tr>
              </form>
              </div>
            <?php }?>
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_maquinario'){?>                  
                      <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR MAQUINÁRIO</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
                        <input type="hidden" id="maquinario" name="maquinario" value="cadastrar_maquinario">
                          <table border="0">                          
                              <tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula"></td><td><span> N° Série / Chassi:</span></td> <td><input class="uppercase" type="text" name="chassi_nserie" id="chassi_nserie"></td></tr>
                              <tr><td><span>Fabricante:</span></td><td><input type="text" name="fabricante" id="fabricante"> <td><span> Modelo:</span></td><td><input type="text" name="modelo" id="modelo"></td></td></tr>            
                              <tr><td><span>Cor:</span></td><td><input type="text" name="cor" id="cor"><td></td></tr>
                              <tr><td><span>Tipo de consumo:</span></td><td>  <select name="tipo_consumo" id="tipo_consumo">
                                                    <option value="gasolina">Combustível</option>
                                                    <option value="flex">Elétrico</option>                                                    
                                                    </select>
                                </td></tr>  
                              <tr><td><span>Tipo:</span></td><td><input type="text" name="tipo" id="tipo"> <td><span>Ano:</span></td><td>
                                                    <select name="ano" id="ano">
                                                    <option >Selecione</option>
                                                        <?php 
                                                           $ano_atual=date("Y");
                                                           for ($ano = 1950; $ano < $ano_atual ; $ano++) { 
                                                              echo '<option value="'.$ano.'">'.$ano.'</option>';
                                                           }
                                                         ?>
                                                     </select></td></td></tr>
                              <tr><td><span>Data de Compra:</span></td><td><input type="date" name="data_compra" id="data_compra"></td><td><span>Seguro</span></td><td><input type="checkbox" class="seguro" onclick="tipo_form()" id="seguro" name="seguro" value="0"></td></tr>
                              <tr><td><span>Valor:</span></td><td><input type="numeric" name="valor" id="valor"></td><td><span>Horimetro:</span></td><td><input type="numeric" name="hr_inicial" id="hr_inicial"></td></tr>
                              <tr><td><span>Forncedor:</span></td><td>
                                  <select id="fornecedor" name="fornecedor"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $fornecedor = new Cliente();
                                       $fornecedor = $fornecedor->get_all_cliente();
                                       for ($i=0; $i < count($fornecedor) ; $i++) { 
                                          echo '<option value="'.$fornecedor[$i][0].'">'.$fornecedor[$i][1].'</option>';
                                       }
                                     ?>
                                 </select></td></tr>
                
                <div class="msg"><td colspan="3" style="text-align:center"><span><b>Informações do veículo ligado a empresa</b></span></td></tr></div>
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
                            <tr><td><span><b>Observação</b></span></td></tr>                     
                              <tr><td colspan="4"> <div align="center"><textarea align="center" rows="4" cols="50" id="observacao" name="observacao" ></textarea></div> </td></tr>                              
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
                       </form>         
            <?php }?>
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_veiculo'){?>              
                       <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR VEÍCULO</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
                        <input type="hidden" id="tipo" name="tipo" value="cadastrar_veiculo">
                          <table border="0">                          
                          		<tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula"></td><td><span>Renavam:</span></td> <td><input type="text" name="renavam" id="renavam"></td></tr>                             	
                             	<tr><td><span>Placa:</span></td><td><input class="uppercase" type="text" name="placa" id="placa"><td><span> Chassi:</span></td><td><input type="text" name="chassi" id="chassi" class="uppercase"></td></td></tr>
                             	<tr><td><span>Marca:</span></td><td><input type="text" name="marca" id="marca"> <td><span> Modelo:</span></td><td><input type="text" name="modelo" id="modelo"></td></td></tr>            
                             	<tr><td><span>Cor:</span></td><td><input type="text" name="cor" id="cor"><td><span>Ano:</span></td><td>
                                                    <select name="ano" id="ano">
                                                    <option >Selecione</option>
                                                        <?php 
                                                           $ano_atual=date("Y");
                                                           for ($ano = 1950; $ano < $ano_atual ; $ano++) { 
                                                              echo '<option value="'.$ano.'">'.$ano.'</option>';
                                                           }
                                                         ?>
                                                     </select></td></tr>
                             	<tr><td><span>Combustível:</span></td><td>	<select name="combustivel" id="combustivel">
                             												<option value="gasolina">Gasolina</option>
                             												<option value="flex">Flex</option>
                             												<option value="alcool">Álcool</option>
                             												</select>
                              	</td></tr>	
                             	<tr><td><span>Data de Compra:</span></td><td><input type="date" name="data_compra" id="data_compra"></td><td><span>Seguro</span></td><td><input type="checkbox" class="seguro" onclick="tipo_form()" id="seguro" name="seguro" value="0"></td></tr>
                             	<tr><td><span>Valor:</span></td><td><input type="numeric" name="valor" id="valor"></td><td><span>Quilometragem:</span></td><td><input type="numeric" name="km_inicial" id="km_inicial"></td></tr>
                             	<tr><td><span>Forncedor:</span></td><td>
                             			<select id="fornecedor" name="fornecedor"  style="width:100%">
			                              <option value="no_sel">Selecione</option>
			                              <?php 
			                                 $fornecedor = new Cliente();
			                                 $fornecedor = $fornecedor->get_all_cliente();
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
            <?php }?>

             <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_geral'){?> 
             
             <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
              <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR PATRIMONIO EM GERAL</span></div><input type="button" style="margin-top: 5px;" onclick="window.location.href='add_patrimonio.php'" id="button" class="button" name="button"value="Voltar"></div>
               <input type="hidden" id="geral" name="geral" value="cdastrar_geral"> 
              <table border="0">
                  <tr><td><span>Matricula: </span></td><td><input type="text" nome="matricula" id="matricula"></td></tr>
                  <tr><td><span>Nome: </span></td><td><input type="text" nome="nome" id="nome"></td></tr>
                  <tr><td><span>Marca: </span></td><td><input type="text" nome="marca" id="marca"></td></tr>
                  <tr><td><span>Descricao: </span></td><td><input type="text" nome="descricao" id="descricao"></td></tr>
                  <tr><td><span>Quantidade: </span></td><td><input type="numeric" nome="quantidade" id="quantidade"></td></tr>
                  <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="submit" id="button" value="Cadastrar"> <input type="button" name="button" class="submit" onclick="window.location.href='add_patrimonio.php'" id="button" value="Cancelar"></td></tr>
              </table>
             </form>             
                  
            <?php }?>  
	 	    
	 	     <?php 

                 if(isset($_POST['maquinario']) && $_POST['maquinario'] == "cadastrar_maquinario"){
                    // echo '<script>alert("'.formataMoney($_POST['valor_compra']).'")</script>';                    
                    if(validate()){

                      echo  "<br>".  $matricula = $_POST['matricula'];           
                      echo  "<br>".  $chassi_nserie = $_POST['chassi_nserie'];
                      echo  "<br>".  $fabricante = $_POST['fabricante'];
                      echo  "<br>".  $modelo = $_POST['modelo'];
                      echo  "<br>".  $cor = $_POST['cor'];
                      echo  "<br>".  $tipo_consumo = $_POST['tipo_consumo'];
                      echo  "<br>".  $tipo = $_POST['tipo'];
                      echo  "<br>".  $ano = $_POST['ano'];
                      echo  "<br>".  $data_compra = $_POST['data_compra'];
                      echo  "<br>".  $seguro = $_POST['seguro'];
                      echo  "<br>".  $valor = $_POST['valor'];
                      echo  "<br>".  $horimetro_inicial = $_POST['hr_inicial'];
                      echo  "<br>".  $id_empresa = $_POST['empresa'];
                      echo  "<br>".  $id_fornecedor = $_POST['fornecedor'];
                      echo  "<br>".  $id_responsavel = $_POST['responsavel'];                        
                      echo  "<br>".  $observacao = $_POST['observacao'];
                      echo  "<br>".  $horimetro_final = 0;


                      $maquinario = new Maquinario();
                      $maquinario->add_maquinario($matricula, $chassi_nserie, $modelo, $tipo, $tipo_consumo, $ano, $cor, $fabricante, $data_compra, $seguro, $horimetro_inicial, $horimetro_final, $id_empresa, $id_fornecedor, $id_responsavel, $observacao, $valor);
    
                      if($maquinario->add_maquinario_bd()){
                        echo '<div class="msg">Maquinario adicionado com sucesso !</div>';
                      }else{
                        echo '<div class="msg">Falha ao adicionar Maquinario!</div>';
                      }                      
                      
                      }
                   }



                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar_veiculo"){
                		// echo '<script>alert("'.formataMoney($_POST['valor_compra']).'")</script>';
                 
                    if(validate()){
                                                                                      		
                        echo  "<br>". $matricula = $_POST['matricula'];
                        echo  "<br>". $chassi = $_POST['chassi'];
                        echo  "<br>". $renavam = $_POST['renavam'];
                        echo  "<br>". $placa = $_POST['placa'];
                        echo  "<br>". $marca = $_POST['marca'];
                        echo  "<br>". $modelo = $_POST['modelo'];
                        echo  "<br>". $ano = $_POST['ano'];
                        echo  "<br>". $cor = $_POST['cor'];
                        echo  "<br>". $valor = $_POST['valor'];
                        echo  "<br>". $data_compra = $_POST['data_compra'];
                        echo  "<br>". $seguro = $_POST['seguro'];
                        
                        echo  "<br>". $km_inicial = $_POST['km_inicial'];
                        echo  "<br>". $tipo_combustivel = $_POST['combustivel'];							
                        echo  "<br>". $id_empresa = $_POST['empresa'];
                        echo  "<br>". $id_fornecedor = $_POST['fornecedor'];
                        echo  "<br>". $id_responsavel = $_POST['responsavel'];
                        
						          
                      $veiculo = new Veiculo();
                      $veiculo->add_veiculo($matricula, $chassi, $renavam, $placa, $marca, $modelo, $ano, $cor, $valor, $data_compra, $seguro, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel);
                      
                      if($veiculo->add_veiculo_bd()){
                        echo '<div class="msg">Veiculo adicionado com sucesso !</div>';
                      }else{
                        echo '<div class="msg">Falha ao adicionar Veiculo!</div>';
                      }                      
                			
                      }
                   }

                ?>
                </div> 
	 	</div>
</body>
</html>