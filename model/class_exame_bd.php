<?php 
         
include_once("class_sql.php");
include_once("class_turno_bd.php");
require_once(dirname(__FILE__) . "/../global.php");

class Exame{
	public $id;
	public $descricao;
	public $id_periodicidade;
	
	public function add_exame($descricao, $id_periodicidade){
		$this->descricao = $descricao;
		$this->id_periodicidade = $id_periodicidade;
	}

	public function add_exame_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "INSERT INTO exames (descricao, id_periodicidade) VALUES ('%s','%s')";
		return $g->tratar_query($query, $this->descricao, $this->id_periodicidade);
	}
	public function get_exame_id($id){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $g = new Glob();

		 $query = "SELECT * FROM exames WHERE id = '%s'";
		 $result = $g->tratar_query($query, $id);
		 
		 if(@mysql_num_rows($result) == 0){
            echo 'Nenhum exame encontrado';
            return false;
	     }else{
	     	$row = mysql_fetch_array($result, MYSQL_ASSOC);
	     	$this->id = $row['id'];
	     	$this->descricao = $row['descricao'];
	     	$this->id_periodicidade = $row['id_periodicidade'];

	     	return $this;
	     }
	}

	public function atualiza_exame($descricao, $id_periodicidade, $id){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE exames SET descricao = '%s', id_periodicidade='%s' WHERE id = '%s' ";

		return $g->tratar_query($query, $descricao, $id_periodicidade, $id);
	}

	public function ocultar(){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE exames SET oculto = '1' WHERE id = '%s'";

		return $g->tratar_query($query, $this->id);
	}
	public function get_exame_by_desc($desc){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		
		$q = "SELECT * FROM exames WHERE descricao LIKE '%%%s%%' && oculto = 0 ORDER BY descricao";
		$query = $g->tratar_query($q, $desc);
		$aux = 0;
		while($result = mysql_fetch_array($query)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['descricao'];
			$aux++;
		}
		if($aux == 0){
			echo '<div class="msg">Nenhum registro encontrado</div>';
		}
		return $return;

	}
	public function get_name_all_exames(){
		$sql = new Sql();
		$sql->conn_bd();
		$aux=0;
		$query = mysql_query("SELECT * FROM exames");

		while($result = mysql_fetch_array($query)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['descricao'];
			$aux++;
		}
		return $return;
	}
	
	public function printExames(){
		$texto .= "Descricao: ".$this->descricao."<br />";
		$texto .= "id_periodicidade: ".$this->id_periodicidade."<br />";
		
		return $texto;
	}
	

}

 ?>