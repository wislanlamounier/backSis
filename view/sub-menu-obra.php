<?php 

$url = $_SERVER['PHP_SELF'];
echo $url;
$link = explode('/', $url);
?>
<div class="title-bloco">
  <ul class="menu_obra">
        <li ><a href="<?php echo $link[2] ?>?t=a_c_o">Cliente</a></li><li ><a href="add_obra?t=a_d_o">Dados da Obra</a></li><li><a href="add_obra?t=a_pr_o">Produtos</a></li><li><a href="add_obra?t=a_p_o">Patrimonios</a></li><li><a href="add_obra?t=a_f_o">Funcionários</a></li><li><a href="add_obra?t=a_cr_o">Cronograma</a></li>
    </ul>
</div>