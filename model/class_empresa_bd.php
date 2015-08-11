<?php 

include_once("class_sql.php");
require_once(dirname(__FILE__) . "/../global.php");
include_once("class_cidade_bd.php");
include_once("class_funcionario_bd.php");

class Empresa{
    public $id;
    public $cnpj;
    public $razao_social;
    public $nome_fantasia;
    public $ins_estadual;
    public $ins_municipal;
    public $id_endereco;
    public $telefone;
    public $id_responsavel;


    public function add_empresa($cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal,  $telefone, $id_responsavel, $id_endereco){
          $this->cnpj = $cnpj;
          $this->razao_social = $razao_social;
          $this->nome_fantasia = $nome_fantasia;
          $this->ins_estadual = $ins_estadual;
          $this->ins_municipal = $ins_municipal;
          $this->id_endereco = $id_endereco;
          $this->telefone = $telefone;
          $this->id_responsavel = $id_responsavel;
    }

    public function add_empresa_bd($cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal,  $telefone, $id_responsavel, $id_endereco){
          $sql = new Sql();
          $sql->conn_bd();
          $g = new Glob();

          $query = "INSERT INTO empresa (cnpj, razao_social, nome_fantasia, ins_estadual, ins_municipal, telefone, id_responsavel, id_endereco) VALUES ('%s','%s','%s','%s','%s','%s','%s','%s')";
          if($g->tratar_query($query, $this->cnpj, $this->razao_social, $this->nome_fantasia, $this->ins_estadual, $this->ins_municipal,  $this->telefone, $this->id_responsavel, $this->id_endereco)){
            return true;
          }else{
            return false;
          }
    }
    public function get_all_empresa(){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        $aux=0;
      
        $query = $g->tratar_query("SELECT * FROM empresa WHERE oculto = 0");

        while($result = mysql_fetch_array($query)){
          $return[$aux][0] = $result['id'];
          $return[$aux][1] = $result['cnpj'];
          $return[$aux][2] = $result['nome_fantasia'];
          $aux++;
        }
        return $return;
        
    }
    public function get_empresa_by_nome_fantasia($nome){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        $aux=0;
        $return = array();
        $query = $g->tratar_query("SELECT * FROM empresa WHERE oculto = 0 && nome_fantasia LIKE '%%%s%%'", $nome);

        while($result = mysql_fetch_array($query)){
          $return[$aux][0] = $result['id'];
          $return[$aux][1] = $result['cnpj'];
          $return[$aux][2] = $result['nome_fantasia'];
          $aux++;
        }
        return $return;
    }

    public function atualiza_empresa($id, $cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal, $telefone, $id_responsavel, $id_endereco){
       $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();

        $query = "UPDATE empresa SET cnpj = '%s', razao_social = '%s', nome_fantasia = '%s', ins_estadual = '%s', ins_municipal = '%s', telefone = '%s', id_responsavel = '%s', id_endereco = '%s' WHERE id = '%s'";

        if($g->tratar_query($query, $cnpj, $razao_social, $nome_fantasia, $ins_estadual, $ins_municipal, $telefone, $id_responsavel, $id_endereco, $id)){
            return true;
        }else{
          return false;
        }
    }

    public function get_empresa_by_cnpj($cnpj){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        
        $query = $g->tratar_query("SELECT * FROM empresa WHERE oculto = 0 && cnpj = '%s'", $cnpj);

        if(@mysql_num_rows($query) == 0){
            return false;
       }else{

          $row = mysql_fetch_array($query, MYSQL_ASSOC);
          $this->id = $row['id'];
          $this->cnpj = $row['cnpj'];
          $this->razao_social = $row['razao_social'];
          $this->nome_fantasia = $row['nome_fantasia'];
          $this->ins_estadual = $row['ins_estadual'];
          $this->ins_municipal = $row['ins_municipal'];
          $this->id_endereco = $row['id_endereco'];
          $this->telefone = $row['telefone'];
          $this->id_responsavel = $row['id_responsavel'];

          return $this;
       }
    }

    public function get_empresa_by_id($id){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();
        
        $query = $g->tratar_query("SELECT * FROM empresa WHERE oculto = 0 && id = '%s'", $id);

        if(@mysql_num_rows($query) == 0){
            return false;
       }else{
          $row = mysql_fetch_array($query, MYSQL_ASSOC);
          $this->id = $row['id'];
          $this->cnpj = $row['cnpj'];
          $this->razao_social = $row['razao_social'];
          $this->nome_fantasia = $row['nome_fantasia'];
          $this->ins_estadual = $row['ins_estadual'];
          $this->ins_municipal = $row['ins_municipal'];
          $this->id_endereco = $row['id_endereco'];
          $this->telefone = $row['telefone'];
          $this->id_responsavel = $row['id_responsavel'];

          return $this;
       }
    }

    public function ocultar(){
        $sql = new Sql();
        $sql->conn_bd();
        $g = new Glob();

        if($g->tratar_query("UPDATE empresa SET oculto = 1 WHERE id = '%s'", $this->id)){
          return true;
        }else{
          return false;
        }
    }



    public function printEmpresa(){
      
      $filial = new Filial();
      $filiais = $filial->get_filial_by_empresa($this->id);
      $endereco = new Endereco();
      $endereco = $endereco->get_endereco($this->id_endereco);
      $cidade = new Cidade();
      $city = $cidade->get_city_by_id($endereco[0][2]);
      $string_endereco = "Rua ".$endereco[0][0].", Nº ".$endereco[0][1]." - ".$city->nome;
      $responsavel = new Funcionario();
      $responsavel = $responsavel->get_func_id($this->id_responsavel);
      $texto ='';
      $texto .= "<table class='table_pesquisa'>
        <tr>
          <td><b>ID</b></td>
          <td>$this->id</td>
        </tr>
        <tr>
          <td><b>CNPJ</b></td>
          <td>$this->cnpj</td>
        </tr>
        <tr>
          <td><b>Razão Social</b></td>
          <td>$this->razao_social</td>
        </tr>
        <tr>
          <td><b>Nome Fantasia</b></td>
          <td>$this->nome_fantasia</td>
        </tr>
        <tr>
          <td><b>Ins. Estadual</b></td>
          <td>$this->ins_estadual</td>
        </tr>
        <tr>
          <td><b>Ins. Municipal</b></td>
          <td>$this->ins_municipal</td>
        </tr>
        <tr>
          <td><b>Endereço</b></td>
          <td>$string_endereco</td>
        </tr>
        <tr>
          <td><b>Telefone</b></td>
          <td>$this->telefone</td>
        </tr>
        <tr>
          <td><b>Responsável</b></td>
          <td>$responsavel->nome</td>
        </tr>";

        if(count($filiais) > 0){
            $texto .=  "<tr>
                      <td><b>Filiais</b></td>
                    <tr>";
            foreach ($filiais as $key => $filial) {
                $texto .= '<tr>';
                $texto .= "<td colspan='2' style='padding-left:20px;'>".$filiais[$key][1]." - ".$filiais[$key][2]."</td>";
                $texto .= '</tr>';
        }
        }
        
        

        $texto .= "</table>";

    
      return $texto;
    }
}

 ?>