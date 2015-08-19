<?php
session_start();
include_once("../administrator/restrito.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_horarios_bd.php");
include_once("../model/class_turno_bd.php");
include_once("../model/class_sql.php");
include_once("../global.php");

?>
<html>

<head>
   <title>Relatórios</title>
   <meta charset="UTF-8">
   <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
   <script src="../javascript/selectbox.js" type="text/javascript"></script>
   <link rel="stylesheet" type="text/css" href="../administrator/style.css">
</head>

<body>


         
            <?php include_once("../view/topo.php"); ?>
            <div class="formulario" style="width:93%">
	            <div class="content-right" >
	            	<?php
					//Definindo os dados para conexão e seleção da base de dados
					$sql = new Sql();
					$sql->conn_bd();
					$funcionario = new Funcionario();
					
					 
					//Query simples para busca dos dados
					$busca = mysql_query("SELECT * FROM funcionario WHERE id_empresa = '".$_SESSION['id_empresa']."' ORDER BY id DESC")or die(mysql_error());
					//Verificação das linhas encontradas.
					if(mysql_num_rows($busca) > 0)
					{
					?>
						<table width="100%" border="1" cellpadding="0" cellspacing="0" id="listacliente" style="text-align:center; font-size: 14px;">
							<tr>
								<td>ID</td><td>Nome</td><td>CPF</td><td>Email</td><td>Status</td><td></td>
							</tr>
							<?php
							while ($ver = mysql_fetch_assoc($busca)){
							?>
							 
							<tr align="center" valign="middle" style="background-color:rgba(255,255,255,0.2);" onMouseOver="style.backgroundColor='rgba(255,255,255,0.7)'" onMouseOut="style.backgroundColor='rgba(255,255,255,0.2)'">
								<td ><?php echo $ver['id']; ?></td>
								<td ><?php echo $ver['nome']; ?></td>
								<td ><?php echo $ver['cpf']; ?></td>
								<td ><?php echo $ver['email']; ?></td>
								<td ><?php $ver['oculto']=='1' ? print '<strong><span style="color:red">Oculto</span></strong>' : print '<strong><span style="color:#093">Ativo</span></strong>'; ?>
								</td>
								<td width="80">
									<a href="relatorio.php?rel=funcionario&id=<?php echo $ver['id']; ?>" title="Gerar PDF"
									target="_self">Gerar PDF</a>
								</td>
							</tr>
							<?php }  ?>
						</table>
					<?php
					}else{
						//Caso não tenha registros a consulta, exibimos a mensagem.
						print 'Sem Registros';
						 
						}
					?>



	            </div>
	        </div>

</body>
</html>









