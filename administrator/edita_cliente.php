<?php 
include("restrito.php");
include_once("../model/class_sql.php");
include_once("../model/class_cbo_bd.php");
include_once("../model/class_cidade_bd.php");
include_once("../model/class_estado_bd.php");
include_once("../model/class_endereco_bd.php");
include_once("../model/class_cliente.php");
 ?>	

<html>
<head>
	<title>Editar Cliente</title>
	<link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>

  <script type="text/javascript">  
    function buscar_cidades(){
          
          var estado = document.getElementById("estado").value;  //codigo do estado escolhido
          //se encontrou o estado

          if(estado){

            var url = 'ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD

            $.get(url, function(dataReturn) {
              $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
            });
          }
     }
  </script>
</head>
<body onload="disparaLoadCidade()" >
	<?php include("../view/topo.php");  ?>
	<div class="formulario">
		 <h1>Editar Cliente Pessoa Fisica</h1>
                  <?php if(isset($_GET['verificador']) && $_GET['verificador'] == 1){ //se verificador estiver setado e for igual a 1 carregara os campos preenchidos?>
                    <?php 
                     $cli = new Cliente();
                     $cli = $cli->get_cli_id($_GET['id']);//buscando funcionario no banco
                     $endereco = new Endereco();
                     $endereco = $endereco->get_endereco( $cli->id_endereco );
                      // $endereco[0][0] Rua
                      // $endereco[0][1] Numero
                      // $endereco[0][2] Cidade
                      // $endereco[0][3] Estado
                      echo '<input type="hidden" id="id_cidade" value="'.$endereco[0][2].'">';
                     // echo '<input type="hidden" id="id_posto" value="'.$func->id_empresa_filial.'">';                      
                     // $data_em_rg = explode("-", $func->data_em_rg);
                     // $data_em_rg = $data_em_rg[2].'/'.$data_em_rg[1].'/'.$data_em_rg[0];
                     // $data_nasc = explode("-", $func->data_nasc);
                     // $data_nasc = $data_nasc[2].'/'.$data_nasc[1].'/'.$data_nasc[0];
                     // $data_adm = explode("-", $func->data_adm);
                     // $data_adm = $data_adm[2].'/'.$data_adm[1].'/'.$data_adm[0];                     
                     // echo $func->printFunc();

                   ?>
    <form form method="POST" id="add_cliente" action="add_cliente.php" onsubmit="return valida(this)">
            <table id="table_dados_pes" class="table_dados_pes" border="0" >
               <tr><td colspan="2" padding-top:='10px'><span class="dados_cadastrais_title"><b>Dados Cadastrais</b><span></td></tr>
               <tr> <td ><span>Tipo:</span></td> <td>  
               <br><input type="checkbox" onclick="tipo_form()" id="fornecedor" name="fornecedor" value="1">Fornecedor               
               <br><br></td></tr>
               <tr> <td ><div id="razao_nome">Nome:</div></td><td><input type="text" id="nome" name="nome" value="<?php echo $cli->nome; ?>" ></td></tr>
                   <tr> <td ><div id="data_fun_data_nasc">Data Nasc:</div></td> <td><input type="date" id="data_nasc" name="data_nasc" value="<?php echo $cli->data_nasc ?>" ></td></tr>
                   <tr> <td ><div id="cnpj_cpf">CPF:</div></td><td><input type="text" id="cpf" name="cpf" value="<?php echo $cli->cpf ?>" ></td></tr> 
                   <tr> <td ><span>Celular:</span></td> <td><input type="text" id="cel" name="cel" value="<?php echo $cli->telefone_cel ?>"></td></tr> 
                   <tr> <td ><span>Telefone:</span></td> <td><input type="text" id="tel" name="tel"value="<?php echo $cli->telefone_com ?>"></td></tr>                         
                   <tr> <td ><div id="inscricao_estadual_rg">RG:</div></td> <td><input type="text" id="rg" name="rg" value="<?php echo $cli->rg ?>" ></td></tr>  
                          <tr><td colspan="2"><span><b>Endereço</b></span></td></tr>
                          <tr> <td ><span>Bairro:</span></td> <td><input type="text" id="bairro" name="bairro"  value="<?php echo $endereco[0][4]; ?>" ></td></tr> 
                          <tr> <td ><span>Rua:</span></td> <td><input type="text" id="rua" name="rua" value="<?php echo $endereco[0][0]; ?>"></td></tr> 
                          <tr> <td ><span>Numero:</span></td> <td><input type="number" id="numero" name="numero" value="<?php echo $endereco[0][1]; ?>" ></td></tr>
                          <tr> <td ><span>UF:</span></td> 
                            <td>
                              <select id="estado" name="estado" onchange="buscar_cidades()">
                                <option>Selecione o Estado</option>
                                <?php 
                                   $estado = new Estado();
                                   $estado = $estado->get_name_all_uf();
                                   for( $aux = 0; $aux < count($estado) ; $aux++){
                                    echo '<option value="'.$estado[$aux][0].'">'.$estado[$aux][1].'</option>';
                                   }
                                ?>
                              </select>
                            </td>
                          </tr> 
                          <tr> 
                            <td><span>Cidade:</span></td>
                            <td>
                              <div id="load_cidades">
                                  <select name="cidade" id="cidade">
                                    <option value="">Selecione UF</option>
                                  </select>
                                </div>
                            </td>
                          </tr>                     
                          <tr> <td ><span>CEP:</span></td> <td><input type="number" id="cep" name="cep" value="<?php echo $endereco[0][5]; ?>"></td></tr> 
                          <tr> <td ><span>Site:</span></td> <td><input type="text" id="site" name="site" value="<?php echo $cli->site ?>" ></td></tr>
                          <tr><td colspan="2"><span><b>Responsável</b></span></td></tr>
                          <tr> <td ><span>Nome:</span></td> <td><input type="text" id="nome_resp" name="nome_resp" value="<?php echo $cli->responsavel ?>" ></td></tr> 
                          <tr> <td ><span>CPF:</span></td> <td><input type="text" id="cpf_resp" name="cpf_resp" value="<?php echo $cli->cpf_responsavel ?>" ></td></tr> 
                          <tr> <td ><span>Data Nascimento:</span></td> <td><input type="date" id="datanasc_resp" name="datanasc_resp" value="<?php echo $cli->data_nasc_responsavel ?>" ></td></tr> 
                          <tr> <td ><span>E-mail:</span></td> <td><input type="text" id="email_resp" name="email_resp" value="<?php echo $cli->email_resp ?>"></td></tr>                     
                          <tr><td colspan="2"><span><b>Observação</b></span></td></tr>                     
                          <tr><td colspan="2"> <div align="center"><textarea align="center" rows="4" cols="50" id="observacao" name="observacao"><?php echo $cli->observacao ?></textarea></div> </td></tr>                     
                          <tr><td colspan="2"><input class="botao_submit" type="submit" value="Enviar" ></td></tr> 

            </table>
        </form>

               <?php } ?>
             
                   <!--  <?php                  
                  

                       // if($func->atualiza_func($id, $nome, $cpf, $data_nasc, $id_endereco, $telefone, $email, $senha, $id_empresa, $id_empresa_filial, $id_turno, $id_cbo, $is_admin, $rg, $data_em_rg, $org_em_rg, $num_tit_eleitor, $email_empresa, $data_adm, $salario_base, $qtd_horas_sem, $num_cart_trab, $num_serie_cart_trab, $uf_cart_trab, $num_pis, $id_supervisor)){
                       //    echo '<div class="msg">Funcionário editado com sucesso</div>';
                       // }else{
                       //    echo '<div class="msg">Falha ao editar funcionário</div>';
                       // }
                    
                    ?> -->




                  

		<form method="POST" action="edita_cliente.php">
			<table>				
				<td><span>Cliente: <input type="text" id="name_search" name="name_search"></td> <td><input type="submit" value="Buscar"></td>
			</table>
		</form>

		<?php
           if(isset($_POST['name_search']) && $_POST['name_search'] != ""){
              $cli = new Cliente();
              $clis = $cli->get_cli_by_name($_POST['name_search']);
              
              if(count($clis) == 0){
                echo '<div class="msg">Nenhum registro encontrado!</div>';
              }
                echo '<table class="exibe_func">';
                foreach($clis as $key => $cli){
                   echo '<tr>
                            <td><a href="edita_cliente.php?verificador=1&id='.$clis[$key][0].'">'.$clis[$key][0]." ".$clis[$key][1].'</a></td></tr>';
                }
                echo '</table>';
           }                     
        ?>
	</div>


</body>
</html>