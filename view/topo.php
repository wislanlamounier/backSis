<div style="width:100%; float:left;" >
	<div class="img" style="float:left"><img src="../images/logo75mm.png"></div>
	<div style="border: 1px solid#ddd;border-radius:3px; width: 200px; float:right; background-color:rgba(255,255,255,0.5); padding:5px;">
		<div style="float:left"><img src="../images/user.png" width="40px"></div>
		<div class="nome-box-login" style=""><span style="">Usuário:<br /></span><?php echo $_SESSION["user"]; ?></div>
		<div style="float:right;"><a title="Clique para sair" href="logout.php"><img src="../images/fechar.png" width="20px"></a></div>
	</div>
</div>
<div style="float:left; width:100%">
 	<div class="menu">
	<div class="menu">
         <?php include_once("../view/menu_admin.php"); ?>
    </div>
</div>