<?php 
	if($_SESSION['nivel_acesso'] == 0){
		$nivel_acesso = "Acesso Total";
	}else if($_SESSION['nivel_acesso'] == 1){
		$nivel_acesso = "Acesso ViaCampos";
	}else{
		$nivel_acesso = "Acesso ControlPonto";
	}
 ?>
<div style="width:100%; float:left;" >
	<div class="img" style="float:left"><img src="../images/logo75mm.png"></div>
	<div class="box-login" style="">
		<div style="float:left"><img src="../images/user.png" width="40px"></div>
		<div class="nome-box-login" style=""><span style="">Usuário:<br /></span><?php echo $_SESSION["user"]; ?><br /><span style="">Empresa:<br /></span><?php echo $_SESSION['empresa']."<span> (".$nivel_acesso.")</span>" ?></div>
		<div style="float:right;"><a title="Clique para sair" href="logout.php"><img src="../images/fechar.png" width="20px"></a></div>
	</div>
</div>
<div style="float:left; width:100%">
 	<div class="menu">
	<div class="menu">
         <?php include_once("../view/menu_admin.php"); ?>
    </div>
</div>