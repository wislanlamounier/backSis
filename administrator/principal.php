<?php 
include("restrito.php");
include_once("../model/class_horarios_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");
include_once("../model/class_veiculo_bd.php")
 ?>
 <html>
 <head>

 	<meta charset="UTF-8">
 	<title>Principal</title>
 	
 	<script src="../javascript/jquery-2.1.4.min.js"></script>
 	<!--<script src="../javascript/jquery_mobile/jquery.mobile-1.4.5.min.js"></script>-->
 	<!-- <link rel="stylesheet" type="text/css" href="../javascript/jquery_mobile/jquery.mobile-1.4.5.min.css"> -->
 	<link rel="stylesheet" type="text/css" href="style1.css">
 </head> 
 <script type="text/javascript">

  function hidden(id){
     document.getElementById(id).style.display = "none";
  }
  function exibe(popup){
  	var p = popup;
  	
        // document.getElementById("popup").style.display = "block";
        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;
      
        var screenWidth = screen.width;
        var screenHeight = screen.height;
        // alert(windowWidth+" x "+windowHeight)
        if(windowWidth > 1200){
          document.getElementById(p).style.marginLeft = "20%";
        }else if(windowWidth > 1000){
          document.getElementById(p).style.marginLeft = "20%";
        }else if(windowWidth > 500){
          document.getElementById(p).style.marginLeft = "20%";
        }else{
          document.getElementById(p).style.marginLeft = "0%";
        }
    }
    function fechar(popup){
    	p = popup;
        document.getElementById(p).style.marginLeft = "-450px";
    }

 function moveRelogio(){

		var data = new Date();

		var hora = data.getHours();
		var minuto = data.getMinutes();
		var segundo = data.getSeconds();
		
		if(hora<=9) hora = "0"+hora;
		if(minuto<=9) minuto = "0"+minuto;
		if(segundo<=9) segundo = "0"+segundo;

		var horaImp = hora+":"+minuto+":"+segundo;

		document.getElementById("txtRelogio").value = horaImp;
		setTimeout("moveRelogio()", 1000);

	}
 </script>
 <body onload="moveRelogio()"> 
 		
 		

 		<?php include_once("../view/topo.php"); ?>
 		<?php if($_SESSION['nivel_acesso'] == 0 || $_SESSION['nivel_acesso'] == 2){
 			echo '<div class="formulario" style="width:93%">';
 			// include_once("../view/box-atrasos.php");
 			// include("../view/painel_cliente_obra.php");
 			include("../view/painel_info_obra.php");

 			
			// include("../view/painel_funcionario_obra.php");
			

 		}?> 

 		
 </body>
 </html>