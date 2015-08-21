<?php
include("restrito.php"); 
include_once("../model/class_empresa_bd.php");
include_once("../model/class_cliente.php");
include_once("../model/class_veiculo_bd.php");
function validate(){
   if(!isset($_POST['marca']) || $_POST['marca'] == ""){
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

            <div class="formulario" method="POST" action="add_patrimonio.php">

             <?php if(isset($_GET['tipo']) && $_GET['tipo'] == ""){?>
              <form>
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_maquinario">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Maquinario"> <input type="button" name="button" class="button" onclick="window.location.href='add_veiculo.php'" id="button" value="Cancelar"></td></tr>
              </form>
              <div class="formulario" method="POST" action="add_patrimonio.php">
              <form>
                <input type="hidden" id="tipo" name="tipo" value="cadastrar_veiculo">
                <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="Veiculo"> <input type="button" name="button" class="button" onclick="window.location.href='add_veiculo.php'" id="button" value="Cancelar"></td></tr>
              </form>
            <?php }?>
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_maquinario'){?>  
                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR GRUPO GRUPO</span></div></div>
                      <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR MAQUINARIO</span></div></div>
                        <input type="hidden" id="tipo" name="tipo" value="cadastrar_maquinario">
                          <table border="0">                          
                              <tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula"></td><td><span>Renavam:</span></td> <td><input type="text" name="renavam" id="renavam"></td></tr>                               
                              <tr><td><span>Placa:</span></td><td><input class="uppercase" type="text" name="placa" id="placa"><td><span> Chassi:</span></td><td><input type="text" name="chassi" id="chassi" class="uppercase"></td></td></tr>
                              <tr><td><span>Marca:</span></td><td><input type="text" name="marca" id="marca"> <td><span> Modelo:</span></td><td><input type="text" name="modelo" id="modelo"></td></td></tr>            
                              <tr><td><span>Cor:</span></td><td><input type="text" name="cor" id="cor"><td><span> Ano:</span></td><td><input type="date" name="ano" id="ano"></td></td></tr>
                              <tr><td><span>Combustível:</span></td><td>  <select name="combustivel" id="combustivel">
                                                    <option value="gasolina">Gasolina</option>
                                                    <option value="flex">Flex</option>
                                                    <option value="alcool">Álcool</option>
                                                    </select>
                                </td></tr>  
                              <tr><td><span>Seguro:</span></td><td><input class="seguro" type="checkbox"  name="seguro" value="1"></td></tr>                              
                              <tr><td><span>Horimetro Inicial:</span></td><td><input type="numeric" name="km_inicial" id="km_inicial"></td></tr>
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
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_veiculo.php'" id="button" value="Cancelar"></td></tr>
                       </form>         
            <?php }?>
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'cadastrar_veiculo'){?>              
                       <form method="POST" class="add_patrimonio" id="add_patrimonio" name="patrimonio" action="add_patrimonio.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">CADASTRAR VEÍCULO</span></div></div>
                        <input type="hidden" id="tipo" name="tipo" value="cadastrar_veiculo">
                          <table border="0">                          
                          		<tr><td><span>Matricula:</span></td> <td><input class="uppercase" type="text" name="matricula" id="matricula"></td><td><span>Renavam:</span></td> <td><input type="text" name="renavam" id="renavam"></td></tr>                             	
                             	<tr><td><span>Placa:</span></td><td><input class="uppercase" type="text" name="placa" id="placa"><td><span> Chassi:</span></td><td><input type="text" name="chassi" id="chassi" class="uppercase"></td></td></tr>
                             	<tr><td><span>Marca:</span></td><td><input type="text" name="marca" id="marca"> <td><span> Modelo:</span></td><td><input type="text" name="modelo" id="modelo"></td></td></tr>            
                             	<tr><td><span>Cor:</span></td><td><input type="text" name="cor" id="cor"><td><span> Ano:</span></td><td><input type="date" name="ano" id="ano"></td></td></tr>
                             	<tr><td><span>Combustível:</span></td><td>	<select name="combustivel" id="combustivel">
                             												<option value="gasolina">Gasolina</option>
                             												<option value="flex">Flex</option>
                             												<option value="alcool">Álcool</option>
                             												</select>
                              	</td></tr>	
                             	<tr><td><span>Seguro:</span></td><td><input class="seguro" type="checkbox"  name="seguro" value="1"></td></tr>                             	
                             	<tr><td><span>Quilometragem Inicial:</span></td><td><input type="numeric" name="km_inicial" id="km_inicial"></td></tr>
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
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_veiculo.php'" id="button" value="Cancelar"></td></tr>
                       </form>
            <?php }?> 
	 	    
	 	     <?php 

                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar_veiculo"){
                		// echo '<script>alert("'.formataMoney($_POST['valor_compra']).'")</script>';
                    if(validate()){
                    		
						            $matricula = $_POST['matricula'];
						            $chassi = $_POST['chassi'];
						            $placa = $_POST['placa'];
						            $marca = $_POST['marca'];
						            $modelo = $_POST['modelo'];
						            $ano = $_POST['ano'];
						            $cor = $_POST['cor'];
						            $seguro = $_POST['seguro'];
						            $quilometragem = 0;
						            $km_inicial = $_POST['km_inicial'];
						            $tipo_combustivel = $_POST['combustivel'];							
						            $id_empresa = $_POST['empresa'];
						            $id_fornecedor = $_POST['fornecedor'];
						            $id_responsavel = $_POST['responsavel'];
                        $renavam - $_POST['renavam'];
						
                      $veiculo = new Veiculo();
                      $veiculo->add_veiculo($matricula, $chassi, $renavam, $placa, $marca, $modelo, $ano, $cor, $seguro, $quilometragem, $km_inicial, $tipo_combustivel, $id_empresa, $id_fornecedor, $id_responsavel);
    
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