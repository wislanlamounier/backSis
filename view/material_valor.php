<div style="float:left; width: 100%; margin-top:20px; padding-top: 5px; padding-bottom: 5px; text-align: center; background:url(../images/footer_lodyas.png); " ><span style="color: #ddd;" class="title">VALORES MATERIAIS X REGIÃO</span> <input type="button" style="background-color: rgba(000,000,000,0.1); border:0; float:right; color:#cc0000" value="Configurar" onclick="hideall('opcoes-materiais')" ></div> <!-- HIDEALL PARA MOSTRAR OPÇÕES ACAO ESTA EM CONFIGURACOES -->
   <div id="opcoes" style="float:left; width: 100%;">
       <div class="opcoes-materiais" id="opcoes-materiais" hidden="on">
            <div class="add-valor-material"><span>Cadastrar por...</span>
                            <select id="add_valor" name="3" value="Adicionar valor" onchange="mostraTabela1(this.name)">
                                <option value="1">Cidades</option>
                                <option value="2">Por item</option>
                            </select>
            </div>
       </div>
    </div>
<div id="3" hidden="on"> 
                <div><span >UF:</span></div> 
                <form method="GET" action="../administrator/configuracoes.php">
                                   <?php //buscar array de CBO
                                      $estado = new Estado();
                                      $estados = $estado->get_name_all_uf();
                                      
                                   ?>
                                                                  
                                   <select style="width: 10%; margin-left: 30px;" id="a:estado" name="a:estado"  onchange="buscar_cidades(this.id)">
                                      <option value="no_sel">UF</option>
                                      <?php 
                                         foreach($estados as $key => $estado){
                                            echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                         } 
                                      ?>
                                   </select>
                                    <div id="aload_cidades">
                                        <select style="width: 20%; margin-left: 20px" name="cidade" id="cidade">
                                          <option style="width: 20%" value="no_sel">Selecione um estado</option>
                                        </select>                                        
                                    </div>
                    <input type="submit" >
                </form>
                </div>
<?php echo $_GET['estado']; ?>
          
   <div id="4">          
    <div id="menu-materiais" name="menu-materiais" class="menu-materiais">
        <span style="margin-left: 8px;"><b>Nome</span>
        <span>Unidade</span>
        <span>Estado</span>
        <span>Cidade</span>
        <span>Valor</b></span>
    </div>
        
    <div class="master-materiais">      
           <?php
               $material = new Material();
               $material = $material->get_all_material();
               $unidade_medida = new Unidade_medida();
               
                foreach ($material as $key => $value) {
                        $u_m = new Unidade_medida(); //u_m UNIDADE DE MEDIDA
                        $u_m = $u_m->get_unidade_medida_by_id($value[2]);
                        $id_material = $material[$key][0];
                        ?>
                                       
    <div class="adicionando-valores" style="margin-top: 10px;" >       
                <form method="POST" id="materiais" action="testevalores.php">
                           <div class="materiais">
                               <input style="width: 20%" type="text" name="<?php echo $id_material.":"."material"?>" id="<?php echo $id_material.":"."material"?>" value="<?php echo $value[1];?>"> 
                                
                                <select style="width: 10%; margin-left: 2px" name="<?php echo $id_material.":"."medida"?>" id="<?php echo $id_material.":"."medida"?>">
                                        <option value="no_sel">Selecione</option>
                                        <?php 
                                           $medida = new Unidade_medida();
                                           $medida = $medida->get_all_unidade_medida();
                                           for ($i=0; $i < count($medida) ; $i++) { 
                                              echo '<option value="'.$medida[$i][0].'">'.$medida[$i][2].'</option>';
                                           }
                                         ?>
                                           <?php echo "<script> carregaU_M('".$u_m->id.":"."$id_material"."'); </script>" ?> 
                                        </select>
                           
                            
                               
                                                          
                                   <?php //buscar array de CBO
                                      $estado = new Estado();
                                      $estados = $estado->get_name_all_uf();
                                      
                                   ?>
                                                                  
                                   <select style="width: 10%; margin-left: 30px;" name="<?php echo $id_material.":"."estado" ?>" id="<?php echo $id_material.":"."estado" ?>" onchange="buscar_cidades(this.id)">
                                      <option value="no_sel">UF</option>
                                      <?php 
                                         foreach($estados as $key => $estado){
                                            echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                         } 
                                         echo "<script> carregaUf('".$estado."') </script>"; 
                                      ?>
                                   </select>
                                    <div id="<?php echo $id_material."load_cidades"; ?>">
                                        <select style="width: 20%; margin-left: 20px" name="cidade" id="cidade">
                                          <option style="width: 20%" value="no_sel">Selecione um estado</option>
                                        </select>
                                        <?php echo "<script> buscar_cid('".$cidade."'); </script>";  ?>
                                    </div>
                                
                               <input style="width: 20%; margin-left: 10px;"type="text" id="valor_custo" name="valor_custo"> 
                               <div class="salvar-editar"> <input style="width: 5%; float: right;" type="submit" value="" class="button-tabela-material-salvar"> </div>
                              </div>
                </form>
        
    </div>
           
                        <?php
                        
                  }
           ?>
        </div>   
</div>        
         