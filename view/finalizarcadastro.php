<?php 
	if($_SESSION['nivel_acesso'] == 0){
		$nivel_acesso = "Acesso Total";
	}else if($_SESSION['nivel_acesso'] == 1){
		$nivel_acesso = "Acesso ViaCampos";
	}else{
		$nivel_acesso = "Acesso ControlPonto";
	}
 ?>
 <script type="text/javascript">
 	function submitForm(form){

 		var url = 'reportMailError.php?pag='+form[0].value+'&descricao='+form[1].value; 
 		$.get(url, function(dataReturn) {
            alert("Erro reportado com sucesso, Obrigado");
            document.getElementById("back-popup").style.display = "none";
        	document.getElementById("popup-erro").style.marginLeft = "-600px";
        });

 </script>

	<!-- Janela do topo referente a empresa -->
	<div id="box-login1" class="box-login" style="background-color: rgba(255, 0, 0, 0.7)">
		<div style="float:left"><img src="../images/user.png" width="40px"></div>
        <div class="nome-box-login"> <?php 
        $id_empresa = $_SESSION['id_empresa'];

        $empresa = new Empresa();
        $empresa = $empresa->get_empresa_by_id($id_empresa);
                     
                $i = 0; 
                foreach ($empresa as $key => $value) {

                    if($value == "" or $value==0){
                        
                        if($key == "ins_estadual"){
                             echo '<br>'.$key;
                            $i++;
                        }
                        if($key == "ins_municipal"){
                             echo '<br>'.$key;
                             $i++;
                        }
                        if($key == "id_endereco"){
                            echo '<br>'.$key;
                             $i++;
                        }               
                    }
                }
        if ($i == 0){            
            echo '<script> desabilitaDiv1()</script>';
                    }
        echo 'Você tem '.$i.' dados importantes para serem cadastrados.';


        ?></div>
		<!-- <div class="nome-box-login" style=""><span style="">Lucas voce precisa completar seu cadastro para poder usar todas funções do sofware:<br /></span><?php echo $_SESSION["user"]; ?><br /><span style="">Empresa:<br /></span><?php echo $_SESSION['empresa']."<span> (".$nivel_acesso.")</span>" ?></div> -->
		<div style="float:right;"><a title="Clique para sair" <?php echo 'href="http://localhost/viacampos/administrator/add_empresa.php?tipo=editar&id='.$id_empresa.'"' ?>><img src="../images/ir.png" width="20px"></a></div>
	</div>


    <!-- janela do topo referente ao usuario -->
    <div id="box-login2" class="box-login" style="background-color: rgba(255, 0, 0, 0.7)">
        <div style="float:left"><img src="../images/user.png" width="40px"></div>
        <div class="nome-box-login" style=""> <?php 
        
        $id_funcionario = $_SESSION['id_funcionario'];
        $func = new Funcionario();

        $func = $func->get_func_id($id_funcionario);
       
        $i = 0;
        
       
        foreach ($func as $key => $value) {
            if(!isset($value) or $value==0){
                
                
                if($key == "rg"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                if($key == "id_endereco"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                if($key == "data_nasc"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                         
                if($key == "id_cbo"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                if($key == "id_endereco"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                if($key == "id_turno"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                
                if($key == "salario_base"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                if($key == "data_adm"){
                    echo '<br>'.$key;
                     $i = $i +1;
                }
                if($key == "cod_serie"){

                    if($value !=""){
                        $i = $i +0;
                    }else{
                        $i = $i +1;
                    }
                }
            }
        }

        echo 'Você tem '.$i.' dados importantes para serem cadastrados.';
          if ($i == 0){
            echo '<script> desabilitaDiv2()</script>';
                    }
        ?></div><br>

        <div style="float:right;"><span style='float:left; margin-top:2px;'>Cadastrar  </span><a style="float:left; margin-left:10px;"title="Clique para sair" <?php echo 'href="http://localhost/viacampos/administrator/add_func.php?tipo=editar&id='.$id_funcionario.'"' ?>><img src="../images/ir.png" width="20px"></a></div>
    
    </div>



