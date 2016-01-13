<?php

include("restrito.php"); 

include_once("../model/class_sql.php");
include_once("../model/class_grupo_bd.php");
include_once("../model/class_maquinario_bd.php");
include_once("../model/class_veiculo_bd.php");
include_once("../model/class_patrimonio_geral_bd.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_produto_bd.php");
include_once("../model/class_cbo_bd.php");
include_once("../model/class_estado_bd.php");
include_once("../includes/functions.php");
include_once("../includes/util.php");
include_once("../model/class_regiao_bd.php");
include_once("../model/class_obra.php");
?>

<html>
<?php  Functions::getHead('Exibir Obras'); //busca <head></head> da pagina, $title é o titulo da pagina ?>

<?php  Functions::getScriptVisualizarObra(); ?>

<body>
    <?php include_once("../view/topo.php"); ?>
    <div class="formulario" style="width:43%; min-width:600px;" id="form_obra">
        <div class="title-box" style="float:left; width:100%"><div style="float:left"><img src="../images/ico-obra.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px;"><span class="title">EXIBIR OBRAS</span></div></div>
         <div class="desc-bloco">
             <span>Selecione a Obra </span>
         </div>
         <div class="body-bloco">
            <form>
                 <div class="form-input">
                     <div class="form-input">
                         <span><b>Nome: </b></span><input type="text" placeholder="Digite para pesquisar..." id="nome" style="width:50%"> <input type="button" value="Buscar" onclick="buscarClientes('0',this.value)">
                         <span><b>Agrupar por: </b></span>
                         <select style="width:100px" onchange="buscarClientes('1',this.value)">
                            <option value="100">Selecione</option>
                            <option value="0">Orçamento</option>
                            <option value="1">Aprovadas</option>
                            <option value="2">Canceladas</option>
                            <option value="3">Em execução</option>
                            <option value="4">Finalizadas</option>
                         </select>
                     </div>
                     <div class="form-input" id="form-input-select" style="border: 1px solid#bbb; ">
                         <table class="table_geral">
                            <tr class="tr-cabecalho">
                                <?php if(isset($_GET['id'])){ ?>
                                <?php 
                                        $obra = Obra::getObraId($_GET['id']); 
                                        echo "<td>ID</td><td>NOME</td><td>DESCRIÇÃO</td><td>STATUS</td></tr>";
                                        echo "<td><span><a href='visualizar_obras?id=".$obra->id."' value='{$obra->id}' style='width:100%'>{$obra->id}</a></span></td><td><span><a href='visualizar_obras?id=".$obra->id."' value='{$obra->id}' 
                                              style='width:100%'>{$obra->nome}</a></span></td><td><span><a href='visualizar_obras?id=".$obra->id."' value='{$obra->id}' style='width:100%' title='$obra->descricao'>";
                                        echo  substr($obra->descricao,0,70); (strlen($obra->descricao) > 70) ? print '...' : ''; echo "</a></span></td>";
                                        echo "<td><a href='visualizar_obras?id=".$obra->id."' value='{$obra->id}' style='width:100%'><span>".Obra::getStatus($obra->status)."</span></a></td>";
                                ?>

                                <?php }else{ ?>
                                            <td>Busque uma obra</td>
                                <?php } ?>


                            </tr>
                        </table>
                     </div>
                     <div class="form-input">
                         <span style="color:#787878; font-size:12px;">(Clique para selecionar)</span>
                     </div>
                 </div>
                   
                 <div class="form-input" style="margin: 10px; text-align:center;  width:97%">
                    <!-- <input type="button"  onclick="javascript:window.history.back()" class="voltar" value="Voltar"> --> <input class="button" type="button" value="Cancelar">
                 </div>
             </form>    
         </div>

    </div>
    <div class="formulario" style="width:43%; min-width:600px;" id="form_obra">
        <div class="title-box" style="text-align:center;float:left; width:100%"><div style="float:left; width:100%; margin-top:10px; margin-bottom:10px; margin-left:10px;"><span class="title"><b>DETALHES DA OBRA</b></span></div></div>
        <div class="body-bloco">
            <form>
                <?php 
                    if(isset($_GET['id'])){
                        $id_obra = $_GET['id'];
                        $dados_obra = Obra::getObraId($id_obra);
                        $produtos_obra = 1;
                        $patrimoniosGerais_obra = 1;
                        $veiculos_obra = 1;
                        $maquinarios_obra = 1;

                        foreach ($dados_obra as $key => $value) {
                            echo "$key : $value<br />";
                        }
                    }
                        
                 ?>
                 
            </form>    
         </div>
    </div>
</body>
</html>
