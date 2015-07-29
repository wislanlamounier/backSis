
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="body-login">
	<!-- <div class='container'> -->
		<div class='content'>
			<img src="../images/logo75mm.png" style="margin: 0 auto">
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
				//if(isset($_POST['nome'])){return true;}else{return false;}
			 ?>
			
		</div>
	<!-- </div> -->
</body>
</html>
