<?php    // print_r($_SESSION['obra']['cliente']);
        $cliente = $_SESSION['obra']['cliente'];
       print_r($cliente);
        echo "<br>".$cliente['id_cli'];
        echo "<br>".$cliente['nome_cli'];
        echo "<br>".$cliente['cpf_cnpj_cli'];
        echo "<br>".$cliente['rua'];
        echo "<br>".$cliente['num'];
        echo "<br>".$cliente['telefone_com'];
?>
<div class="painel-controle" style="float:left; margin-top:20px;width:27%; border:1px solid;">
      <div class="title-box" style="float:left;width:100%"><div style="float:left"><img src="../images/user.png" width="35px" style="margin-left:5px;"></div><div style="float:left; margin-top:10px; margin-left:10px; width:35px"><span class="title">Cliente</span></div></div>
      <div>
        <div><span style="color: #676767;">Dados do cliente vinculado à obra</span></div>
        <div><span>Nome:</span><input type="text" id="nome" value="<?php echo $cliente['nome_cli']?>"></div>
      </div>
</div>