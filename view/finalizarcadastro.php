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

 	
 		

 	
	
 </script>

	
	<div class="box-login" style="background-color: rgb(255, 0, 0)">
		<div style="float:left"><img src="../images/user.png" width="40px"></div>
        <div class="nome-box-login" style=""> <?php 
            
            $err = 0;

        if($_SESSION['telefone'] == ""){
            echo '<br>'."Você precisa cadastrar seu telefone";
            $err = $err + 1;
        } 
        if($_SESSION['id_endereco'] == ""){
            echo '<br>'."Você precisa cadastrar seu endereço";
            $err = $err + 1;
        }
        if($_SESSION['ins_estadual'] == ""){
            echo '<br>'."Você precisa cadastrar sua inscriçao estadual";
            $err = $err + 1;
        }
        if($_SESSION['ins_municipal'] == ""){
            echo '<br>'."Você precisa cadastrar seu inscriçao municipal";
            $err = $err + 1;
        }
        
        if ($err == 0){
                echo "<script>desabilitaDiv()</script>";
            }
            


        ?></div>
		<!-- <div class="nome-box-login" style=""><span style="">Lucas voce precisa completar seu cadastro para poder usar todas funções do sofware:<br /></span><?php echo $_SESSION["user"]; ?><br /><span style="">Empresa:<br /></span><?php echo $_SESSION['empresa']."<span> (".$nivel_acesso.")</span>" ?></div> -->
		<div style="float:right;"><a title="Clique para sair" href="logout.php"><img src="../images/fechar.png" width="20px"></a></div>
	</div>




