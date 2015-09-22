<script type="text/javascript">
    function expand(id_obg, id_btn){
        if(document.getElementById(id_obg).className == 'colapse'){
            // document.getElementById(id_obg).style.display = 'none';
            document.getElementById(id_obg).className = 'expand';
            document.getElementById(id_btn).text = '(Ocultar)';
        }else{
            // document.getElementById(id_obg).style.display = 'block';
            document.getElementById(id_obg).className = 'colapse';
            document.getElementById(id_btn).text = '(Expandir)';
        }
        
    }

</script>
<?php 

$funcionario = new Funcionario(); 
    $funcionario = $funcionario->get_historico_func_by_id($_GET['id']); // Busca de todos os funcionarios que estao com oculto = 1\\
    if($funcionario){// se existe historico exibe
 ?>

        <div style="float:left; margin-left: 10px; width:40%;">
            <div style="float:left; width:100%;" class="historico" id="historico">
            <div style="float:left; clear:left; width: 98.5%; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; background:url('../images/footer_lodyas.png'); margin-bottom:5px; box-shadow: 0px 0px 5px #ababab; text-align:center; color:#cdcdcd; border-radius:5px;"><b><span>HISTÓRICO DE ATUALIZAÇÕES</span></b></div>
            <?php
                $aux = 0;
                foreach ($funcionario as $key => $alterados) {  // Percorre o array de funcionario 
                    
                    ?>
                            <?php
                            
                            $turno = new Turno();
                            $turno = $turno->getTurnoById($alterados[10]);
                            $cbo = new CBO();
                            $cbo = $cbo->get_cbo_by_id($alterados[5]);
                            
                            if($alterados[11] == 1) // logica para imprimir administrador
                            {
                                $adm = "SIM";
                            }else{
                                $adm = "NÃO";
                            }
                              
                            $data = explode('-', $alterados[8]);
                            $data = $data[2].'/'.$data[1].'/'.$data[0];
                                   
                            ?>
                        
                           
                            <div style="float:left; clear:left; width: 98.5%; padding-left: 10px; padding-bottom: 10px; padding-top: 10px; background-color:rgba(217,219,219,0.5); margin-bottom:5px; box-shadow: 0px 0px 5px #ababab"> <div style="float:left; width: 30%; font-size:15px;" ><b>Data da atualização</b></div> <div style="float:left; font-size:15px;"><b><?php echo $data ?> </b></div> <div style="float:left; font-size:15px; margin-left:20px;"><b> <a id="<?php echo 'btn'.$aux ?>" name="<?php echo 'exp'.$aux ?>" onclick="expand(this.name, this.id)" style="cursor:pointer"> (Expandir)</a></b></div></div>
                            <div class="colapse" id="<?php echo 'exp'.$aux ?>" >
                                    <div class="historico-itens"> <div style="float:left; width: 35%;"><span><b>Salario Base</b></span></div>                    <div style="float:left"><span><?php echo $alterados[3].",00"; ?></span></div></div>               
                                    <div class="historico-itens"> <div style="float:left; width: 35%;"><span><b>Turno</b></span></div>                           <div style="float:left"><span><?php echo $turno->nome; ?></span></div></div>
                                    <div class="historico-itens"> <div style="float:left; width: 35%;"><span><b>CBO</b></span></div>                             <div style="float:left"><span><?php echo $cbo->descricao; ?></span></div></div>
                                    <div class="historico-itens"> <div style="float:left; width: 35%;"><span><b>Administrador</b></span></div>                   <div style="float:left"><span><?php echo $adm; ?></span></div></div>
                                    <div class="historico-itens"> <div style="float:left; width: 35%;"><span><b>Jornada de trabalho(semanal)</b></span></div>    <div style="float:left"><span><?php echo $alterados[7]." Horas" ?> </span></div></div>
                                    <div class="historico-itens"> <div style="float:left; width: 35%;"><span><b>Email</b></span></div>                           <div style="float:left"><span><?php echo $alterados[12] ?></span></div></div>
                            </div>
                    
                    
          <?php $aux++;
             } ?>
                
            </div>
        </div>
<?php } // fim if($funcionario)?>
