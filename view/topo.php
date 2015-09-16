<?php 
	if($_SESSION['nivel_acesso'] == 0){
		$nivel_acesso = "Acesso Total";
	}else if($_SESSION['nivel_acesso'] == 1){
		$nivel_acesso = "Acesso ViaCampos";
	}else{
		$nivel_acesso = "Acesso ControlPonto";
	}
 ?>
 <script type="text/javascript">
 	function submitForm(form){

 		var url = 'reportMailError.php?pag='+form[0].value+'&descricao='+form[1].value; 
 		$.get(url, function(dataReturn) {
            alert("Erro reportado com sucesso, Obrigado");
            document.getElementById("back-popup").style.display = "none";
        	document.getElementById("popup-erro").style.marginLeft = "-600px";
        });
 		
 		

 	}
	function exibe_error(){
        // document.getElementById("popup").style.display = "block";
        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;
      
        var screenWidth = screen.width;
        var screenHeight = screen.height;
        // alert(windowWidth+" x "+windowHeight)
		document.getElementById("back-popup").style.display = "block";
        if(windowWidth > 1200){
          document.getElementById("popup-erro").style.marginLeft = "35%";
        }else if(windowWidth > 1000){
          document.getElementById("popup-erro").style.marginLeft = "30%";
        }else if(windowWidth > 500){
          document.getElementById("popup-erro").style.marginLeft = "20%";
        }else{
          document.getElementById("popup-erro").style.marginLeft = "0%";
        }

    }
    function fecha_error(){
    	document.getElementById("back-popup").style.display = "none";
        document.getElementById("popup-erro").style.marginLeft = "-600px";
    }
 </script>
<div style="width:100%; float:left;" >
	<div class="img" style="float:left"><img src="../images/logo75mm.png"></div>
	<div class="box-login" style="">
		<div style="float:left"><img src="../images/user.png" width="40px"></div>
		<div class="nome-box-login" style=""><span style="">Usuário:<br /></span><?php echo $_SESSION["user"]; ?><br /><span style="">Empresa:<br /></span><?php echo $_SESSION['empresa']."<span> (".$nivel_acesso.")</span>" ?></div>
		<div style="float:right;"><a title="Clique para sair" href="logout.php"><img src="../images/fechar.png" width="20px"></a></div>
	</div>
</div>
<div style="float:right; padding-right:10px;">
    <a onclick="exibe_error()" style="cursor:pointer"><span>Reportar um Erro</span></a>
</div>
<div style="float:left; width:100%">
 	<div class="menu">
		<div class="menu">
	         <?php include_once("../view/menu_admin.php"); ?>
	    </div>
	</div>
</div>
<div class="back-popup" id="back-popup" style="position:absolute; z-index: 1">
</div>
<div id="popup-erro" class="popup-erro" style=" position: fixed; margin-top:100px;margin-left: -600px; width:500px; z-index: 5">
	<?php include_once("reportError.php"); ?>
</div>

