<?php
session_start();
include_once("../model/class_sql.php");
include_once("../model/class_material_bd.php");
include_once("../model/class_produto_bd.php");
include_once("../model/class_unidade_medida_bd.php");


	$sql = new Sql();
	$sql->conn_bd();
	$acao = isset($_GET['acao']) ? $_GET['acao']:null;
	if(isset($_GET['id_produto'])){// pega e exibe os materiais desse produto
		$id_produto = $_GET['id_produto'];
		$produto = Produto::get_produto_id($id_produto);
		$materiais = Produto::get_materiais_produto($produto->id);

		echo '<div class="formulario" style="width:300px;">
           <table style="width:100%; text-align:center;" border="0">
              <input type="hidden" id="id_banco" name="id_banco" value="<?php echo $banco->id ?>">
              <tr><td colspan="2"><b>Materiais usados para '.$produto->nome.'</b></td></tr>';
              echo '<tr><td><b>Nome</b></td><td><b>Quantidade</b></td></tr>';
              for($aux = 0; $aux < count($materiais); $aux++){
              	$id_material = explode(':', $materiais[$aux][1]);
              	if($id_material[1] == 'm'){//buscar materiais
					$res = Material::get_material_id($id_material[0]);
					$uni = new Unidade_medida();
					$uni = $uni->get_unidade_medida_by_id($res->id_unidade_medida);
				}else if($id_material[1] == 'p'){// buscar produtos
					$res = Produto::get_produto_id($id_material[0]);
				}
              	
              	if($aux%2==0)// para tabela ficar zebrada
			               echo '<tr style="background-color:#ccc;">';
			        else
			               echo '<tr style="background-color:#ddd;">';

              	echo '<td >'.$res->nome.'</td><td>'.$materiais[$aux][2].' '.( isset($uni) ?$uni->sigla:'').'</td></tr>';
              }
        echo '<tr><td colspan="2"><input onclick="fechar()" type="button"  class="button" value="Concluir" ></td></tr>
            </table>
         </div>';
	}else{
		$nome = $_GET['nome'];  //codigo do estado passado por parametro
		$tipo = $_GET['tipo'];
		if($tipo == 'm')//buscar materiais
			$res = Material::get_material_by_name($nome);
		else if($tipo == 'p')// buscar produtos
			$res = Produto::get_produto_by_name($nome);	
		?>

		<?php if($res){ ?>
			<select name="clientes" id="clientes" size='10' style="height: 100%; width: 100%" onDblClick="selecionaProduto(this.value,'<?php echo $acao ?>')">
			  <?php
			  	if($res) 
				   for($aux = 0; $aux < count($res); $aux++){
				   		if($tipo == 'm')//exibe materiais
				      		echo "<option value='m:".$res[$aux][0]."'>".$res[$aux][1]."</option>";
				      	else if($tipo == 'p')// exibe produtos
				     		echo "<option value='p:".$res[$aux][0]."'>".$res[$aux][1]."</option>";
				  	}
			?>
				
			</select>
	<?php } // fim if($res)
	}//fim else ?>