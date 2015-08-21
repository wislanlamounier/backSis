<?php 
      if(isset($_POST['observacao'])){
         
            $id = $_POST['id_horario'];
            $observacao = $_POST['observacao'];
            $g = new Glob();

            $id_supervisor = $_SESSION['id'];

            $obs = new ObsSupervisor();

            $obs->add_obs($id_supervisor, $observacao);

            $id_obs = $obs->add_obs_bd();

            $g->tratar_query("UPDATE horarios SET id_obs_supervisor = '%s' WHERE id = '%s'", $id_obs, $id);

      }

      if(isset($_GET['id_horario']) && $_GET['id_horario'] != ""){
          $horario = new Horarios();
          $horario = $horario->get_horario_by_id($_GET['id_horario'] );
          
          
          $funcionario = new Funcionario();
          $funcionario = $funcionario->get_func_id($horario->id_funcionario);
          $string .= $funcionario->nome.', ';
          if($horario->tipo == 1){
              $string .= ' iniciou o expediente ';
          }else if($horario->tipo == 2){
              $string .= ' iniciou o almoço ';
          }else if($horario->tipo == 3){
              $string .= ' encerrou o almoço ';
          }else{
              $string .= ' encerrou o expediente ';
          }
          $string .= substr($horario->situacao, 1). " atrasado";
          echo '<form method="POST" action="logado.php" onsubmit="return validate(this)">';
              echo '<input type="hidden" id="id_horario" name="id_horario" value="'.$_GET['id_horario'].'">';
              echo '<table class="table-aniversariantes">';
                   echo '<tr><td colspan="4"><img src="../images/rel.png"></td></tr>';
                   echo '<tr><td colspan="4">'.date("d/m/Y").'</td></tr>';
                   echo '<tr><td colspan="4"><b>Justificar atraso</b></td></tr>';
                   echo '<tr><td colspan="4">'.$string.'</td></tr>';
                   echo '<tr><td> <textarea id="observacao" name="observacao" style="width: 520px; height:50px; resize:none;"></textarea> </td></tr>';
                   echo '<tr><td style="padding-top:5px"> <input type="submit" value="Salvar"> <input type="button" value="Cancelar" onclick="window.location.href=\'logado.php\'"> </td></tr>';
               echo '</table>';
          echo '</form>';
      }else{
          $horario = new Horarios();
          $array = $horario->get_atrasos(date("Y-m-d"));
          echo '<table class="table-aniversariantes" border="0">';
          switch(count($array)){
            case 0:
              echo '<tr><td colspan="4" style="text-align:left"><img class="cont" src="../images/0.png"></td></tr>';
              break;
            case 1:
              echo '<img class="cont" src="../images/1.png">';
              break;
            case 2:
              echo '<img class="cont" src="../images/2.png">';
              break;
            case 3:
              echo '<img class="cont" src="../images/3.png">';
              break;
            case 4:
              echo '<img class="cont" src="../images/4.png">';
              break;
            case 5:
              echo '<img class="cont" src="../images/5.png">';
              break;
            case 6:
              echo '<img class="cont" src="../images/6.png">';
              break;
            case 7:
              echo '<img class="cont" src="../images/7.png">';
              break;
            case 8:
              echo '<img class="cont" src="../images/8.png">';
              break;
            case 9:
              echo '<img class="cont" src="../images/9.png">';
              break;
            default:
              echo '<img class="cont" src="../images/10.png">';
              break;
      }

           
                     
           echo '<tr><td colspan="4" style="height:10px"><span>'.date("d/m/Y").'</span></td></tr>';
           echo '<tr><td colspan="4"><input type="text" readonly="true" id="txtRelogio"></td></tr>';
           echo '<tr><td colspan="4" style="padding-top:20px;"><b>Atrasos</b></td></tr>';
           echo '<tr><td>Funcionário</td><td>Tipo</td><td>Hora</td><td>Tempo de atraso</td></tr>';
           $title = 'Clique para justificar o atraso';
           for($aux = 0; $aux < count($array); $aux++){
              if($array[$aux][5] == 0){
                 echo '<tr>';
                   echo '<td class="rows-content"><a title="'.$title.'" href="logado.php?id_horario='.$array[$aux][0].'"><b>'.$array[$aux][3].'</b></a></td><td class="rows-content"><a title="'.$title.'" href="logado.php?id_horario='.$array[$aux][0].'"><b>'.$array[$aux][4].'</b></a></td><td class="rows-content"><a title="'.$title.'" href="logado.php?id_horario='.$array[$aux][0].'"><b>'.$array[$aux][1] .'</b></a></td><td class="rows-content"> <a title="'.$title.'" href="logado.php?id_horario='.$array[$aux][0].'"><b>'. $array[$aux][2].'</b></a></td>';
                 echo '</tr>';
              }else{
                 echo '<tr>';
                   echo '<td class="rows-content">'.$array[$aux][3].'</td><td class="rows-content">'.$array[$aux][4].'</td><td class="rows-content">'.$array[$aux][1] .'</td><td class="rows-content"> '. $array[$aux][2].'</td>';
                 echo '</tr>';
              }
           }
           if(count($array) > 0){
              echo '<tr><td colspan="4" style="text-align: right; padding-top: 5px; color:#555; font-size: 12px;">Clique para justificar o atraso </td></tr>';
           }else{
              echo '<tr><td colspan="4" style="padding-top: 15px; color:#555; font-size: 12px;">Nenhum horário registrado!</td></tr>';
           }
           echo '</table>';
      }
?>