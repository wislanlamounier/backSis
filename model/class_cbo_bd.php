<?php 

include_once("class_sql.php");
require_once(dirname(__FILE__) . "/../global.php");

class Cbo{
	public $id;
	public $codigo;
	public $descricao;

	public function add_cbo($codigo, $descricao){
		$this->codigo = $codigo;
		$this->descricao = $descricao;
	}

	public function get_cbo_by_id($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "SELECT * FROM cbo WHERE id = '%s'";

		$result = $g->tratar_query($query, $id);

		if(@mysql_num_rows($result) == 0){
			echo 'Nenhum cbo encontrado';
            return false;
		}else{
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$this->id = $row['id'];
			$this->codigo = $row['codigo'];
			$this->descricao = $row['descricao'];
			return $this;
		}

	}
	public function get_exames_cbo($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "SELECT e.id, e.descricao FROM exames as e INNER JOIN cbo_exames WHERE e.id = cbo_exames.id_exame AND cbo_exames.id_cbo = '%s'";

		$aux=0;
		
		$query_tra = $g->tratar_query($query, $id);

		while($result = mysql_fetch_array($query_tra)){
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['descricao'];
			$aux++;
		}

		return $return;
	}
	public function atualiza_cbo($id, $codigo, $descricao){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "UPDATE cbo SET codigo = '%s', descricao = '%s' WHERE id = '%s'";

		if($g->tratar_query($query, $codigo, $descricao, $id)){
			return true;
		}else{
			return false;
		}

	}
	public function add_cbo_bd(){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "INSERT INTO cbo (codigo, descricao) VALUES ('%s', '%s')";

		if($g->tratar_query($query, $this->codigo, $this->descricao)){
			echo '<div class="msg">CBO cadastrado com sucesso!</div>';
			$query = mysql_query("SELECT * FROM cbo ORDER BY id DESC");
			$result =  mysql_fetch_array($query);
			return $result['id'];
		}
		// $sql->close();
	}

	public function get_cbo_by_codigo_and_desc($cod){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = 'SELECT * FROM cbo WHERE  oculto = 0 && codigo LIKE "%%%s%%" OR descricao LIKE "%%%s%%" ORDER BY descricao ASC';
		$aux=0;
		
		$query_tra = $g->tratar_query($query, $cod, $cod);

		while($result = mysql_fetch_array($query_tra)){
			
			$return[$aux][0] = $result['id'];
			$return[$aux][1] = $result['codigo'];
			$return[$aux][2] = $result['descricao'];
			$aux++;
		}

		return $return;

	}

	public function get_name_all_cbo(){
		 $sql = new Sql();
		 $sql->conn_bd();
		 $return = array(array());
		 $aux=0;

		 $query = mysql_query("SELECT * FROM cbo WHERE oculto = 0 ORDER BY descricao asc");
		 
		 while($result =  mysql_fetch_array($query)){
		 	$return[$aux][0] = $result['id'];
		 	$return[$aux][1] = $result['descricao'];
		 	$aux++;
		 }
		 
		 return $return;
	}

	public function ocultar(){
		$sql = new Sql();	
		$sql->conn_bd();
		$g = new Glob();
		$query = "UPDATE cbo SET oculto = '1' WHERE id = '%s'";

		return $g->tratar_query($query, $this->id);
	}

	public function printCbo(){
		$result = $this->get_exames_cbo($this->id);

		$texto = "<table class='pesquisa-exibe' border='0'>
			<tr>
				<td><b>ID: </b></td> <td>".$this->id."</td>
			</tr>
			<tr>
				<td><b>Código: </b></td> <td>".$this->codigo."</td>
			</tr>
			<tr>
				<td><b>Descrição: </b></td> <td>".$this->descricao."</td>
			</tr>";
			if(count($result)>0){
				$texto .= '<tr>
						<td colspan="2"><b>Exames necessários:</b></td>
					</tr>';
			}
			for ($i=0; $i < count($result) ; $i++) { 
				$texto .= "<tr>";
				$texto .= "<td colspan='2' style='padding-left:20px;'>".$result[$i][1]."</td>";
				$texto .= "</tr>";
			}

		$texto .= "</table>";
		return $texto;
	}

}



?>