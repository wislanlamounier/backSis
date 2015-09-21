<?php 
    @session_start();
    if(isset($_SESSION["id"]) && isset($_SESSION["user"]) && isset($_SESSION["id_empresa"])){
    }else{
      header("location:index.php?falha=session");
    }

 ?>