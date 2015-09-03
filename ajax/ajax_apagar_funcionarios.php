<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");
include_once("../model/class_funcionario_bd.php");

	
	$id = $_GET['id'];  //codigo do estado passado por parametro
	
	$total = 0;
	$cont = 0;
  for($aux = 0; $aux < count($_SESSION['obra']['funcionario']); $aux++){
      
      if($_SESSION['obra']['funcionario'][$aux] == $id){
          unset($_SESSION['obra']['funcionario'][$aux]);
          for($i = 0; $i < count($_SESSION['obra']['funcionario']); $i++){
             if(isset($_SESSION['obra']['funcionario'][$i])){
                $_SESSION['obra']['funcionario'][$cont] = $_SESSION['obra']['funcionario'][$i];
                $cont++;
             }
          }
          break;  
      }
      
  }

  

	echo '<table style="width:100%" >';
  	for($aux = 0; $aux < count($_SESSION['obra']['funcionario']); $aux++){
      	    // echo 'ID: '.$tipo_id_qtd[1].' Tipo: '.$tipo_id_qtd[0].' Quantidade: '.$tipo_id_qtd[2].'<br />';
      	if($aux%2==0)
           echo '<tr style="background-color:#aaa;">';
        else
          echo '<tr style="background-color:#ccc;">';
      			 $res = Funcionario::get_func_id($_SESSION['obra']['funcionario'][$aux]);
      			 echo '<td ><span>'.$res->nome.': </span></td><td style="text-align:center"><a id="'.$res->id.'" onclick="apagarFuncionario(this.id)"><img style="width:15px" src="../images/delete.png"></a></td>';      		
      		echo '</tr>';
  	}
  	echo '</table>';
      // echo 'ID: '.$id.' TIPO: '.$tipo.'<br />';
  		
	  	
	
?>



