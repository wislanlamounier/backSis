<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");


	
	$id = $_GET['id'];  //codigo do estado passado por parametro
	$quantidade = $_GET['qtd'];
  $tipo = $_GET['tipo'];
  // echo 'id: '.$id.'<br />';
  // echo 'quantidade: '.$quantidade.'<br />';
  // echo 'tipo: '.$tipo.'<br />';

  for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
        $tipo_id = explode(":", $_SESSION['obra']['patrimonio'][$aux]);
        
        if($tipo_id[1] == $id && $tipo_id[0] == $tipo){
         
           $_SESSION['obra']['patrimonio'][$aux] = $tipo.':'.$id.':'.$quantidade;
        }
  }
	  	
	
?>

