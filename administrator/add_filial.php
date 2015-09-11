<?php
include("restrito.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_horarios_bd.php");
include_once("../model/class_turno_bd.php");
include_once("../model/class_sql.php");
include_once("../model/class_filial_bd.php");
include_once("../model/class_cbo_bd.php");
include_once("../model/class_cidade_bd.php");
include_once("../model/class_estado_bd.php");
include_once("../model/class_endereco_bd.php");
include_once("../model/class_exame_bd.php");
include_once("../model/class_cboXexames.php");
include_once("../model/class_rend_double_select.php"); 

function validate(){
   if(!isset($_POST['cod_posto']) || $_POST['cod_posto'] == ""){
         return false;
   }
   return true;
}

 ?>

<script type="text/javascript">

    function confirma(id,nome){
       if(confirm("Excluir Filial "+nome+" , tem certeza?")){
          var url = '../ajax/ajax_excluir_filial.php?id='+id+'&nome='+nome;  //caminho do arquivo php que irá buscar as cidades no BD
          $.get(url, function(dataReturn) {
            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
          });
       }
    }

   function validate(f){
    var erros=0;
      for(i=0; i < f.length; i++){
     
        if(f[i].name == "cod_posto"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "nome"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "telefone"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "rua"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "num"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "bairro"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "estado"){
            if(f[i].value == "no_sel"){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "cidade"){
            if(f[i].value == "no_sel"){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "cep"){
            if(f[i].value == ""){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "empresa"){
            if(f[i].value == "no_sel"){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }
        if(f[i].name == "responsavel"){
            if(f[i].value == "no_sel"){
               f[i].style.border = "1px solid #f00";
               erros++;
            }else{
              f[i].style.border = "1px solid #898989";
            }
        }

      }
      if(erros > 0 ){
        return false;
      }else{
        return true; 
      }
      
   }

   // mascaras
      function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
      }
      function execmascara(){
          v_obj.value=v_fun(v_obj.value)
      }

       function mtel(v){
           if(v.length >=15){                                          // alert("mtel")
             v = v.substring(0,(v.length - 1));
             return v;
           }
           v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
           v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
           v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
           
           return v;
       }
        function mcpf(v){
           if(v.length >=15){  
             v = v.substring(0,(v.length - 1));
             return v;
           }
           v=v.replace(/\D/g,""); 
           v=v.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/,"$1.$2.$3-$4");
           return v;
        }
        function mcnpj(v){
           if(v.length >=19){                                          // alert("mtel")
             v = v.substring(0,(v.length - 1));
             return v;
           }
           v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
           v=v.replace(/^(\d{2})(\d{3})/g,"$1.$2."); 
           v=v.replace(/(\d{3})(\d{4})/,"$1/$2"); 
           v=v.replace(/(\d)(\d{2})$/,"$1-$2"); 
           
           return v;
       }
       function mnum(v){
          if(v.length >=19){                                          // alert("mtel")
             v = v.substring(0,(v.length - 1));
             return v;
          }
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          return v;
       }
        
       function id( el ){
         // alert("id")
         return document.getElementById( el );
       }
       function mcep(v){
          if(v.length >= 10){
            v=v.substring(0,(v.length - 1));
            return v;
          }
          v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
          v=v.replace(/^(\d{5})(\d{3})$/,"$1-$2");

          return v;
       }
       window.onload = function(){
          
          id('telefone').onkeypress = function(){
              mascara( this, mtel );
          }
          // id('cnpj').onkeypress = function(){
          //     mascara( this, mcnpj );
          // }
          id('num').onkeypress = function(){
              mascara( this, mnum );
          }
          id('cep').onkeypress = function(){
            mascara( this, mcep );
          }
       }
      //fim mascaras
   function selectAll(){
      var select = document.getElementById("selecionados");
      for(i=0; i<select.length; i++){
         select[i].selected = true;
      }
   }
       function carregaCidade(){
          var combo = document.getElementById("cidade");
          var cidade = document.getElementById("id_cidade").value;

          for (var i = 0; i < 1000; i++)
          {
            if (combo.options[i].value == cidade)
            {
              combo.options[i].selected = true;
              break;
            }
          }
        
      }
      function buscar_cid(id_est){
      var estado = id_est;  //codigo do estado escolhido
      //se encontrou o estado
      if(estado){
        var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function(dataReturn) {
          $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
        });
      }
    }
   function carregaEmpresa(id_emp){
          var combo = document.getElementById("empresa");
          for (var i = 0; i < combo.options.length; i++)
          {
            if (combo.options[i].value == id_emp)
            {
              combo.options[i].selected = true;
              
              break;
            }
          }
      }
      
   
    function buscar_cid(id_est){
      var estado = id_est;  //codigo do estado escolhido
      //se encontrou o estado
      if(estado){
        var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
        $.get(url, function(dataReturn) {
          $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
        });
      }
    }
   
      function buscar_cidades(){         
          var estado = document.getElementById("estado").value;  //codigo do estado escolhido

          //se encontrou o estado
          if(estado){

            var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD

            $.get(url, function(dataReturn) {
              $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
            });
          }
        }
          function disparaLoadCidade(){
      setTimeout(function() {
         carregaCidade();
        }, 500);
      }
    
    function carregaUF(uf){
        var combo = document.getElementById("estado");

        for(i = 0; i < combo.options.length ;  i++){
            if(combo.options[i].value == uf){ 
              combo.options[i].selected = true;
              break;
            }
        }
        buscar_cidades();
      }
      function carregaUf(uf){
        var combo = document.getElementById("estado");

        for(i = 0; i < combo.options.length ;  i++){
            if(combo.options[i].value == uf){ 
              combo.options[i].selected = true;
              break;
            }
        }
        buscar_cidades();
      }
       function carregaResponsavel(id_resp){
        var combo = document.getElementById("responsavel");
        for (var i = 0; i < combo.options.length; i++)
        {
          if (combo.options[i].value == id_resp)
          {
            combo.options[i].selected = true;
            
            break;
          }
        }
      }
</script>

<head>
	
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="style.css">
   
</head>

<body onload="disparaLoadCidade()">	
<?php include_once("../view/topo.php"); ?>		
	<div class="formulario">
			

			<?php if(isset($_GET['tipo']) && $_GET['tipo'] == 'editar'){ ?>
				      <?php 
                        $id = $_GET['id'];
                        $filial = new Filial();
                        $filial = $filial->get_filial_id($id);
                        $endereco = new Endereco();
                        $endereco = $endereco->get_endereco($filial->id_endereco);
                        
                         echo '<input type="hidden" id="id_cidade" value="'.$endereco[0][2].'">';
                      ?>
			
				<div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Adicionar Posto de trabalho</span></div></div>
				<form method="POST" id="add_cbo" action="add_filial.php" onsubmit="return validate(this)">
                  <table border="0" style="width:100%">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" id="id_endereco" name="id_endereco" value="<?php echo $filial->id_endereco; ?>">
                    <input type="hidden" id="tipo" name="tipo" value="editar">
                 
                     <!-- <tr> <td ><span>CNPJ:</span></td> <td colspan="2"><input type="text" id="cnpj" name="cnpj" style="width:100%"></td></tr> <!- cnpj --> 
                     <tr> <td ><span>Código Posto:</span></td> <td colspan="2"><input type="text" id="cod_posto" name="cod_posto" style="width:100%; text-transform:uppercase;" value="<?php echo $filial->cod_posto; ?>"></td></tr> <!-- cod_posto -->
                     <tr> <td ><span>Nome:</span></td> <td colspan="2"><input type="text" id="nome" name="nome" style="width:100%"value="<?php echo $filial->nome; ?>"></td></tr> <!-- nome -->
                     <tr> <td ><span>Telefone:</span></td > <td colspan="2"><input type="text" id="telefone" name="telefone" style="width:100%" value="<?php echo $filial->telefone; ?>"></td></tr> <!-- nome -->
                     <tr> <td ><span>Rua:</span></td> <td><input value="<?php echo $endereco[0][0]; ?>" type="text" id="rua" name="rua"><span> Nº: </span></td> <td><input value="<?php echo $endereco[0][1]; ?>" style="width:60px" type="text" id="num" name="num"></td></tr> <!-- rua -->
                     <tr> <td ><span>Bairro:</span></td> <td colspan="2"><input value="<?php echo $endereco[0][4]; ?>" type="text" id="bairro" name="bairro" style="width:100%"></td></tr> <!-- bairro -->
                     <tr> 
                        <tr>
                        <td><span>Estado:</span></td>
                        <td>
                           <?php //buscar array de CBO
                              $estado = new Estado();
                              $estados = $estado->get_name_all_uf();
                                
                           ?>
                           <select name="estado" id="estado" onchange="buscar_cidades()">
                              <option value="0">Selecione um estado</option>
                              <?php 
                                 foreach($estados as $key => $estado){
                                    echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                 }
                              ?>
                           </select>                           <!-- <a href="">Pesquisar</a> -->
                        </td>
                        <?php echo "<script> carregaUf('".$endereco[0][3]."') </script>";  ?>
                     </tr>
                     <tr>
                        <td><span>Cidades:</span></td>
                        <td colspan="3">
                           <div id="load_cidades">
                             <select name="cidade" id="cidade">
                               <option value="0">Selecione um estado</option>
                             </select>
                           </div>
                        </td>
                        <?php echo "<script> buscar_cid('".$endereco[0][3]."'); </script>";  ?>
                      </tr>

                     <tr> <td ><span>CEP:</span></td> <td colspan="2"><input type="text" id="cep" name="cep" value="<?php echo $endereco[0][5]; ?>" style="width:100%"></td></tr> <!-- cep -->                     
                     <tr> 
                        <td ><span>Empresa:</span></td>
                        <td colspan="2">
                           <select id="empresa" name="empresa"  style="width:100%">
                              <option value="no_sel">Selecione uma Empresa</option>
                              <?php 
                                 $empresa = new Empresa();
                                 $empresa = $empresa->get_all_empresa();
                                 for ($i=0; $i < count($empresa) ; $i++) { 
                                    echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                 }
                               ?>
                           </select>
                        </td>
                        <?php echo '<script> carregaEmpresa("'.$filial->id_empresa.'"); </script>'; ?>
                     </tr>
                     
                     <tr> 
                        <td ><span>Responsável:</span></td>
                        <td colspan="2">
                           <select id="responsavel" name="responsavel"  style="width:100%">
                              <option value="no_sel">Selecione o Responsável</option>
                              <?php 
                                 $func = new Funcionario();
                                 $func = $func->get_admin();
                                 for ($i=0; $i < count($func) ; $i++) { 
                                    echo '<option value="'.$func[$i][0].'">'.$func[$i][1].'</option>';
                                 }
                               ?>
                           </select>
                        </td>
                        <?php echo '<script> carregaResponsavel("'.$filial->id_responsavel.'"); </script>'; ?>
                     </tr>
                     
                     <!-- <tr><td colspan="2"><span style="color:#898989">Segure Ctrl para múltiplas seleções</span></td></tr>   -->
                     <tr>
                          <td colspan="3" style="text-align:center">
                              <input class="button" type="submit" onclick="selectAll()" name="button" id="button" value="Editar">
                              <input class="button" name="button" onclick="window.location.href='add_filial.php'" id="button" value="Cancelar">
                          </td>
                      </tr>
                  </table>
               </form>
               <?php }else{ ?>
               		<div class="title-box" style="float:left"><div style="float:left"><img src="../images/edit-icon.png" width="35px"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">Adicionar Posto de trabalho</span></div></div>
				<form method="POST" id="add_cbo" action="add_filial.php" onsubmit="return validate(this)">
                  <table border="0" style="width:100%" >
                     <input type="hidden" id="tipo" name="tipo" value="cadastrar">
                     <!-- <tr> <td ><span>CNPJ:</span></td> <td colspan="2"><input type="text" id="cnpj" name="cnpj" style="width:100%"></td></tr> <!- cnpj --> 
                     <tr> <td ><span>Código Posto:</span></td> <td colspan="2"><input type="text" id="cod_posto" name="cod_posto" style="width:100%; text-transform:uppercase;"></td></tr> <!-- cod_posto -->
                     <tr> <td ><span>Nome:</span></td> <td colspan="2"><input type="text" id="nome" name="nome" style="width:100%"></td></tr> <!-- nome -->
                     <tr> <td ><span>Telefone:</span></td > <td colspan="2"><input type="text" id="telefone" name="telefone" style="width:100%"></td></tr> <!-- nome -->
                     <tr> <td ><span>Rua:</span></td> <td><input type="text" id="rua" name="rua"><span> Nº: </span></td> <td><input style="width:60px" type="text" id="num" name="num"></td></tr> <!-- rua -->
                     <tr> <td ><span>Bairro:</span></td> <td colspan="2"><input type="text" id="bairro" name="bairro" style="width:100%"></td></tr> <!-- bairro -->
                     
                     <tr> 
                        <td ><span>UF:</span></td>
                        <td colspan="2">
                           <?php //buscar array de CBO
                              $estado = new Estado();
                              $estados = $estado->get_name_all_uf();
                           ?>
                           <select name="estado" id="estado" onchange="buscar_cidades()" style="width:100%">
                              <option value="no_sel">Selecione um estado</option>
                              <?php 
                                 foreach($estados as $key => $estado){
                                    echo '<option value="'.$estados[$key][0].'">'.$estados[$key][1].'</option>';
                                 } 
                              ?>
                           </select>
                       </td>
                     </tr>
                     <tr>
                        <td><span> Cidade: </span></td>
                        <td colspan="2">
                           <div id="load_cidades">
                             <select name="cidade" id="cidade" style="width:100%">
                               <option value="no_sel">Selecione um estado</option>
                             </select>
                           </div>
                        </td>
                     </tr>

                     <tr> <td ><span>CEP:</span></td> <td colspan="2"><input type="text" id="cep" name="cep" style="width:100%"></td></tr> <!-- cep -->
                     
                     <tr> 
                        <td ><span>Empresa:</span></td>
                        <td colspan="2">
                           <select id="empresa" name="empresa"  style="width:100%">
                              <option value="no_sel">Selecione uma Empresa</option>
                              <?php 
                                 $empresa = new Empresa();
                                 $empresa = $empresa->get_all_empresa();
                                 for ($i=0; $i < count($empresa) ; $i++) { 
                                    echo '<option value="'.$empresa[$i][0].'">'.$empresa[$i][2].'</option>';
                                 }
                               ?>
                           </select>
                        </td>
                     </tr>
                     
                     <tr> 
                        <td ><span>Responsável:</span></td>
                        <td colspan="2">
                           <select id="responsavel" name="responsavel"  style="width:100%">
                              <option value="no_sel">Selecione o Responsável</option>
                              <?php 
                                 $func = new Funcionario();
                                 $func = $func->get_admin();
                                 for ($i=0; $i < count($func) ; $i++) { 
                                    echo '<option value="'.$func[$i][0].'">'.$func[$i][1].'</option>';
                                 }
                               ?>
                           </select>
                        </td>
                     </tr>
                     
                     <!-- <tr><td colspan="2"><span style="color:#898989">Segure Ctrl para múltiplas seleções</span></td></tr>   -->
                     <tr>
                        <td colspan="3" style="text-align:center">
                            <input class="button" type="submit" onclick="selectAll()" name="button" id="button" value="Cadastrar">
                            <input class="button" name="button" onclick="window.location.href='principal.php'" id="button" value="Cancelar">
                         </td>
                    </tr>
                  </table>
               </form>
               <?php }?>
               <?php 
                if(isset($_POST['tipo']) && $_POST['tipo'] == "cadastrar"){
                		if(validate()){
                      $endereco = new Endereco();
                      $nome = $_POST['nome'];
                      // $cnpj = $_POST['cnpj'];
                      $cod_posto = $_POST['cod_posto'];
                      $telefone = $_POST['telefone'];
                      $id_responsavel = $_POST['responsavel'];
                      $id_empresa = $_POST['empresa'];
  
                      $rua = $_POST['rua'];
                      $num = $_POST['num'];
                      $id_cidade = $_POST['cidade'];
                      $bairro = $_POST['bairro'];
                      $cep = $_POST['cep'];
  
                      $endereco->add_endereco($rua, $num, $id_cidade, $bairro, $cep);
                      // $endereco->bairro = $bairro;
                      // $endereco->cep = $cep;
  
                      $id_endereco = $endereco->add_endereco_bd();
  
  
                      $filial = new Filial();
                      $filial->add_filial($nome, $cod_posto, $telefone, $id_endereco, $id_responsavel, $id_empresa);
    
                      if($filial->add_filial_bd()){
                        echo '<div class="msg">Posto de trabalho adicionado com sucesso!</div>';
                      }else{
                        echo '<div class="msg">Falha ao adicionar posto de trabalho!</div>';
                      }                      
                      }
                }else{
                	 if(isset($_POST['tipo']) && $_POST['tipo'] == "editar"){
                            if(validate()){
                                $filial = new Filial();
                                $endereco = new Endereco();

                                $id = $_POST['id'];
                                $nome = $_POST['nome'];
                                // $cnpj = $_POST['cnpj'];
                                $cod_posto = $_POST['cod_posto'];
                                $telefone = $_POST['telefone'];
                                $id_responsavel = $_POST['responsavel'];
                                $id_empresa = $_POST['empresa'];
            
                                $rua = $_POST['rua'];
                                $num = $_POST['num'];
                                $id_cidade = $_POST['cidade'];
                                $bairro = $_POST['bairro'];
                                $cep = $_POST['cep'];
                                $existe_endereco = $endereco->verifica_endereco($_POST['id_endereco']);
                                
                                if($existe_endereco){
                                    $endereco->atualiza_endereco($rua, $num, $id_cidade, $_POST['id_endereco'], $bairro, $cep );
                                    $id_endereco = $_POST['id_endereco'];
                                }else{
                                    $endereco->add_endereco($rua, $num, $id_cidade, $bairro, $cep);
                                    $id_endereco = $endereco->add_endereco_bd();
                                }
                                
                                if($filial->atualiza_filial($id, $nome, $cod_posto, $telefone, $id_endereco, $id_responsavel, $id_empresa)){
                                      echo '<div class="msg">Atualizado com sucesso!</div>';
                                }else{
                                   echo '<div class="msg">Falha na atualização!</div>';
                                }
                              
                            }                          

                	 }
                  }
                ?>                
			</div>
			<?php include("informacoes_filial.php") ?>
	 
</body>
</html>