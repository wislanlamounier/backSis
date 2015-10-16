<?php
include_once("../model/class_sql.php");
require_once("../global.php");

class Custo_regiao{
    public $id;
    public $id_material;
    public $id_valor_custo;
    public $id_cidade;
    public $id_estado;
    public $id_empresa;
    
    public function add_custo_regiao($id_material, $id_valor_custo, $id_cidade, $id_estado, $id_empresa){
        $this->id_material = $id_material;
        $this->id_valor_custo = $id_valor_custo;
        $this->id_cidade = $id_cidade;
        $this->id_estado = $id_estado;
        $this->id_empresa = $id_empresa;
    }
    
    public function add_custo_regiao_bd(){
	$sql = new Sql();
	$sql->conn_bd();
	$g = new Glob(); 
        $query = "INSERT INTO custo_regiao (id_material, id_valor_custo, id_cidade, id_estado, id_empresa)
                 VALUES ('%s','%s','%s','%s','%s')";
        if($g->tratar_query($query, $this->id_material, $this->id_valor_custo, $this->id_cidade, $this->id_estado, $this->id_empresa )){
            return true;
        }else{
            return false;
        }                    
    }
    
   
        public function get_valor_regiao($id_material, $id_cidade, $id_empresa){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$aux=0;
		$query = "SELECT * FROM custo_regiao WHERE id_material = '%s' && id_cidade = '%s' && id_empresa = '%s'";
		$query_tra = $g->tratar_query($query, $id_material, $id_cidade, $id_empresa);
		if($query_tra)
			while($result =  mysql_fetch_array($query_tra)){
				$return[$aux][0] = $result['id_valor_custo'];
				$aux++;
			}
		if($aux == 0){
			$sql->close_conn();
			echo '';
		}else{
			$sql->close_conn();
			return $return;
		}
            }

        }

    

?>