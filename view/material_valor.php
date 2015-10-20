        <div style="float:left; width: 100%; margin-top:20px; padding-top: 5px; padding-bottom: 5px; text-align: center; background:url(../images/footer_lodyas.png); " ><span style="color: #ddd;" class="title">VALORES MATERIAIS X REGIÃO</span> <input type="button" style="background-color: rgba(000,000,000,0.1); border:0; float:right; color:#cc0000" value="Configurar" onclick="hideall('opcoes-materiais')" ></div> <!-- HIDEALL PARA MOSTRAR OPÇÕES ACAO ESTA EM CONFIGURACOES -->
        
        <div id="opcoes" style="float:left; width: 100%;">
            <div class="opcoes-materiais" id="opcoes-materiais" hidden="on">
                <div class="materiais"><span>Cadastrar por...</span>
                    <select id="add_valor" name="3" value="Adicionar valor" onchange="mostraTabela1(this.name)">
                        <option value="1">Selecione</option>
                        <option value="2">Cidade</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="materiais" id="3" hidden="on"> 
            <div><span >UF:</span></div> 
            <form method="GET" action="../administrator/add_material.php">
                <?php
                //buscar array de CBO
                $estado = new Estado();
                $estados = $estado->get_name_all_uf();
                ?>

                <select style="width: 10%; margin-left: 30px;" id="axestado" name="axestado"  onchange="buscar_cidades(this.id)">
                    <option value="no_sel">UF</option>
                    <?php
                    foreach ($estados as $key => $estado) {
                        echo '<option value="' . $estados[$key][0] . '">' . $estados[$key][1] . '</option>';
                    }
                    ?>
                </select>
                <div id="aload_cidades">
                    <select style="width: 20%; margin-left: 20px" name="cidade" id="cidade" >
                        <option style="width: 20%" value="no_sel">Selecione um estado</option>
                    </select>                                        
                </div>
                <input style="float:right; width: 80px; margin-right: 50px "type="submit">
            </form>
        </div>

        <?php
        if (isset($_GET['axestado']) && isset($_GET['cidade']) )  {

            $Carrestado = $_GET['axestado'];
            $Carrcidade = $_GET['cidade'];
           
            ?>
            <div id="4" >          
                <div id="menu-materiais" name="menu-materiais" class="menu-materiais">
                    <span style="margin-left: 8px;"><b>Nome</span>
                    <span>Unidade</span>
                    <span>Estado</span>
                    <span>Cidade</span>
                    <span>Valor</span>

                </div>
                <form method="POST" id="materiais" action="../administrator/salva_materiais_valor.php">  
                    <div class="master-materiais">   

                        <?php
                        $custo_regiao = new Custo_regiao();
                        $t_c = new Tipo_custo();
                        $estado = new Estado();
                        $unidade_medida = new Unidade_medida();
                        $cidade = new Cidade();
                        $material = new Material();
                        $v_c = new Valor_custo();
                        $material = $material->get_all_material();  
                        $cidade = $cidade->get_city_by_id($Carrcidade);
                        $estados = $estado->get_estado_by_id($Carrestado); 
                        $t_c = $t_c->get_all_tipo_custo();
                        
                        

                        foreach ($material as $key => $value) {
                            $u_m = new Unidade_medida(); //u_m UNIDADE DE MEDIDA
                            $u_m = $u_m->get_unidade_medida_by_id($value[2]);
                            $id_material = $material[$key][0];

                            ?>

                            <div class="adicionando-valores" style="margin-top: 10px;" >       

                                <div class="materiais">

                                    <input readonly style="width: 20%" type="text" name="<?php echo $id_material.":material" ?>" id="<?php echo $id_material.":material" ?>" value="<?php echo $value[1]; ?>"> 
                                    <input readonly style="width: 10%; margin-left:5px" type="text" name="<?php echo $id_material.":medida" ?>" id="<?php echo $u_m->id.":medida" ?>" value="<?php echo $u_m->sigla ?>"> 
                                    <input readonly style="width: 10%; margin-left:5px" type="text" name="<?php echo $id_material.":estado" ?>" id="<?php echo $estado->id.":estado" ?>" value="<?php echo $estado->uf ?>"> 
                                    <input readonly type="text" style="width: 25%; margin-left: 5px;" name="<?php echo $id_material.":cidade:".$cidade->id; ?>" id="<?php echo $cidade->id.":cidade" ?>"  value="<?php echo $cidade->nome ?>">
                                    <?php
                                     
                                         $valor_custo = $custo_regiao->get_valor_regiao($id_material, $cidade->id, $_SESSION['id_empresa']); 
                                         
                                         if($valor_custo[0][0]){
                                             $v_c = $v_c->get_valor_custo_id($valor_custo[0][0]);                                               
                                            }
                                            
                                     ?>
                                    <input style="width: 15%; margin-left: 5px; text-align: left;" type="text" id="<?php echo $id_material.":valor_custo" ?>" name="<?php echo $id_material.":valor_custo" ?>" onkeyup="mascara(this, mvalor);" value="<?php if($v_c->valor!= ""){ echo 'R$' . number_format($v_c->valor, 2, ',', '.');}?>"> 
                                   
                                    <select style="width: 12%; margin-left: 5px;" name="<?php echo $id_material.":tipo_custo" ?>" id="<?php echo $id_material.":tipo_custo" ?>">
                                        <?php                                        
                                            foreach ($t_c as $key => $value) {
                                               
                                               echo '<option value="' . $value[0] . '">' . $value[1] . '</option>';
                                            }
                                        ?>
                                    </select>

                                </div>        
                            </div>

                            <?php
                            $v_c->valor = "";
                        }
                        ?>

                    </div> 
                    <div class="salvar-editar"> 
                       
                    <input type="submit" value="" class="button-tabela-material-salvar"> 
                       
                    </div>
                </form>
            </div>

        <?php }
        if(!isset($_GET['axestado']) || $_GET['axestado'] == "no_sel" ){
            
            echo '<script>ocultaTabela(4)</script>';
        }
        ?>      

