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
  // echo count($_SESSION['obra']['funcionario'])-1;
  print_r($_SESSION['obra']['funcionario']);
  echo '<br />';
  for($aux = 0; $aux < count($_SESSION['obra']['funcionario']); $aux++){
      
      if($_SESSION['obra']['funcionario'][$aux] == $id){
          // echo $_SESSION['obra']['funcionario'][$aux].' = '.$id;
          echo count($_SESSION['obra']['funcionario']);
          unset($_SESSION['obra']['funcionario'][$aux]);
          echo "     aux: ".$aux."    <br/>";
          echo count($_SESSION['obra']['funcionario']);
          for($i = $aux ; $i < count($_SESSION['obra']['funcionario']); $i++){
              if($i < count($_SESSION['obra']['funcionario'])-1)
                $_SESSION['obra']['funcionario'][$i] = $_SESSION['obra']['funcionario'][$i+1];

          }
      }//else{
      //     $_SESSION['aux'][$cont] = $_SESSION['obra']['funcionario'][$aux];
      //     echo count($_SESSION['aux'][$cont]);
      // }
  }
  ksort($_SESSION['obra']['funcionario']);
  print_r($_SESSION['obra']['funcionario']);
  // unset($_SESSION['obra']['funcionario']);
  // for($aux = 0; $aux < count($_SESSION['aux']); $aux++){

  //     $_SESSION['obra']['funcionario'][$aux] = $_SESSION['aux'][$aux];
  //     // echo "recebeu 1<br />";
  // }
   

  

	echo '<table style="width:100%" >';
  // echo '<br />cont antes imprimir: '.count($_SESSION['obra']['funcionario']);
  	for($aux = 0; $aux < count($_SESSION['obra']['funcionario'])+1; $aux++){
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



