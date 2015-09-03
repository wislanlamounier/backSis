<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");


	
	$id = $_GET['id'];  //codigo do estado passado por parametro
	$tipo = $_GET['tipo'];

	$total = 0;
	
  //verifica se ainda não existe patrimonio cadastrado
	if(!isset($_SESSION['obra']['patrimonio'])){
		//obra recebe a concatenação do tipo:id:quantidade
		$_SESSION['obra']['patrimonio'][0] = $tipo.':'.$id.':1';
	}else{
		$total = count( $_SESSION['obra']['patrimonio'] );
		$_SESSION['obra']['patrimonio'][$total] = $tipo.':'.$id.':1';
	}
  
  //verifica se é maquinario ou veiculo para adicionar seus respectivos responsaveis à obra
  if($tipo == 1){// maquinario
        $res = Maquinario::get_maquinario_id($id);
        $_SESSION['obra']['funcionario'][(isset($_SESSION['obra']['funcionario']))?count($_SESSION['obra']['funcionario']):0] = $res->id_responsavel;//adicionando na obra o funcionario responsavel pelo patrimonio
  }else if($tipo == 2){//veiculos
        $res = Veiculo::get_veiculo_id($id);
        $_SESSION['obra']['funcionario'][(isset($_SESSION['obra']['funcionario']))?count($_SESSION['obra']['funcionario']):0] = $res->id_responsavel;//adicionando na obra o funcionario responsavel pelo patrimonio
  }

	

	
	// echo 'total: '.$total.'<br>';
	
	// echo 'id_recebido: '.$id.'<br>';
		
	// // 	// echo 'count'.count( $_SESSION['obra']['patrimonio'] );
	echo '<table style="width:100%">';
  	for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
  		$tipo_id_qtd = explode(':', $_SESSION['obra']['patrimonio'][$aux]);
  	    // echo 'ID: '.$tipo_id_qtd[1].' Tipo: '.$tipo_id_qtd[0].' Quantidade: '.$tipo_id_qtd[2].'<br />';

  		if($aux%2==0)
           echo '<tr style="background-color:#aaa;">';
      else
          echo '<tr style="background-color:#ccc;">';
  		if($tipo_id_qtd[0] == 0){
  			 $res = Patrimonio_geral::get_patrimonio_geral_id($tipo_id_qtd[1]);
  			 echo '<td ><span>'.$res->nome.': </span></td><td><input name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" onchange="increment(this.name)" style="width:30%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$tipo_id_qtd[2].'"></td>';
  		}else if($tipo_id_qtd[0] == 1){
  			 $res = Maquinario::get_maquinario_id($tipo_id_qtd[1]);
         echo '<td><span>'.$res->modelo.': </span></td><td><input readonly name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
  		}else{
  			 $res = Veiculo::get_veiculo_id($tipo_id_qtd[1]);
  			 echo '<td><span>'.$res->modelo.': </span></td><td><input readonly name="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.name)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td>';
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



