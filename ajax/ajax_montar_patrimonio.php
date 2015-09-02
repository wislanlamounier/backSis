<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");


	
	$id = $_GET['id'];  //codigo do estado passado por parametro
	$tipo = $_GET['tipo'];

	$total = 0;
	
	if(!isset($_SESSION['obra']['patrimonio'])){
		// echo 'entrou aqui';
		$_SESSION['obra']['patrimonio'][0] = $tipo.':'.$id.':1';
		// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
	}else{
		$total = count( $_SESSION['obra']['patrimonio'] );
		$_SESSION['obra']['patrimonio'][$total] = $tipo.':'.$id.':1';
		// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
	}

	

	
	// echo 'total: '.$total.'<br>';
	
	// echo 'id_recebido: '.$id.'<br>';
		
	// // 	// echo 'count'.count( $_SESSION['obra']['patrimonio'] );
	echo '<table>';
  	for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
  		$tipo_id_qtd = explode(':', $_SESSION['obra']['patrimonio'][$aux]);
  	    // echo 'ID: '.$tipo_id_qtd[1].' Tipo: '.$tipo_id_qtd[0].' Quantidade: '.$tipo_id_qtd[2].'<br />';

  		echo '<tr>';
  		if($tipo_id_qtd[0] == 0){
  			 $res = Patrimonio_geral::get_patrimonio_geral_id($tipo_id_qtd[1]);
  			 echo '<td ><span>'.$res->nome.': </span></td><td><input name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
  		}else if($tipo_id_qtd[0] == 1){
  			 $res = Maquinario::get_maquinario_id($tipo_id_qtd[1]);
  			 echo '<td><span>'.$res->modelo.': </span></td><td><input name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
  		}else{
  			 $res = Veiculo::get_veiculo_id($tipo_id_qtd[1]);
  			 echo '<td><span>'.$res->modelo.': </span></td><td><input name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
  		}
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



