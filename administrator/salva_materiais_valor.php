<?php
session_start();
include_once("../model/class_valor_custo_bd.php");
include_once("../model/class_custo_regiao_bd.php");
include_once("../model/class_tipo_custo_bd.php");
include_once("../model/class_cidade_bd.php");


function moeda($get_valor){    // função para transformar o dado do input igual o do banco

$source = array('.', ',','R$');
$replace = array('', '.','');

$valor = str_replace($source, $replace, $get_valor); //remove os pontos e substitui a virgula pelo ponto
return $valor; //retorna o valor formatado para gravar no banco
}
 
 $entra= 0; $cont = 0;
$id_cidade = "";
foreach ($_POST as $key => $value) { // for each que alimenta as variaveis que precisa adicionar no banco
     
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
        $value = moeda($value);        
        $valor_custo = $value;
       
        if($valor_custo != ""){  
            $cont++;
            $entra = 1;        // codigo para diferir dos outros materias sem valor, se não estiver com entra esta sem valor e nao pode ser adicionado
        }        
    }
    if($tipo[1] == "tipo_custo"){        
        $tipo_custo = $value;
        $cont++;        
    }
    
    
    
    if($cont == 4 && $entra == 1){ // inicio do for each se esta com objeto completo e se entra foi encrementado    
  
     $id_empresa = $_SESSION['id_empresa'];
     $cidade = new Cidade();
     $id_estado = $cidade->get_city_by_id($id_cidade);     
     $vlr_custo = new Valor_custo();
     $custo_regiao = new Custo_regiao();
     $natualiza = 0; // Encrementa quando adiciona ou atualiza pra nao atualizar duas vezes

           
                   
            $id_valor_custo = $custo_regiao->get_valor_regiao($id_material, $id_cidade, $id_empresa); // condição para verificar se existe material com preo para essa cidade
                if($id_valor_custo[0][0] != ""){
                    $v_c = new Valor_custo();
                    $v_c = $v_c->get_valor_custo_id($id_valor_custo[0][0]);
                    $valor_comparacao = number_format($v_c->valor, 2, ',', '.');
                    $valor_comparacao = moeda($valor_comparacao);                   
                }
 
                   
                if($valor_custo != $valor_comparacao && $valor_comparacao == "" ){ // condição para adição se não houver materiais para essa cidade
                   
                    $vlr_custo->add_valor_custo($valor_custo, $tipo_custo);
                        $id_vlr_custo = $vlr_custo->add_valor_custo_bd();
                        if($id_material != "" && $id_vlr_custo != "" && $id_empresa != ""){
                            $custo_regiao->add_custo_regiao($id_material, $id_vlr_custo, $id_cidade, $id_estado->estado, $id_empresa);
                            $custo_regiao->add_custo_regiao_bd();
                            $natualiza = 1;
                        }
                  }
         
                  if($valor_custo != $valor_comparacao && $natualiza == 0){ // condição para atualizar o valor custo
                      
                    $vlr_custo->add_valor_custo($valor_custo, $tipo_custo);
                    $id_valor_custo = $vlr_custo->add_valor_custo_bd(); 
                    $custo_regiao->atualiza_custo_regiao_bd($id_valor_custo, $id_material, $id_cidade);
                    $natualiza = 1;
                  }
                  if($tipo_comparacao != $tipo_custo && $natualiza == 0){ // condição para atualizar o tipo do valor
                      
                    $vlr_custo->add_valor_custo($valor_custo, $tipo_custo);
                    $id_valor_custo = $vlr_custo->add_valor_custo_bd(); 
                    $custo_regiao->atualiza_custo_regiao_bd($id_valor_custo, $id_material, $id_cidade);
                   
                  }

     $natualiza = 0;              
     $tipo_comparacao = "";              
     $valor_comparacao = "";             
     $entra = 0;     
     $cont = 0;
    }        

}
   echo '<script>window.location = "add_material.php?axestado='.$id_estado->estado.'&cidade='.$id_cidade.'"</script>';

?>