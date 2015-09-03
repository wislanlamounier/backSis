<?php
session_start();
include_once("../model/class_sql.php");
  
  if(isset($_GET['nome']) && $_GET['nome'] !=""){
    $nome = $_GET['nome'];
    $_SESSION['produto']['nome'] = $nome;
  }
  

	// if(isset($_GET['id']) && isset($_GET['qtd']) !="" ){
	// $id = $_GET['id'];  //codigo do estado passado por parametro
	// $quantidade = $_GET['qtd'];
 //  }
 //  $nome = "";
 

 //  if(isset($_GET['nome']) && $_GET['nome']!="")
 //  $nome = $_GET['nome'];
 //  if($nome!=""){ 
 //  $_SESSION['produto']['nome'] = $nome;
 //  }



 //     if(!isset($_SESSION['produto']['materiais'])) 
 //          $_SESSION['produto']['materiais'][0] = $id.':'.$quantidade;
 //    else
 //          $_SESSION['produto']['materiais'][count($_SESSION['produto']['materiais'])] = $id.':'.$quantidade;
    
 //    for($i=0; $i < count($_SESSION['produto']['materiais']); $i++ )
 //        $tipo_id = explode(":", $_SESSION['produto']['materiais'][$i]);
 //        print_r($tipo_id); 
 //        echo $tipo_id[0];
 //        echo $tipo_id[1];
        

 //      echo "<br>". $_SESSION['produto']['materiais'][];
 //      echo "<br>". $_SESSION['produto']['nome'];

  // for($aux = 0; $aux < count($_SESSION['obra']['patrimonio']); $aux++){
  //       $tipo_id = explode(":", $_SESSION['obra']['patrimonio'][$aux]);
        
  //       if($tipo_id[1] == $id && $tipo_id[0] == $tipo){
         
  //          $_SESSION['obra']['patrimonio'][$aux] = $tipo.':'.$id.':'.$quantidade;
  //       }
  // }
	  	
	
?>

