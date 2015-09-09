<!-- ADICIONANDO DADOS DA SESSÃO EM ARRAY   -->
<?php    
        if (isset($_SESSION['obra']['funcionario'])){
        $cliente = $_SESSION['obra']['funcionario'];       
        }else{
          $cliente['nome']="...";         
        }
?>
<!-- PAINEL DE CONTROLE DE FUNCIONARIOS -->
        <div class="painel-controle">
                <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/user_add.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px; width:35px"><span class="title">Funcionário</span></div></div>
                <div class="colum">
                  <div style="width:100%;"><span style="color: #676767;">Funcionários ligados a obra</span></div>
                  <div class="descricao" style="float:left" ><span  style="font-size:18px;">Nome </span></div>
                  <!-- eSTRUTURA DE REPETIÇÃO PARA ALIMENTAR OS NOMES E INFORMAÇÕES DO FUNCIONARIO -->
        <?php  
         for($aux = 0; $aux < count($cliente); $aux++){
            // print_r($cliente);

          $funcionario = new Funcionario();
          // echo "<br>". $cliente[$aux];
          $res = Funcionario::get_func_id($cliente[$aux]);          
          ?>          
                  <div class="colum-funcionario"><input style="font: 15px arial, sans-serif;" readonlytype="text" value="<?php  echo $res->nome; ?>"></div>
          <?php } ?> 


                </div>          
          </div>
        

