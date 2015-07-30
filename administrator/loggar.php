<?php 
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
        $_SESSION["id"] = $_POST['id']; // nomeia id da sessão
        $_SESSION["senha"] = $_POST['pass']; // '''' nome da sessão
        $_SESSION["user"] = $row['nome'];
        header("location:principal.php"); // pagina que sera redirecionada após login

    }else{
      header("location:index.php"."?falho");
    }
 ?>