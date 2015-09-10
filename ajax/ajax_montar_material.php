<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_material_bd.php");
include_once("../model/class_unidade_medida_bd.php");
include_once("../model/class_produto_bd.php");

	
	$id = $_GET['id'];  //codigo do material passado por parametro
	$param_id = explode(":", $id);

	$total = 0;
	if($param_id[0] == 'm'){// se for material
		$id = $param_id[1];
		if(!isset($_SESSION['produto']['material'])){
			// echo 'entrou aqui';
			$_SESSION['produto']['material'][0] = $id.':1'.':m';
			// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
		}else{
			$total = count( $_SESSION['produto']['material'] );
			$_SESSION['produto']['material'][$total] = $id.':1'.':m';
			// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
		}
	}else{// se for produto
		$id = $param_id[1];
		if(!isset($_SESSION['produto']['material'])){
			// echo 'entrou aqui';
			$_SESSION['produto']['material'][0] = $id.':1'.':p';
			// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
		}else{
			$total = count( $_SESSION['produto']['material'] );
			$_SESSION['produto']['material'][$total] = $id.':1'.':p';
			// $_SESSION['obra']['patrimonio'][$id][0] = $tipo;
		}
	}

	

	
	// echo 'total: '.$total.'<br>';
	
	// echo 'id_recebido: '.$id.'<br>';
		
	// // 	// echo 'count'.count( $_SESSION['obra']['patrimonio'] );
	echo '<table style="width:100%">';
  	for($aux = 0; $aux < count($_SESSION['produto']['material']); $aux++){
  		$id_qtd_tipo = explode(':', $_SESSION['produto']['material'][$aux]);
  	    // echo 'ID: '.$tipo_id_qtd_tipo[1].' Tipo: '.$tipo_id_qtd_tipo[0].' Quantidade: '.$tipo_id_qtd_tipo[2].'<br />';

  		if($aux%2==0)
               echo '<tr style="background-color:#ccc;">';
        else
              echo '<tr style="background-color:#ddd;">';
          	if($id_qtd_tipo[2] == 'm'){// se for material
	  		     $res = new Material();
	  			 $res = Material::get_material_id($id_qtd_tipo[0]);
	         	 $uni = new Unidade_medida();
				 $uni = $uni->get_unidade_medida_by_id($res->id_unidade_medida);
	  			 echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" onchange="increment(this.id)" style="width:30%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd_tipo[1].'"> <span>'.$uni->sigla.'</span></td><td><a name="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" style="cursor:pointer"  onclick="apagar(this.name,\'material\')"><img style="width:15px" src="../images/delete.png"></a></td>';
  			}else if($id_qtd_tipo[2] == 'p'){// se for produto
  				 $res = new Produto();
	  			 $res = $res->get_produto_id($id_qtd_tipo[0]);
	  			 echo '<td ><span>'.$res->nome.': </span></td><td><input  id="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" onchange="increment(this.id)" style="width:30%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$id_qtd_tipo[1].'"></td><td><a name="'.$res->id.':'.$id_qtd_tipo[1].':'.$id_qtd_tipo[2].'" style="cursor:pointer"  onclick="apagar(this.name,\'material\')"><img style="width:15px" src="../images/delete.png"></a></td>';
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



