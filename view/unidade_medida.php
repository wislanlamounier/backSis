<div style="float:left; width: 100%; margin-top:20px; padding-top: 5px; padding-bottom: 5px; text-align: center; background:url(../images/footer_lodyas.png); " ><span style="color: #ddd;" class="title">UNIDADE DE MEDIDA</span> <input type="button" style="background-color: rgba(000,000,000,0.1); border:0; float:right; color:#cc0000" value="Configurar" onclick="hideall('opcoes-unidade-medida')" ></div> <!-- HIDEALL PARA MOSTRAR OPÇÕES ACAO ESTA EM CONFIGURACOES -->
   <div id="opcoes-unidade" style="float:left; width: 100%;">
       <div class="opcoes-unidade-medida" id="opcoes-unidade-medida" hidden="on">
           <div class="nova_unidade"><input class="button" type="button" id="nova_unidade" name="1" value="Nova" onclick="mostraTabela1(this.name)"> </div>
           <div class="editar_unidade"><input class="button" type="button" id="editar_unidade" name="2" value="Editar" onclick="mostraTabela2(this.name)"></div>
       </div>
    </div>

       <div id="1" hidden="on">
           <form method="POST" action="configuracoes.php" onsubmit="return valida(this)">
               <input type="hidden" value="cadastrar" name="cadastrar" id="cadastrar">
               <div class="atributos-novo"><span><b>Nome: </b></span><input style="background-color:#ddd; margin-bottom: 5px; box-shadow: 2px 2px 3px #666;" type="text" name="nome" id="nome"></div>
               <div class="atributos-novo"><span><b>Grandeza: </b></span><input style="background-color:#ddd; margin-bottom: 5px; box-shadow: 2px 2px 3px #666;" type="text" name="grandeza" id="grandeza"></div>
               <div class="atributos-novo"><span><b>Sigla: </b></span><input style="background-color:#ddd; width: 50px; box-shadow: 2px 2px 3px #666;" type="text" name="sigla" id="sigla" style="width:45px;"></div>
               <div style="margin-top:20px; margin-left: 25%; float:left;"><input type="submit" class="button" value="Salvar"><input type="button" class="button" value="Cancelar"> </div>
           </form>
            <?php 
            if(isset($_POST['cadastrar']) && $_POST['cadastrar'] == "cadastrar" ){
            if(validade()){
            $unidade_medida = new Unidade_medida();
            $nome = $_POST['nome'];
            $grandeza = $_POST['grandeza'];
            $sigla = $_POST['sigla'];
            $unidade_medida->add_unidade_medida($nome,$grandeza,$sigla);
            if($unidade_medida){
                if($unidade_medida->add_unidade_medida_bd()){
                echo "<script>alert('Unidade adicionada com sucesso !!')</script>";
                
                }
            }
          }
       }
       ?>
       </div>
   
        <div id="2" hidden="on">
           <form method="POST" action="configuracoes.php">
               <input type="hidden" value="editar" name="editar" id="editar" >
               <div class="atributos-novo" ><span><b>Nome: </b></span><input style="background-color:#ddd; padding-top: 6px;  box-shadow: 2px 2px 3px #666;" type="text" name="nome_e" id="nome_e"><input  style="margin-left: 10px;"type="button" class="button" value="Buscar" onclick="busca()"></div>
               
           </form>
            
             <?php if(isset($_POST['editar']) && $_POST['editar'] != "" ){
                            
                            echo '<script>mostraTabela1("opcoes-unidade-medida")</script>';
                            $unidade_medida = new Unidade_medida();
                            $id =  $_POST['id'];  
                            $nome = $_POST['nome'];
                            $grandeza = $_POST['grandeza'];
                            $sigla = $_POST['sigla'];
                            
                            if($id != "" && $nome != "" && $grandeza != "" && $sigla != ""  ){
                            $unidade_medida->atualiza_unidade_medida($nome, $grandeza, $sigla, $id);
                            echo "<script>window.location='configuracoes.php?nome=".$_GET['nome']."'</scrpit>";
                            }                        
            }?>
            
              <?php if(isset($_POST['excluir']) && $_POST['excluir'] != ""  ){
                            echo '<script>alert("chamou")</script>';
                            echo '<script>mostraTabela1("opcoes-unidade-medida")</script>';
                            $unidade_medida = new Unidade_medida();
                            echo $id =  $_POST['id'];  
                           
                            if($id != "" && $nome != "" && $grandeza != "" && $sigla != ""  ){
                            $unidade_medida->ocultar_unidade_medida($id);
                            echo "<script>window.location='configuracoes.php?nome=".$_GET['nome']."'</scrpit>";
                            }                        
            }?>
            
             <?php 
             
                if(isset($_GET['nome'])){
                    echo '<script>mostraTabela1("opcoes-unidade-medida")</script>';
                    echo '<script>mostraTabela1(2)</script>';
                    $aux = 1;  
                    $nome =  $_GET['nome'];
                    $unidade_medida = new Unidade_medida();
                    if($nome == "undefined"){
                        $result = $unidade_medida->get_all_unidade_medida();
                    }else{
                        $result = $unidade_medida->get_unidade_medida_by_nome($nome);
                    }
                ?>
                    <div style="float:left; clear:left;">
                        
                    <?php 
                    
                    
                    if(isset($result)){
                       
                    echo "<div class='box-titulo'><span class='titulo'>Nome</span> <span class='titulo' >Grandeza</span><span class='titulo'>Sigla</span></div>";
                    
                    foreach ($result as $key => $value) {
                      
                    $id = $value[0];
                    $nome = $value[1];
                    $sigla = $value[2];
                    $grandeza = $value[3];
                    ?>
                       <?php
//                        if($key > 5){
//                            echo "<script>oculta()</script>";
//                            echo "<input style='margin-top: 10px;' type='button' value'next' onclick'next'>";
//                            
//                            
//                        }
//                        ?>
                        <div id="resultados" style="margin-top:20px; padding-bottom:20px;">
                            <form method="POST" id="" >
                            <input type="hidden" id="editar" name="editar" value="editar" >    
                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>" >
                            <div id="tabelaunidades" class="tabela-unidades">
                            <input class="tabela-unidades-nome"     type="text" name="nome"                      value="<?php echo $nome ?>" id="<?php echo $nome ?>">
                            <input class="tabela-unidades-grandeza" type="text" name="grandeza"                 value="<?php echo $grandeza ?>" id="<?php echo $grandeza ?>">
                            <input class="tabela-unidades-sigla"    type="text" name="sigla"                  value="<?php echo $sigla ?>" id="<?php echo $sigla ?>">                         
                            <input class="button-tabela-unidade-deletar"  value=""  type="submit" onclick="confirma('<?php echo $id." ".$nome." ".$_GET['nome']; ?>')">
                            <input class="button-tabela-unidade-salvar"   value=""  type="submit" onclick="atualizar('<?php echo $id." ".$nome." ".$grandeza." ".$sigla; ?>')">
                            </form>
                           
                        </div>
                              
                       
                     
                    
                <?php }}}?>
           </div>
       </div>
