<div style="float:left; width: 100%; margin-top:20px; padding-top: 5px; padding-bottom: 5px; text-align: center; background:url(../images/footer_lodyas.png); " ><span style="color: #ddd;" class="title">UNIDADE DE MEDIDA</span> <input type="button" style="background-color: rgba(000,000,000,0.1); border:0; float:right; color:#cc0000" value="Configurar" onclick="mostraTabela1('opcoes-unidade-medida')" ></div>
   <div id="opcoes-unidade" style="float:left; width: 100%;">
       <div class="opcoes-unidade-medida" id="opcoes-unidade-medida" hidden="on">
           <div class="nova_unidade"><input class="button" type="button" id="nova_unidade" name="1" value="Nova" onclick="mostraTabela1(this.name)"> </div>
           <div class="editar_unidade"><input class="button" type="button" id="editar_unidade" name="2" value="Editar" onclick="mostraTabela2(this.name)"></div>
       </div>
    </div>

       <div id="1" hidden="on">
           <form method="POST" action="configuracoes.php" onsubmit="return valida(this)">
               <input type="hidden" value="cadastrar" name="cadastrar" id="cadastrar">
               <div class="atributos-novo"><span><b>Nome: </b></span><input style="background-color:#ddd;" type="text" name="nome" id="nome"></div>
               <div class="atributos-novo"><span><b>Grandeza: </b></span><input style="background-color:#ddd;" type="text" name="grandeza" id="grandeza"></div>
               <div class="atributos-novo"><span><b>Sigla: </b></span><input style="background-color:#ddd; width: 50px;" type="text" name="sigla" id="sigla" style="width:45px;"></div>
               <div  style="margin-top:20px; margin-left: 25%; float:left;"><input type="submit" class="button" value="Salvar"><input type="button" class="button" value="Cancelar"> </div>
           </form>    
       </div>
   
        <div id="2" hidden="on">
           <form method="POST" action="configuracoes.php">
               <input type="hidden" value="editar" name="editar" id="editar" >
               <div class="atributos-novo"><span><b>Nome: </b></span><input style="background-color:#ddd;" type="text" name="nome" id="nome"></div>
               <div class="atributos-novo"><span><b>Grandeza: </b></span><input style="background-color:#ddd;" type="text" name="grandeza" id="grandeza"></div>
               <div class="atributos-novo"><span><b>Sigla: </b></span><input style="background-color:#ddd; width: 50px;" type="text" name="sigla" id="sigla" style="width:45px;"></div>
               <div  style="margin-top:20px; margin-left: 25%; float:left;"><input type="submit" class="button" value="Editar"><input type="button" class="button" value="Cancelar"> </div>
           </form>    
       </div>

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
                 echo "<div class='msg'>Unidade adicionada com sucesso !!</div>";   
                }
            }
          }
       }
       if(isset($_POST['editar']) && $_POST['editar'] == "editar" ){
           if(validade()){
        $nome = $_POST['nome'];
        $grandeza = $_POST['grandeza'];
        $sigla = $_POST['sigla'];
       }
       }
       ?>