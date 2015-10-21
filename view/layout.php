<script>
    function info(id){
      
      var divPop = document.getElementById(id);
      divPop.style.display = "";
    }
    function fechar(id){
      var divPop = document.getElementById(id);
      divPop.style.display = "none";
    }
</script>
<?php 
        if(isset($_POST['aux']) && $_POST['aux'] == 'atualizar'){
             $config = new Config();
             $config->atualizaConfig('exibe_box_atrasos', $_POST['exibe_box_atrasos']);
             $config->atualizaConfig('exibe_box_sem_registros', $_POST['exibe_box_sem_registros']);
             echo "<script>alert('Configurações atualizadas com sucesso!');</script>";
             
          }
       ?>
<div style="float:left; width: 100%; margin-top:20px; padding-top: 5px; padding-bottom: 5px; text-align: center; background:url(../images/footer_lodyas.png); " ><span style="color: #ddd;" class="title">LAYOUT</span><input type="button" style="background-color: rgba(000,000,000,0.1); border:0; float:right; color:#cc0000" value="Configurar" onclick="mostraTabela1('style')" ></div>
<div id="style" hidden="on" style="float:left; width:100%">
      <form method="POST" action="configuracoes.php">
          <input name="aux" type="hidden" value="atualizar">
          <table border="0" style="width:100%">
              <tr>
                <td colspan="3"><span><b>Tela inicial </b></span></td>
              </tr>
              <tr>
                <td ><span><b>Box Atrasos: </b></span></td>
                <td style="padding: 0">
                  <select style="width:100%" name="exibe_box_atrasos">
                    <option value="1">Exibir</option>
                    <option value="0" <?php (Config::get_config("exibe_box_atrasos")) == 0 ? print "selected" : print "" ?> >Ocultar</option>
                  </select>
                </td>
                <td style="width:150px;"><div class="box_atrasos_ico" id="box_atrasos_ico" ><img onmouseover="info('pop1')" onmouseout="fechar('pop1')" width='15px' src="../images/info-icon.png"></div>
                <!-- <td> -->
                    <div id="pop1" class="pop" style="display:none">
                        <div id="titulo1" class="title-info-config"><span>Informações</span></div>
                        <div id="content1" class="content-info">Exibe um bloco com dados dos funcionários que registraram o ponto com atraso.</div>   
                    </div>
                <!-- </td><td><span style="color:#565656"> (Máximo permitido: 59 minutos)</span></td> -->
                </td>
              </tr>
              <tr>
                <td><span><b>Box Sem Registros: </b></span></td>
                <td style="padding: 0">
                    <select style="width:100%" name="exibe_box_sem_registros">
                         <option value="1">Exibir</option>
                         <option value="0" <?php (Config::get_config("exibe_box_sem_registros")) == 0 ? print "selected" : print "" ?> >Ocultar</option>
                    </select>
                </td>
                <td ><div ><img onmouseover="info('pop2')" onmouseout="fechar('pop2')" width='15px' src="../images/info-icon.png"></div>
                
                      <div id="pop2" class="pop" style="display:none">
                        <div id="titulo2" class="title-info-config"><span>Informações</span></div>
                        <div id="content2" class="content-info">Exibe um bloco com dados dos funcionários que esqueceram e não registraram o ponto.</div>   
                    </div>
                </td><!-- <td><span style="color:#565656"> (Máximo permitido: 59 minutos)</span></td> -->
              </tr>
              <tr>
                <td colspan="3" style="padding-top:20px; text-align:center"><input type="submit" class="button" value="Salvar"> <input type="button" class="button" value="Cancelar"></td>
              </tr>
          
          </table>
          
      </form>
      <div>
      
      </div>
</div>