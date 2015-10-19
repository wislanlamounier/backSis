<?php
session_start();
include_once("../model/class_valor_custo_bd.php");
include_once("../model/class_custo_regiao_bd.php");
include_once("../model/class_tipo_custo_bd.php");
include_once("../model/class_cidade_bd.php");

$cont = 0; $contforeach = 0;
$id_cidade = "";
foreach ($_POST as $key => $value) {
     
    $tipo = explode(":",$key);
   
    
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
            $valor_comparacao = 0;
            $id_valor_custo = $custo_regiao->get_valor_regiao($id_material, $id_cidade, $id_empresa);
            echo $id_valor_custo[0][0];
            if($id_valor_custo[0][0] != ""){
                $v_c = new Valor_custo();
                $v_c = $v_c->get_valor_custo_id($id_valor_custo[0][0]);               
                $valor_comparacao = $v_c->valor;

            }
            
            
            
            if($valor_comparacao == 0 && $valor_custo!=""){
                $vlr_custo->add_valor_custo($valor_custo, $tipo_custo);
                $id_valor_custo = $vlr_custo->add_valor_custo_bd();
                if($id_material != "" && $id_valor_custo != "" && $id_empresa != ""){
                    $custo_regiao->add_custo_regiao($id_material, $id_valor_custo, $id_cidade, $id_estado->estado, $id_empresa);
                    $custo_regiao->add_custo_regiao_bd(); 
                }
            }
            
            if($valor_custo != $valor_comparacao && $valor_comparacao != 0){
                $vlr_custo->add_valor_custo($valor_custo, $tipo_custo);
                $id_valor_custo = $vlr_custo->add_valor_custo_bd(); 
                $custo_regiao->atualiza_custo_regiao_bd($id_valor_custo, $id_material, $id_cidade);
            }
            
            if($valor_comparacao == $valor_custo){
                echo "Condição para nao auailzar nem adicionar novo valor de custo";
            }

        }
       
    $cont = 0;
    }
    $contforeach++;
}
    echo '<script>window.location = "add_material.php?axestado='.$id_estado->estado.'&cidade='.$id_cidade.'"</script>';

?>