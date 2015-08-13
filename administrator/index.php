
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body-login">
	<!-- <div class='container'> -->
		<div class='content'>
			<img src="../images/logo75mm.png" style="margin: 0 auto; width:350px;">
			<form type="submit" method="POST" action="loggar.php"> 
				<table class="tabelapadrao" id="table_login">
					<tr>
						<td><span>Login: </span></td><td><input type="text" name="id" id="id"></td>
					</tr>
					<tr>
						<td><span>Senha: </span></td><td><input type="password" name="pass" id="pass"></td>
					</tr>
					<tr>
						<td colspan="2"><input id="btn_entrar" class="botao_submit" name="btn_entrar" type="submit" value="Entrar"></td>
					</tr>
				</table>
			</form>
			<?php 
				if(isset($_GET['falha'])){
					echo "<div style='width:100%; height:100px; font-size:14px; color:#b00'>Usuário ou senha inválidos!</div>";
				}
			 ?>
			
		</div>
	<!-- </div> -->
</body>
</html>
