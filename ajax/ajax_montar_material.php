<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_material_bd.php");



	
	$id = $_GET['id'];  //codigo do estado passado por parametro
	

	$total = 0;
	
	if(!isset($_SESSION['produto']['material'])){
		// echo 'entrou aqui';
		$_SESSION['produto']['material'][0] = $id.':1';
		// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
	}else{
		$total = count( $_SESSION['produto']['material'] );
		$_SESSION['produto']['material'][$total] = $id.':1';
		// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
	}

	

	
	// echo 'total: '.$total.'<br>';
	
	// echo 'id_recebido: '.$id.'<br>';
		
	// // 	// echo 'count'.count( $_SESSION['obra']['patrimonio'] );
	echo '<table>';
  	for($aux = 0; $aux < count($_SESSION['produto']['material']); $aux++){
  		$id_qtd = explode(':', $_SESSION['produto']['material'][$aux]);
  	    // echo 'ID: '.$tipo_id_qtd[1].' Tipo: '.$tipo_id_qtd[0].' Quantidade: '.$tipo_id_qtd[2].'<br />';

  		echo '<tr>';
  		    $res = new Material();
  			 $res = Material::get_material_id($id_qtd[0]);
         
  			 echo '<td ><span>'.$res->nome.': </span></td>';
  		
  		echo '</tr>';
  		// if(count($patrimonio)>1)
  		// 	for($aux = 0; $aux < count($patrimonio); $aux++ ){
  		// 			echo 'id '. $patrimonio[$aux][1].'<br />';
  		// 	}
  		// else
  		// 	echo 'id '. $patrimonio[0][1].'<br />';
  	}
  	echo '</table>';
      // echo 'ID: '.$id.' TIPO: '.$tipo.'<br />';
  		
	  	
	
?>



