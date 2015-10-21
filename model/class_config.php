<?php
// echo '<script> alert("'.dirname(__FILE__).'"); </script>';
include_once(dirname(__FILE__)."/class_sql.php");
include_once("../global.php");

class Config{

  public $id;
  public $descricao;
  public $valor;

  public function get_config($desc){
    $sql = new Sql();
    $sql->conn_bd();
    $query = mysql_query("SELECT * FROM config");
      while($result = mysql_fetch_array($query)){
        if($result['descricao'] == $desc){
          $sql->close_conn();
          return $result['valor'];
        }
      }
  }
  public function atualizaConfig($campo, $valor){
    $sql = new Sql();
    $sql->conn_bd();
    $g = new Glob();
    $query = "UPDATE config SET valor = '%s' WHERE descricao = '$campo'";
    if($g->tratar_query($query, $valor)){
      $_SESSION['temp_limit_atraso'] = $valor;
      return true;
    }else{
      return false;
    }
    $sql->close_conn();

  }

}
?>