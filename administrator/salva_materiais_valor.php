<?php
session_start();
include_once("../model/class_valor_custo_bd.php");
include_once("../model/class_custo_regiao_bd.php");
include_once("../model/class_tipo_custo_bd.php");
include_once("../model/class_cidade_bd.php");

$cont = 0; $contforeach = 0;
$id_cidade = "";
foreach ($_POST as $key => $value) {
     "key".$key;
     "value".$value."</br>";
    
    
    
    $tipo = explode(":",$key);
    $tipo[0];    
    $tipo[1]."<br>"; // piece1
    
    $id_material = $tipo[0];
    
 
    if($tipo[1] == "medida"){
        $medida = $tipo[0];
        $cont++;
    }

    if($tipo[1] == "cidade"){
        $id_cidade = $tipo[2];
        $cont++;
    }
    if($tipo[1] == "valor_custo"){
       
        $valor_custo = $value;
        $cont++;
        
    }
    if($tipo[1] == "tipo_custo"){
        
        $tipo_custo = $value;
        $cont++;
        
    }
    
    
    
    if($cont == 4){
    
  
     $id_empresa = $_SESSION['id_empresa'];
     $cidade = new Cidade();
     
     
     $id_estado = $cidade->get_city_by_id($id_cidade);     
     $vlr_custo = new Valor_custo();
     $custo_regiao = new Custo_regiao();
     

     
        if($valor_custo !="" ){                    
            $vlr_custo->add_valor_custo($valor_custo, $tipo_custo);
            $id_valor_custo = $vlr_custo->add_valor_custo_bd();  
      
        if($id_valor_custo !="" && $id_cidade != "" && $id_estado!= ""){ 
        $custo_regiao->add_custo_regiao($id_material, $id_valor_custo, $id_cidade, $id_estado->estado, $id_empresa);        
        $custo_regiao->add_custo_regiao_bd();
            }        
        }
           
    $cont = 0;
    }
    $contforeach++;
}
    echo '<script>window.location = "add_material.php?axestado='.$id_estado->estado.'&cidade='.$id_cidade.'"</script>';
echo $contforeach;
?>