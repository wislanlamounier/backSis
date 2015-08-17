<?php 

include_once("class_sql.php");
require_once(dirname(__FILE__) . "/../global.php");

class Turno{
	public $id;
	public $nome;
	public $desc;
	public $ini_exp;
	public $ini_alm;
	public $fim_alm;
	public $fim_exp;

	public function cadTurno($nome, $desc, $ini_exp, $ini_alm, $fim_alm, $fim_exp){
		$this->nome = $nome;
		$this->desc = $desc;
		$this->ini_exp = $ini_exp;
		$this->ini_alm = $ini_alm;
		$this->fim_alm = $fim_alm;
		$this->fim_exp = $fim_exp;
	}
	
	public function add_turno_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		

		$query = "INSERT INTO turno (nome, descricao, ini_exp, ini_alm, fim_alm, fim_exp) VALUES ('%s','%s', '%s', '%s', '%s', '%s')";

		$g->tratar_query($query, $this->nome, $this->desc, $this->ini_exp, $this->ini_alm, $this->fim_alm, $this->fim_exp);
	}
	public function atualiza_turno($nome, $id, $descricao, $ini_exp, $ini_alm, $fim_alm, $fim_exp){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "UPDATE turno SET nome = '%s', descricao = '%s', ini_exp = '%s', ini_alm = '%s', fim_alm = '%s', fim_exp = '%s' WHERE id = '%s'";
		if($g->tratar_query($query, $nome, $descricao, $ini_exp, $ini_alm, $fim_alm, $fim_exp, $id)){
			return true;
		}else{
			return false;
		}
	}
	public function getTurno(){
		return $this;
	}
	public function getTurnoById($id_turno){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$return = array();

		$query = "SELECT * FROM turno WHERE id='%s' && oculto = 0";
		

		$result = $g->tratar_query($query, $id_turno);

		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		$this->id = $row['id'];
		$this->nome = $row['nome'];
		$this->desc = $row['descricao'];
		$this->ini_exp = $row['ini_exp'];
		$this->ini_alm = $row['ini_alm'];
		$this->fim_alm = $row['fim_alm'];
		$this->fim_exp = $row['fim_exp'];
		return $this;

	}
	public function getTurnoByName($name){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$return = array();
		$query = "SELECT * FROM turno WHERE nome LIKE '%%%s%%' && oculto = 0 && NOT EXISTS (SELECT id FROM funcionario WHERE id_turno = turno.id)";

		$aux=0;
		$result = $g->tratar_query($query, $name);
		// echo '<script> alert("teste");</script>';	
		while($row = mysql_fetch_array($result)){
			// echo '<script> alert("'.$row['descricao'].'");</script>';
			$return[$aux][0] = $row['id'];
			$return[$aux][1] = $row['nome'];
			$return[$aux][2] = $row['descricao'];
			$return[$aux][3] = $row['ini_exp'];
			$return[$aux][4] = $row['ini_alm'];
			$return[$aux][5] = $row['fim_alm'];
			$return[$aux][6] = $row['fim_exp'];
			
			$aux++;

		}

		return $return;

	}
	public function getTurnoBy($name, $param){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$return = array();
		if($param == 1){//ini expediente
			$query = "SELECT * FROM turno WHERE ini_exp LIKE '%%%s%%' && oculto = 0";
		}else if($param == 2){//inicio almoco
			$query = "SELECT * FROM turno WHERE ini_alm LIKE '%%%s%%' && oculto = 0";
		}else if($param == 3){//fim almoco
			$query = "SELECT * FROM turno WHERE fim_alm LIKE '%%%s%%' && oculto = 0";
		}else if($param == 4){//fim expediente
			$query = "SELECT * FROM turno WHERE fim_exp LIKE '%%%s%%' && oculto = 0";
		}

		$aux=0;
		$result = $g->tratar_query($query, $name);
		// echo '<script> alert("teste");</script>';	
		while($row = mysql_fetch_array($result)){
			// echo '<script> alert("'.$row['descricao'].'");</script>';
			$return[$aux][0] = $row['id'];
			$return[$aux][1] = $row['nome'];
			$return[$aux][2] = $row['descricao'];
			$return[$aux][3] = $row['ini_exp'];
			$return[$aux][4] = $row['ini_alm'];
			$return[$aux][5] = $row['fim_alm'];
			$return[$aux][6] = $row['fim_exp'];
			$aux++;
		}

		return $return;

	}
	public function ocultar(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE turno SET oculto = 1 WHERE id = %s";
		
		$result = $g->tratar_query($query, $this->id);
		if($result){
			echo '<div class="msg">Turno excluido com sucesso!</div>';
		}
	}
	public function get_name_all_turno_disponiveis(){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $return = array();
		 $aux=0;

		 //"SELECT * FROM turno as turno WHERE nome LIKE '%%%s%%' && oculto = 0 && NOT EXISTS (SELECT id FROM funcionario WHERE id_turno = turno.id)";

		 $query = mysql_query("SELECT * FROM turno as turno WHERE oculto = 0 && NOT EXISTS (SELECT id FROM funcionario WHERE id_turno = turno.id)");
		 
		 while($result =  mysql_fetch_array($query)){
		 	$return[$aux][0] = $result['id'];
		 	$return[$aux][1] = $result['descricao'];
		 	$return[$aux][2] = $result['nome'];
		 	$aux++;
		 }
		 if($aux == 0){
		 	//target="_blank|_self|_parent|_top|framename"
		 	echo '<div class="msg">Nenhum turno encontrado! <a target="_blank" href="add_turno.php"> Cadastre agora</a></div>';
		 }
		 
		 return $return;
	}
	public function get_name_all_turno(){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $return = array();
		 $aux=0;

		 //"SELECT * FROM turno as turno WHERE nome LIKE '%%%s%%' && oculto = 0 && NOT EXISTS (SELECT id FROM funcionario WHERE id_turno = turno.id";

		 $query = mysql_query("SELECT * FROM turno WHERE oculto = 0");
		 
		 while($result =  mysql_fetch_array($query)){
		 	$return[$aux][0] = $result['id'];
		 	$return[$aux][1] = $result['descricao'];
		 	$return[$aux][2] = $result['nome'];
		 	$aux++;
		 }
		 if($aux == 0){
		 	//target="_blank|_self|_parent|_top|framename"
		 	echo '<div class="msg">Nenhum turno encontrado! <a target="_blank" href="add_turno.php"> Cadastre agora</a></div>';
		 }
		 
		 return $return;
	}

	public function printTurno(){

		
		$texto = "<table class='table_pesquisa'>
			<tr>
				<td><span><b>ID: </b></span></td><td><span>".$this->id."</span></td>
			</tr>
			<tr>
				<td><span><b>Nome: </b></span></td><td><span>".$this->nome."</span></td>
			</tr>
			<tr>
			    <td><span><b>Inicio expediente: </b></span></td><td><span>".$this->ini_exp."</span></td>
			</tr>
			<tr>
			    <td><span><b>Início almoço: </b></span></td><td><span>".$this->ini_alm."</span></td>
			</tr>
			<tr>
			    <td><span><b>Fim almoço: </b></span></td><td><span>".$this->fim_alm."</span></td>
			</tr>
			<tr>
			    <td><span><b>Fim expediente: </b></span></td><td><span>".$this->fim_exp."</span></td>
			</tr>
			<tr>
			    <td><span><b>Descrição: </b></span></td><td><span>".$this->desc."</span></td>
			</tr>
		</table>";
		return $texto;
	}

}

 ?>