
<div style="float:left; margin-left: 10px; width:49%;">
    <div style="float:left; width:100%;" class="historico" id="historico">
    <?php
    
    $funcionario = new Funcionario(); 
    $funcionario = $funcionario->get_historico_func_by_id($_GET['id']); // Busca de todos os funcionarios que estao com oculto = 1\\
    
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
                    $adm = "nao";
                }
                  
                       
                ?>
            
               
                <div style="float:left; clear:left; width: 100%; padding-bottom: 5px; padding-top: 20px;"> <div style="float:left; width: 50%;" ><b>Data de atualização</b></div> <div style="float:left"><b><?php echo $alterados[8] ?> </b></div></div>
                
                <div class="historico-itens"> <div style="float:left; width: 50%;"><span><b>Salario Base</b></span></div>                    <div style="float:left"><span><?php echo $alterados[3].",00"; ?></span></div></div>               
                <div class="historico-itens"> <div style="float:left; width: 50%;"><span><b>Turno</b></span></div>                           <div style="float:left"><span><?php echo $turno->nome; ?></span></div></div>
                <div class="historico-itens"> <div style="float:left; width: 50%;"><span><b>CBO</b></span></div>                             <div style="float:left"><span><?php echo $cbo->descricao; ?></span></div></div>
                <div class="historico-itens"> <div style="float:left; width: 50%;"><span><b>Administrador</b></span></div>                   <div style="float:left"><span><?php echo $adm; ?></span></div></div>
                <div class="historico-itens"> <div style="float:left; width: 50%;"><span><b>Jornada de trabalho(semanal)</b></span></div>    <div style="float:left"><span><?php echo $alterados[7]." Horas" ?> </span></div></div>
                <div class="historico-itens"> <div style="float:left; width: 50%;"><span><b>Email</b></span></div>                           <div style="float:left"><span><?php echo $alterados[12] ?></span></div></div>
             
        
        
        <?php    
        
          
    }
    
    
    ?>
        
    </div>
</div>