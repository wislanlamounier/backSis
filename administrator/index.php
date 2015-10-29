<?php
session_start();
if(isset($_SESSION["id"]) && isset($_SESSION["user"]) && isset($_SESSION["id_empresa"])){
	header("location:principal.php");
}?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	
</head>
<body class="body-login">
	<!-- <div class='container'> -->
		<div class='content' style="height:390px; padding: 5">
			<img src="../images/logo-sgo.png" style="margin: 0 auto; width:350px;">
			<form type="submit" method="POST" action="loggar.php"> 
				<table class="tabelapadrao" id="table_login" border="0" style="width:250px;">
					<tr>
						<td><input class="form-control" style="text-align:center" placeholder="Usuário" type="text" name="id" id="id"></td>
					</tr>
					<tr>
						<td><input class="form-control" style="text-align:center" placeholder="Senha" type="password" name="pass" id="pass"></td>
					</tr>
					<tr>
						<td><input id="btn_entrar" style="width:100px; margin: 0 auto;" class="form-control" name="btn_entrar" type="submit" value="Entrar"><div style="font-size:11px; margin-top:5px;"><a href="../#cadastro">Cadastre-se</a><br /><a href="../view/esqueci_minha_senha">Esqueci minha senha</a><div></td>
					</tr>
				</table>
			</form>
			<?php 
				if(isset($_GET['falha']) && $_GET['falha'] == 'login'){
					echo "<div style='width:100%; height:100px; font-size:14px; color:#b00'>Usuário ou senha inválidos!</div>";
				}
				if(isset($_GET['falha']) && $_GET['falha'] == 'session'){
					echo "<div style='width:100%; height:100px; font-size:14px; color:#b00'>Sua sessão expirou!<br />Por favor, efetue o login novamente!</div>";
				}
			 ?>
			
		</div>
	<!-- </div> -->
</body>
</html>
