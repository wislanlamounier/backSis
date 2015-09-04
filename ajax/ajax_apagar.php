<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");
include_once("../model/class_funcionario_bd.php");
	
	$id = $_GET['id'];  //codigo do array passado por parametro
	$whatarray = $_GET['whatarray'];// que array? especifica em qual array sera feita a exclusão: funcionario, patrimonio
	$total = 0;
	$cont = 0;

  for($aux = 0; $aux < count($_SESSION['obra'][$whatarray]); $aux++){//percorrendo array escolhido
      
      if($_SESSION['obra'][$whatarray][$aux] == $id){// quando encontrar o id escolhido

          unset($_SESSION['obra'][$whatarray][$aux]);// unset posição do array que contem o id à ser excluido
      }
  }
  foreach ($_SESSION['obra'][$whatarray] as $key => $value) { // percorre o array e reordena-o
     $array[$cont] = $value;
     $cont++;
  }

  if(isset($array) && count($array > 0))//se existir array
    $_SESSION['obra'][$whatarray] = $array;// session = array

	echo '<table style="width:100%" >';
  	for($aux = 0; $aux < count($_SESSION['obra'][$whatarray]); $aux++){      	 
      	if($aux%2==0)
           echo '<tr style="background-color:#aaa;">';
        else
          echo '<tr style="background-color:#ccc;">';
              if($whatarray == 'patrimonio'){// se for arrray de patrimonio verifica o tipo
                  $tipo_id_qtd = explode(':', $_SESSION['obra'][$whatarray][$aux]);

                  if($tipo_id_qtd[0] == 0){
                     $res = Patrimonio_geral::get_patrimonio_geral_id($tipo_id_qtd[1]);
                     echo '<td ><span>'.$res->nome.': </span></td><td><input  id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'" onchange="increment(this.id)" style="width:30%; background-color: rgba(230,230,230,0.5)" type="number" value="'.$tipo_id_qtd[2].'"></td><td><a style="cursor:pointer" name="'.$tipo_id_qtd[0].':'.$res->id.':'.$tipo_id_qtd[2].'" id="'.$res->id.'" onclick="apagar(this.name,\'patrimonio\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                  }else if($tipo_id_qtd[0] == 1){
                     $res = Maquinario::get_maquinario_id($tipo_id_qtd[1]);
                     echo '<td><span>'.$res->modelo.': </span></td><td><input readonly  id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.id)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td><td><a style="cursor:pointer" name="'.$tipo_id_qtd[0].':'.$res->id.':'.$tipo_id_qtd[2].'" id="'.$res->id.'" onclick="apagar(this.name,\'patrimonio\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                  }else{
                     $res = Veiculo::get_veiculo_id($tipo_id_qtd[1]);
                     echo '<td><span>'.$res->modelo.': </span></td><td><input readonly  id="qtd:'.$res->id.':'.$tipo_id_qtd[0].'"  onchange="increment(this.id)" style="width:30%" type="number" value="'.$tipo_id_qtd[2].'"></td><td><a style="cursor:pointer" name="'.$tipo_id_qtd[0].':'.$res->id.':'.$tipo_id_qtd[2].'" id="'.$res->id.'" onclick="apagar(this.name,\'patrimonio\')"><img style="width:15px" src="../images/delete.png"></a></td>';
                  }
              }else if($whatarray == 'funcionario'){
      			     $res = Funcionario::get_func_id($_SESSION['obra'][$whatarray][$aux]);
      			     echo '<td ><span>'.$res->nome.': </span></td><td style="text-align:center"><a id="'.$res->id.'" style="cursor: pointer" onclick="apagar(this.id,\''.$whatarray.'\')"><img style="width:15px" src="../images/delete.png"></a></td>';      		
              }
            
      		echo '</tr>';
  	}
  	echo '</table>';
      
  		
	  	
	
?>



