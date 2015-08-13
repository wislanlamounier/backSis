<ul class="menu-list">  
    <li style="border-left: 1px solid#565656;"><a href='../administrator/principal.php'>Início</a></li>
    <li>
      <!-- color:#000; text-shadow: 0px 0px 5px #000; font-size: 13px; padding-left:3px;padding-right:3px; background-color:rgba(255,255,255,0.5) -->
      <a style=""><span style="float:left">Cadastrar </span><img style="float:left; margin-top:-2px; margin-left:2px;" src="../images/downarrow_1246.png" width="15px;"></a>
       <ul class="sub-menu">
        <li><a href="add_func.php">Funcionário</a></li>
        <?php if($_SESSION['nivel_acesso'] == 0 || $_SESSION['nivel_acesso'] == 1){ ?>
                  <li><a href="add_cliente.php">Cliente</a></li>
                  <li><a href="add_epi.php">Equipamentos</a></li>                  
                  <li><a href="add_epiXfunc.php">Equipamentos por funcionario</a></li>
                  <li><a href="add_patrimonio.php">Patrimonio</a></li>
        <?php } ?>
        <li><a href="add_turno.php">Turno</a></li>
        <li><a href="add_cbo.php">CBO</a></li>
        <li><a href="add_exames.php">Exames</a></li>
        <li><a href="add_filial.php">Filial</a></li>
        <li><a href="add_empresa.php">Empresa</a></li>        
      </ul>
    </li>
    <li>
      <a style=""><span style="float:left">Pesquisar </span><img style="float:left; margin-left:2px; margin-top:-2px;" src="../images/downarrow_1246.png" width="15px;"></a>
       <ul class="sub-menu">
        <li><a href="pesquisa_func.php">Funcionário</a></li>
        <li><a href="pesquisa_empresa.php">Empresa</a></li>
        <li><a href="pesquisa_turno.php">Turno</a></li>
        <li><a href="pesquisa_cbo.php">CBO</a></li>
        <li><a href="pesquisa_cli.php">Cliente</a></li>
        <li><a href="pesquisa_filial.php">Filial</a></li>
        <li><a href="pesquisa_epi.php">EPI</a></li>
      </ul>
    </li>
    <li><a href="define_relatorio.php">Relatórios</a></li>
    <li><a href="configuracoes.php">Configurações</a></li>
</ul>

