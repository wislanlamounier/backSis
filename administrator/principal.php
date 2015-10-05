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
    function fechar_patrimonio(popup){
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
        
        function fechar(){
        document.getElementById("fundo").hidden = "false";
        document.getElementById("map").style.marginLeft = "-800px";
        document.getElementById("popup").style.marginLeft = "-450px";
                         }
        
        function mostraLocal(){ // FUNCAO QUE MOSTRA OCULTA OU MOSTRA A DIV DO MAPA
        document.getElementById('fundo').hidden = false;
        var windowWidth = window.innerWidth;
        var windowHeight = window.innerHeight;
        var screenWidth = screen.width;        
        var screenHeight = screen.height;
        
            if(windowWidth > 1200){
         
          document.getElementById("map").style.marginLeft = "28%";
          document.getElementById("map").style.marginTop = "12%";
           
            }else if(windowWidth > 1000){
          document.getElementById("map").style.marginLeft = "10%";
             }else if(windowWidth > 500){
          document.getElementById("map").style.marginLeft = "10%";
             }else{
          document.getElementById("map").style.marginLeft = "10%";
        }
             // INICIA O INTMAP DE NOVO POR QUE SE NAO FICA PAGINA EM BRANCO
     }
        
            var map;
    function initMap() {
      
      var zoom = 4; // zoom original para aparecer o mapa longe 
      var originalMapCenter = new google.maps.LatLng(-14.2392976, -53.1805017) // PONTO iNICIAL COM A LAT E LONG DO BRASIL
      var lat = document.getElementById('lat').value;  //RECEBE O VALOR DA LAT PELO INPUT
      var long = document.getElementById('long').value;// RECEBE O VALOR DA LONG PELO INPUT      
      
      if(lat !== "" && long !==""){
        var originalMapCenter = new google.maps.LatLng(lat, long);
        zoom = 16;
      }
      var map = new google.maps.Map(document.getElementById('map'),{
        mapTypeId: google.maps.MapTypeId.SATELLITE,/*ROADMAP*/
        scrollwheel: false,
        zoom: zoom,
        center: originalMapCenter
      });

      var infowindow = new google.maps.InfoWindow({
        content: 'Aqui é sua Obra',
        position: originalMapCenter
      });
      infowindow.open(map);

      map.addListener('zoom_changed', function() {
        infowindow.setContent('Zoom: ' + map.getZoom());
      });
     
    }

</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPnNgPERfFRTJYYW4zt9lZ0njBseIdi1I&callback=initMap" async defer></script>
 <body onload="moveRelogio(),initMap()"> 
 		
 		

 		<?php include_once("../view/topo.php"); ?>
                         <div style="margin-left: -800px; transition-duration: 0.8s; position: absolute; width:700px; height: 500px; z-index: 2; border: 1px solid#fff"id="map"></div>  
                         <div class="formulario" style="width:93%">
   		<?php if($_SESSION['nivel_acesso'] == 0 || $_SESSION['nivel_acesso'] == 2){
   			
   			include("../view/painel_info_obra.php");

   		}?>
                   
    </div>
                     <div id="fundo" hidden="on" style="background-color:rgba(0,0,0,0.8); margin-top: -9px; margin-left: -9px; width:100%; height: 100%; position: absolute; z-index: 1" >
                            <span  onclick="fechar()" style="cursor:pointer; color:floralwhite; float:right; margin-top:10px; margin-right:10px; z-index: 1"> Fechar</span>
                    </div>  	
 </body>
 </html>