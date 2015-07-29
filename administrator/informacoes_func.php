<?php

include_once("../model/class_funcionario_bd.php");

?>
<script type="text/javascript" language="javascript" src="../javascript/jquery-2.1.4.min.js"></script>
<script type="text/javascript">
	function buscar_funcionarios(id_funcionario){
         
      
		alert("chamou");
      //se encontrou o estado
      if(id_funcionario){
      	alert("entrou");
        var url = 'ajax_buscar_informacoes.php?id_funcionario='+id_funcionario;  //caminho do arquivo php que irá buscar as cidades no BD

        $.get(url, function(dataReturn) {
        	alert("entrou2");
          $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
        });
      }
    }
    function buscar_editar(tipo){
        var url = 'ajax_editar.php?tipo='+tipo;  //caminho do arquivo php que irá buscar as cidades no BD

        $.get(url, function(dataReturn) {
        	$('#result').html(dataReturn);  //coloco na div o retorno da requisicao
        });
      
    }
</script>

<div class="formulario">
		
	<input type="button" class="button add" value="Editar" onclick="buscar_editar('1')"><input type="button" class="button exc" value="Excluir" onclick="buscar_editar('2')"><input type="button" class="button pes" value="Pesquisar" onclick="buscar_editar('3')">
	<div id="result">
	</div>
</div>