<ul class="menu-list">  
    <li><a href='../administrator/principal.php'>Início</a></li>
    <li>
      <a>Cadastrar</a>
       <ul class="sub-menu">
        <li><a href="#myPop" data-rel="popup" class="ui-btn ui-btn-inline ui-corner-all">Cliente</a></li>
        <li><a href="nada">abrir teste</a></li>
        <li><a href="teste">Nova Janela de Exemplo</a></li>
        <li><a href="add_turno.php">Turno</a></li>
        <li><a href="add_cbo.php">CBO</a></li>
        <li><a href="add_exames.php">Exames</a></li>
      </ul>
    </li>
    <li>
      <a>Pesquisar</a>
       <ul class="sub-menu">
        <li><a href="pesquisa_func.php">Funcionário</a></li>
        <li><a href="pesquisa_empresa.php">Empresa</a></li>
        <li><a href="pesquisa_turno.php">Turno</a></li>
        <li><a href="pesquisa_cbo.php">CBO</a></li>
      </ul>
    </li>
    <li><a href="define_relatorio.php">Relatórios</a></li>
    <li><a href="configuracoes.php">Configurações</a></li>
    <li><?php
        echo '<a href="?logout=sim">SAIR</a>';
        if($_GET["logout"]=="sim"){
          session_destroy();
          header("login_form.php");
        }
       ?>
</ul>

