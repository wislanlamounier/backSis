<?php 
include("restrito.php");
include_once("../model/class_horarios_bd.php");
 ?>
 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>Principal</title>
 	
 	<!--<script src="../javascript/jquery-2.1.4.min.js"></script>-->
 	<!--<script src="../javascript/jquery_mobile/jquery.mobile-1.4.5.min.js"></script>-->
 	<!-- <link rel="stylesheet" type="text/css" href="../javascript/jquery_mobile/jquery.mobile-1.4.5.min.css"> -->
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body> 
 		
 		<?php include_once("../view/topo.php"); ?>
 		<?php if($_SESSION['nivel_acesso'] == 0 || $_SESSION['nivel_acesso'] == 2){
 			echo '<div class="formulario" style="width:93%">';
 			include_once("../view/box-atrasos.php");
 			echo '</div>';
 		} ?>
 		
 </body>
 </html>