<?php 
  session_start();
  include_once("../model/class_produto_bd.php");

  $id_produto = $_GET['id_produto'];
  $data_ini = $_GET['data_ini'];
  $data_fim = $_GET['data_fim'];
  $etapa = $_GET['etapa'];


  if(!isset($_SESSION['obra']['cronograma'][$etapa]))
    $_SESSION['obra']['cronograma'][$etapa][0] = $id_produto.':'.$data_ini.':'.$data_fim;
  else
    $_SESSION['obra']['cronograma'][$etapa][count($_SESSION['obra']['cronograma'][$etapa])] = $id_produto.':'.$data_ini.':'.$data_fim;
  
  count($_SESSION['obra']['cronograma'][$etapa]);
 ?>

<div style="overflow-x: scroll; ">
  <?php //for($e = 0; $e < $_SESSION['obra']['etapas']; $e++){
                //echo '<div style="text-align:center"><b>ETAPA '.($e+1).'</b></div>'; ?>
    <table cellpadding="0" cellspacing="0" border="0" style="width:100%; text-align:center; margin-bottom:20px;">
          <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <?php
                  
                  
                       $data = $_SESSION['obra']['dados']['data_inicio_previsto'];
                       $arrayData = explode("-", $data);
                       // echo "<script>alert('$data');</script>";
                       $dia = $arrayData[2];
                       $mes = $arrayData[1];
                       $ano = $arrayData[0];
                       for($aux = 0; $aux <= 100; $aux++) {
                           echo '<td  style="padding:5px; border-right: 1px solid #cdcdcd"><span><b>'.date('d/m/Y', strtotime("$data +$aux days")).'</b></span></td>';
                       }
                  
                ?>
          </tr>
          
          <?php 
            for($i = 0; $i < count($_SESSION['obra']['cronograma'][$etapa]) ; $i++)
                for($p = 0; $p < count($_SESSION['obra']['produto']); $p++){
                    $id_qtd = explode(':', $_SESSION['obra']['produto'][$p]);
                    $res = new Produto();
                    $res = $res->get_produto_id($id_qtd[0]);
                    ?>
                      <tr <?php echo 'id="tr-'.$res->id.'"'; ?> class="row-table" title="">
                          <td><span><?php echo $res->nome ?> </span></td>
                          

                          <?php
                          
                               $data = $_SESSION['obra']['dados']['data_inicio_previsto'];
                               $arrayData = explode("-", $data);
                               // echo "<script>alert('$data');</script>";
                               $dia = $arrayData[2];
                               $mes = $arrayData[1];
                               $ano = $arrayData[0];

                               // $_SESSION['obra']['cronograma'][$res->id][count($_SESSION['obra']['cronograma'])] = $id_produto.':'.$data_ini.':'.$data_fim;
                               

                               for($aux = 0; $aux <= 100; $aux++) {
                                   echo '<td id="'.$res->id.'-'.date('Y-m-d', strtotime("$data +$aux days")).'" style="';
                                   // if()
                                   $explode = explode(":", $_SESSION['obra']['cronograma'][$etapa][$i]);
                                   if(strtotime(date('Y-m-d', strtotime("$data +$aux days"))) >= strtotime($data_ini) && strtotime(date('Y-m-d', strtotime("$data +$aux days"))) <= strtotime($data_fim) && $res->id == $explode[0] )
                                        echo 'background-color:#c00;';
                                   echo 'padding:0px; margin: 0; border-right: 1px solid #cdcdcd"><span style="color:#cdcdcd; font-size: 10px">'.date('d/m/Y', strtotime("$data +$aux days")).'</span></td>';
                               }
                          
                          ?>
                      </tr>
              <?php }//fim for 

            ?>
          
    </table>
    <?php //} ?>
</div>
