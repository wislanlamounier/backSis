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

  for($aux = 0; $aux < count($_SESSION['produto']['material']); $aux++){
        $id_qtd_tipo = explode(":", $_SESSION['produto']['material'][$aux]);
        
        if($id_qtd_tipo[0] == $id){
           $_SESSION['produto']['material'][$aux] = $id.':'.$quantidade.':'.$tipo;
        }
  }
      
  
?>

