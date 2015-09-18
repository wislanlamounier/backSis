<?php
include("restrito.php"); 

include_once("../model/class_sql.php");
include("../model/class_empresa_bd.php");
include("../model/class_unidade_medida_bd.php");
include("../model/class_material_bd.php");

function validate(){
   if(!isset($_POST['nome']) || $_POST['nome'] == ""){
        return false;
   	}
   		   return true;    
     
    }
 ?>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="style.css">

</head>
<script type="text/javascript">

	function confirma(id,nome, tipopess){
       if(confirm("Excluir Material "+nome+" , tem certeza?") ){
          var url = '../ajax/ajax_excluir_material.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
          	
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
    }
</script>

<body>	
			<?php include_once("../view/topo.php"); ?>

			<div id="content">                                               
            <div class="formulario">
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){?>
            	<?php 
            		 $id = $_GET['id'];
                     $material = new Material();
                     $material = $material->get_material_id($id);
                     $id = $material->id;
                     $nome = $material->nome;
                     
            	 ?>

                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR GRUPO GRUPO</span></div></div>
                       <form method="POST" id="add_material" action="add_material.php" onsubmit="return validate(this)">
                            <input type="hidden" id="tipo" name="tipo" value="editar">
                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">                            
                            <table border="0">
                            	<tr><td><span>Nome:</span></td> <td><input type="text" name="material" id="material"  value="<?php echo $nome ?>"></td></tr>
                            <tr><td><span>Descricão:</span></td><td><input type="text" name="desc" id="desc" value="<?php echo $descricao ?>"></td></tr>
                           <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="editar"> <input type="button" name="button" class="button" onclick="window.location.href='add_material.php'" id="button" value="Cancelar"></td></tr>  
                            </table>                            
                       </form>              
            <?php }else{ ?>              
                       <form method="POST" class="add_material" id="add_material" name="add_material" action="add_material.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">MATERIAIS</span></div></div>
                        <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                          <table border="0">                          
                          		<tr><td><span>Nome:</span></td> <td><input type="text" name="nome" id="nome"></td><td><span>Unidade de medida:</span></td><td>
                                  <select id="medida" name="medida"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $medida = new Unidade_medida();
                                       $medida = $medida->get_all_unidade_medida();
                                       for ($i=0; $i < count($medida) ; $i++) { 
                                          echo '<option value="'.$medida[$i][0].'">'.$medida[$i][2].'</option>';
                                       }
                                     ?>
                                 </select><td></tr>
  
                              <tr><td><span>Empresa:</span></td><td>
                                  <select id="empresa" name="empresa"  style="width:100%">
                                    <option value="no_sel">Selecione</option>
                                    <?php 
                                       $empresa = new Empresa();
                                       $empresa = $empresa->get_all_empresa();
                                       for ($i=0; $i < count($empresa) ; $i++) { 
                                          echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                       }
                                     ?>
                                 </select><td></tr>
                          </table>
                          <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_material.php'" id="button" value="Cancelar"></td></tr>
                       </form>          
                       
            <?php }?>               
			
			<?php 
                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                   if(validate()){

                    if($_POST['medida']!= "no_sel" && $_POST['empresa']!="no_sel"){
                     $material = new Material();
                     $material->add_material($_POST['nome'], $_POST['medida'], $_POST['empresa']); 
                      
                     if($material->add_material_bd()){
                        echo '<div class="msg">Cadastrado com sucesso!</div>';
                     }else{
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     }

                  	}else{
                
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     } 
                     }                 
                }
                if(isset($_POST['tipo']) && $_POST['tipo'] == "editar"){
                	if(isset($_POST['id'])){

                            if(validate()){

                              $material = new Material();
                              if($material->atualiza_material($_POST['material'], $_POST['desc'], $_POST['id'] ) ){
                                 echo '<div class="msg">Atualizado com sucesso!</div>';
                                 echo '<script>alert("Material atualizado com sucesso")</script>';
                              }else{
                                 echo '<div class="msg">Falha na atualização!</div>';
                              }
                              
	                       }
	                   }                         
	           		}
	           	
		 		?>
	 	    </div> 
	 	   <!--  <?php include("informacoes_material.php") ?>  -->
	 		</div> 
</body>
</html>