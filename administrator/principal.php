<?php 
include("restrito.php");

 ?>
 <html>
 <head>
 	<meta charset="UTF-8">
 	<title>Principal</title>
 	<link rel="stylesheet" type="text/css" href="../javascript/jquery_mobile/jquery.mobile-1.4.5.min.css">
 	<script src="../javascript/jquery-2.1.4.min.js"></script>
 	<script src="../javascript/jquery_mobile/jquery.mobile-1.4.5.min.js"></script>
 	<link rel="stylesheet" type="text/css" href="style.css">
 </head>
 <body> 
 		
 		<?php include_once("../view/topo.php"); ?>
 		<!-- <div>
 			<a href="#myPop" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all">Show Popup</a>
 		</div> -->
 		<div data-role="popup" id="myPop">
      		<?php include_once("add_cliente.php"); ?>
    	</div>
 </body>
 </html>