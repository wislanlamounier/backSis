<?php
//nivel_acesso
// 0 = Acesso Total
// 1 = Acesso ViaCampos
// 2 = Acesso ControlPonto


// if($_SESSION['nivel_acesso'] == 0 || $_SESSION['nivel_acesso'] == 1){

// }

include_once("../model/class_sql.php");
include_once("../global.php");



  $sql = new Sql();
  $sql->conn_bd();
  $g = new Glob();

  $query = "SELECT * FROM funcionario WHERE  id='%s' AND is_admin ='1' AND senha ='%s'";

  $userbusca = $g->tratar_query($query,$_POST["id"], $_POST["pass"]);
  // $userbusca vai receber a qt de linhas que tem essa busca 
    if(mysql_num_rows($userbusca) == 1 ){
        session_start(); // inicia sessão
       

        $row = mysql_fetch_array($userbusca);

        $query = "SELECT * FROM empresa WHERE  id='%s'";

        $result = $g->tratar_query($query, $row['id_empresa']);

        $empresa = mysql_fetch_array($result);


        $_SESSION["id"] = $_POST['id']; // nomeia id da sessão
        $_SESSION["senha"] = $_POST['pass']; // '''' nome da sessão
        $_SESSION["user"] = $row['nome'];
        $_SESSION['id_empresa'] = $empresa['id'];
        $_SESSION['empresa'] = $empresa['nome_fantasia'];

        $_SESSION['nivel_acesso'] = $empresa['nivel_acesso'];
        header("location:principal.php"); // pagina que sera redirecionada após login

    }else{
      header("location:index.php"."?falho");
    }
 ?>