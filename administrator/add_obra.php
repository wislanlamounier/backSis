<?php
include("restrito.php"); 

include_once("../model/class_sql.php");
include("../model/class_grupo_bd.php");

function validate(){
   if(!isset($_POST['desc']) || $_POST['desc'] == ""){
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
       if(confirm("Excluir Grupo "+nome+" , tem certeza?") ){
          var url = '../ajax/ajax_excluir_grupo.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
          
          $.get(url, function(dataReturn) {
          	
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
    }
</script>

<body>	
			<?php include_once("../view/topo.php"); ?>

			
            <div class="formulario" style="width:95%;">
            <?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){?>
            	<?php 
            		 $id = $_GET['id'];
                     $grupo = new Grupo();
                     $grupo = $grupo->get_grupo_id($id);
                     $id = $grupo->id;
                     $nome = $grupo->nome;
                     $descricao = $grupo->descricao;
            	 ?>

                <div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EDITAR GRUPO GRUPO</span></div></div>
                       <form method="POST" id="add_grupo" action="add_grupo.php" onsubmit="return validate(this)">
                            <input type="hidden" id="tipo" name="tipo" value="editar">
                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">                            
                            <table border="0">
                            	<tr><td><span>Nome:</span></td> <td><input type="text" name="grupo" id="grupo"  value="<?php echo $nome ?>"></td></tr>
                            <tr><td><span>Descricão:</span></td><td><input type="text" name="desc" id="desc" value="<?php echo $descricao ?>"></td></tr>
                           <tr><td colspan="3" style="text-align:center"><input type="submit" name="button" class="button" id="button" value="editar"> <input type="button" name="button" class="button" onclick="window.location.href='add_grupo.php'" id="button" value="Cancelar"></td></tr>  
                            </table>                            
                       </form>              
            <?php }else{ ?>              
                       <form method="POST" class="add_grupo" id="add_grupo" name="add_grupo" action="add_grupo.php" onsubmit="return validate(this)">
                        <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">NOVA OBRA</span></div></div>
                        <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                              <!-- <div class="situacao">
                                  
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                      <div class="situacao-box"><div>Dados da obra</div></div>
                                  
                              </div> -->
                              <div class="bloco-1" id="dados_obra">            
                                  <div class="ativo"><div class="ativo-text">Cadastre os dados da obra</div></div>
                              		<div class="title-bloco">Dados da obra</div>
                                  <div class="desc-bloco">
                                      <span>Preencha os principais dados da obra nesse bloco</span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input">
                                          <span>Nome:</span><input type="text" name="grupo" id="grupo" style="width:100%">
                                      </div>
                                      <div class="form-input">
                                     	    <span>Descricão:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <span>Data inicio:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <input type="button" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                              <div class="bloco-1" id="produtos_obra">
                                  <div class="inativo"><div class="ativo-text">Aguardando...</div></div>         
                                  <div class="title-bloco">Produtos da obra</div>
                                  <div class="desc-bloco">
                                      <span>Preencha os principais dados da obra nesse bloco</span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input">
                                          <span>Nome:</span><input type="text" name="grupo" id="grupo" style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <span>Descricão:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <span>Data inicio:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <input type="button" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                              <div class="bloco-1" id="patrimonios_obra">
                                  <div class="inativo"><div class="ativo-text">Aguardando...</div></div>            
                                  <div class="title-bloco">Patrimonios da obra</div>
                                  <div class="desc-bloco">
                                      <span>Preencha os principais dados da obra nesse bloco</span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input">
                                          <span>Nome:</span><input type="text" name="grupo" id="grupo" style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <span>Descricão:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <span>Data inicio:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <input type="button" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                              <div class="bloco-1" id="funcionarios_obra">
                                  <div class="inativo"><div class="ativo-text">Aguardando...</div></div>           
                                  <div class="title-bloco">Funcionários da obra</div>
                                  <div class="desc-bloco">
                                      <span>Preencha os principais dados da obra nesse bloco</span>
                                  </div>
                                  <div class="body-bloco">
                                      <div class="form-input">
                                          <span>Nome:</span><input type="text" name="grupo" id="grupo" style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <span>Descricão:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <span>Data inicio:</span><input type="text" name="desc" id="desc"  style="width:100%">
                                      </div>
                                      <div class="form-input">
                                          <input type="button" value="Avançar">
                                      </div>
                                  </div>
                              </div>
                              <div class="buttons" style="">
                                  <input type="submit" name="button" class="button" id="button" value="cadastrar"> <input type="button" name="button" class="button" onclick="window.location.href='add_grupo.php'" id="button" value="Cancelar">
                              </div>
                       </form>          
                       
            <?php }?>               
			
			<?php 
                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                   if(validate()){
                     $grupo = new Grupo();
                     $grupo->add_grupo($_POST['grupo'], $_POST['desc']);                    
                     if($grupo->add_grupo_bd()){
                        echo '<div class="msg">Cadastrado com sucesso!</div>';
                     }else{
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     }

                  	}else{
                
                        echo '<div class="msg">Erro ao cadastrar!</div>';
                     }                  
                }
                if(isset($_POST['tipo']) && $_POST['tipo'] == "editar"){
                	if(isset($_POST['id'])){

                            if(validate()){

                              $grupo = new Grupo();
                              if($grupo->atualiza_grupo($_POST['grupo'], $_POST['desc'], $_POST['id'] ) ){
                                 echo '<div class="msg">Atualizado com sucesso!</div>';
                              }else{
                                 echo '<div class="msg">Falha na atualização!</div>';
                              }
                              
	                       }
	                   }                         
	           		}
	           	
		 		?>
	 	    </div> 
	 	    <?php //include("informacoes_grupo.php") ?> 
	 		
</body>
</html>