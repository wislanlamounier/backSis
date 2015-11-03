<?php
include("restrito.php"); 

 ?>

<html>
<head>
	 <script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
	 <link rel="stylesheet" type="text/css" href="styles/style.css">

</head>

<body>			
	 <?php
                        $diretorio ='C:\Users\Lucas';
                        $files = scandir($diretorio,1);
                       
                       
                        foreach ($files as $key => $value) {
                            
                            echo $key;
                            
                        }                      
                        ?>
			
</body>
</html>