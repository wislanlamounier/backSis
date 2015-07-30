<div class="formulario">
	<?php if($_GET['tipo'] == 1){ ?>
		<form method="POST">
			<span>Digite um nome para editar:</span><br />
			<span>Nome: </span>
			<input type="text" id="nome_search" name="nome_search"><input type="button" value="Buscar" onclick="buscar_funcionarios()">
		</form>
	<?php }else if($_GET['tipo'] == 2){ ?>
		<form method="POST">
			<span>Digite um nome para excluir:</span><br />
			<span>Nome: </span>
			<input type="text" id="nome_search" name="nome_search"><input type="button" value="Buscar" onclick="buscar_funcionarios()">
		</form>	
	<?php }else{ ?>
		<form method="POST">
			<span>Digite um nome para  pesquisar:</span><br />
			<span>Nome: </span>
			<input type="text" id="nome_search" name="nome_search"><input type="button" value="Buscar" onclick="buscar_funcionarios()">
		</form>
	<?php } ?>
</div>