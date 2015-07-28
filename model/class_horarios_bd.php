<?php

include_once("class_sql.php");
include_once("class_funcionario_bd.php");
require_once(dirname(__FILE__) . "/../global.php");

class Horarios{
	public $id;
	public $hora;
    public $data;
	public $tipo;
	public $id_funcionario;
	public $observacao_funcionario;
	public $id_obs_supervisor;
	public $situacao;

	// public function converterHora($total_segundos){
	// 		$hora = sprintf("%02s",floor($total_segundos / (60*60)));
	// 		$total_segundos = ($total_segundos % (60*60));
			
	// 		$minuto = sprintf("%02s",floor ($total_segundos / 60 ));
	// 		$total_segundos = ($total_segundos % 60);
			
	// 		$hora_minuto = $hora.":".$minuto;
	// 		return $hora_minuto;
	// }

	public function cadHorario($hora, $data, $tipo, $id_funcionario, $observacao_funcionario, $situacao){
		// $this->id = $id;
		$this->situacao = $situacao;
	    $this->data = $data;
		$this->hora = $hora;
		$this->tipo = $tipo;
		$this->id_funcionario = $id_funcionario;
		$this->observacao_funcionario = $observacao_funcionario;

	}
	public function insertHorarioBd(){//insere um horario no banco
		// $this->id = $id;
		$sql = new Sql();
		$sql->conn_bd();
		
		mysql_query("INSERT INTO horarios (hora, data, tipo, situacao, id_funcionario, observacao_funcionario) 
			VALUES ('".$this->hora."',
					'".$this->data."',
				    '".$this->tipo."',
				    '".$this->situacao."',
				    '".$this->id_funcionario."',
				    '".$this->observacao_funcionario."')") or print(mysql_error());
	}
	public function getTipoUltimoHorarioFunc($id_func){//retorna o ultimo tipo cadastrado
		$sql = new Sql();
		$sql->conn_bd();
		$query = "SELECT * FROM horarios WHERE id_funcionario = ".$id_func." ORDER BY id DESC";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		
		return $row['tipo'];
	}
	public function get_horario_by_func_and_data($id_func, $data){
		
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();

		$query = "SELECT * FROM horarios WHERE id_funcionario = '".$id_func."' && data LIKE '%".$data."%' ORDER BY data DESC";
		// echo '<script> alert("'.$query.'"); </script>';
		$result = mysql_query($query);
		$aux=0;
		while($row = mysql_fetch_array($result) ){
			// echo '<script> alert("ENCONTROU: '.$query.'"); </script>';
			$return[$aux][0] = $row['id'];
			$return[$aux][1] = $row['situacao'];
			$return[$aux][2] = $row['data'];
			$return[$aux][3] = $row['hora'];
			$return[$aux][4] = $row['tipo'];
			$return[$aux][5] = $row['id_funcionario'];
			
			$aux++;
		}
		return $return;
	}
	public function get_horario_by_id($id){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$query = "SELECT * FROM horarios WHERE id = '%s'";
		$result = $g->tratar_query($query, $id);

		if(@mysql_num_rows($result) > 0){
			$row = mysql_fetch_array($result);
			$this->hora = $row['hora'];
			$this->data = $row['data'];
			$this->tipo = $row['tipo'];
			$this->id_funcionario = $row['id_funcionario'];
			$this->id_obs_supervisor = $row['id_obs_supervisor'];
			$this->observacao_funcionario = $row['observacao_funcionario'];
			$this->situacao = $row['situacao'];

			return $this;
		}else{
			return false;
		}



	}
	// public function get_horario_atraso($hora_turno, $hora_login){
	// 	$h_turno  = strtotime($hora_turno);
 // 		$h_login    = strtotime($hora_login);

 // 		$time = $h_login - $h_turno;

 // 		$return = $this->converterHora($time);

 // 		return $return;
	// }
	
	public function verifica_atraso($hora_turno, $hora_login){
		$horas_adiantado = 0;
        $minutos_adiantado = 0;
        $atrasou;
		if(date('H', $hora_turno) <= date('H', $hora_login)){
			if(date('H', $hora_turno) < date('H', $hora_login)){// hora de entrada for menor que hora login quer dizer que ele esta 1 hora ou mais atrasado
				$horas_atraso = date('H', $hora_login) - date('H', $hora_turno);
				$atraso .= $horas_atraso; // atraso recebe hora login - hora turno
				$atraso .= "h";

				$atrasou = true;
			}else{ //hora turno = hora login, verifica os minutos
				// $horas_atraso = date('H', $hora_turno) - date('H', $hora_login); 
				// $atraso .= $horas_atraso; // atraso recebe hora turno - hora login
				// $atraso .= "h";
				if(date('i', $hora_turno) < date('i', $hora_login)){// se minuto de entrada determinada for menor que
					// $minutos_atraso = (date('i', $hora_login) - date('i', $hora_turno));
					// $atraso .= $minutos_atraso;
					// $atraso .= "s";
					$atrasou = true;
				// if($atraso < 0) $atraso * -1;// se atraso for negativo, multiplica por -1 para virar positivo
				}else{
					$atrasou = false;
				}
			}
			
			
			return $atrasou;
		}
	}

	public function get_hora_atraso($hora_turno, $hora_login){//
		if(date('H', $hora_turno) < date('H', $hora_login)){// hora de entrada for menor que hora login quer dizer que ele esta 1 hora ou mais atrasado
				// echo '<script> alert("entrou aqui"); </script>';
				if((60-date('i', $hora_turno)) + date('i', $hora_login) > 60){
					// echo '<script> alert("aqui tambem"); </script>';
					$hora_atraso = date('H', $hora_login) - date('H', $hora_turno);
					$atraso .= $hora_atraso;
				}else if(date('H', $hora_turno) < date('H', $hora_login)){
					// echo '<script> alert("aqui tambem"); </script>';
					$hora_atraso = date('H', $hora_login) - date('H', $hora_turno);
					$atraso .= $hora_atraso;
				}else{
					$horas_atraso = 0;
					$atraso .= $horas_atraso; // atraso recebe hora login - hora turno
				}
					//$atraso .= "h";
				 // echo '<script> alert("caiu 1"); </script>';

		}else{ //hora turno = hora login
				$horas_atraso = date('H', $hora_login) - date('H', $hora_turno); 
				$atraso .= $horas_atraso; // atraso recebe hora turno - hora login
				//$atraso .= "h";
			    // echo '<script> alert("caiu 3"); </script>';
		}
		return $atraso;
	}

	public function get_min_atraso($hora_turno, $hora_login){//
		if(date('i', $hora_turno) < date('i', $hora_login)){// se minuto de entrada determinada for menor que
			$minutos_atraso = (date('i', $hora_login) - date('i', $hora_turno));
			$atraso .= $minutos_atraso;
			//$atraso .= "m";
			 // echo '<script> alert("aqui1"); </script>';
			// if($atraso < 0) $atraso * -1;// se atraso for negativo, multiplica por -1 para virar positivo
		}else if(date('i', $hora_turno) == 0){
			// echo '<script> alert("aqui2"); </script>';
			$minutos_atraso = 60-date('i', $hora_login);
			$atraso .= $minutos_atraso;;
		}else{
			 // echo '<script> alert("aqui3"); </script>';
			$minutos_atraso = ( (60-date('i', $hora_turno) ) + date('i', $hora_login) );
			$atraso .= $minutos_atraso;
			//$atraso .= "m";
		}
		return $atraso;
	}


	public function verifica_antecedencia($hora_turno, $hora_login){
		$horas_adiantado = 0;
        $minutos_adiantado = 0;
        $adiantado;
		if(date('H', $hora_turno) >= date('H', $hora_login)){// se hora turno for maior ou igual hora login
			if(date('H', $hora_turno) > date('H', $hora_login)){// hora turno for maior que hora login quer dizer que o funcionario esta adiantado
				$horas_ad = date('H', $hora_turno) - date('H', $hora_login);
				$ad .= $horas_ad; // adiantado recebe hora login - hora turno
				//$ad .= "h";
				$adiantado = true;

			}else{ //hora turno = hora login, verifica os minutos
				// $horas_atraso = date('H', $hora_turno) - date('H', $hora_login); 
				// $atraso .= $horas_atraso; // atraso recebe hora turno - hora login
				// $atraso .= "h";
				if(date('i', $hora_turno) > date('i', $hora_login)){// se minuto de entrada determinada for maior que minuto que func esta entrando
					// $minutos_atraso = (date('i', $hora_login) - date('i', $hora_turno));
					// $atraso .= $minutos_atraso;
					// $atraso .= "s";
					$adiantado = true;
				// if($atraso < 0) $atraso * -1;// se atraso for negativo, multiplica por -1 para virar positivo
				}else{
					$adiantado = false;
				}
			}
		
			return $adiantado;
		}
	}

	public function get_hora_ant($hora_turno, $hora_login){
		if(date('H', $hora_turno) > date('H', $hora_login)){// hora de entrada for maior que hora login quer dizer que func está 1 hora ou mais adiantado
			
			//se ( minuto da hora turno ) + (60 - ( minuto hora login) ) for maior que 60 

			if(((date('i', $hora_turno) + (60-date('i', $hora_login) )) > 60 )){
				$horas_ant = date('H', $hora_turno) - date('H', $hora_login);
				$ant .= $horas_ant; // atraso recebe hora login - hora turno
				//$ant .= "h";
			}else if( (date('H', $hora_login)+1 < date('H', $hora_turno) ) && date('i', $hora_login) < 1 ){
				$horas_ant = date('H', $hora_turno) - date('H', $hora_login);
				$ant .= $horas_ant; // atraso recebe hora login - hora turno
				//$ant .= "h";
			}else{
				$horas_ant = (date('H', $hora_turno) - date('H', $hora_login))-1;
				$ant .= $horas_ant; 
				//$ant .= "h";
			}
		}
		// else{ //hora turno = hora login
		// 		$horas_ant = date('H', $hora_login) - date('H', $hora_turno); 
		// 		$ant .= $horas_ant; // atraso recebe hora turno - hora login
		// 		$ant .= "h";
		// }
		return $ant;
	}

	public function get_minutos_ant($hora_turno, $hora_login){
			
			if(date('i', $hora_turno) > date('i', $hora_login)){// minuto hora de entrada for maior que minuto hora login quer dizer que func está adiantado
					// echo "<script> alert('Entrou aqui'); </script>";
					$horas_ant = date('i', $hora_turno) - date('i', $hora_login);//com
					$ant .= $horas_ant; // atraso recebe hora login - hora turno
					//$ant .= "m";
			}else if(date('i', $hora_turno) == 00){ //hora turno = hora login
				// echo "<script> alert('Entrou aqui 2'); </script>";
					$horas_ant = date('i', $hora_login) - 60;
					$ant .= $horas_ant*(-1); // atraso recebe hora turno - hora login
					//$ant .= "m";
			}else{
				// echo "<script> alert('Entrou aqui 3'); </script>";
				$horas_ant = (60-date('i', $hora_login)) + date('i', $hora_turno);//com

				$ant .= $horas_ant; // atraso recebe hora turno - hora login
				//$ant .= "m";
			}
			return $ant;
	}
	public function get_atrasos($data){
		$sql = new Sql();
		$sql->conn_bd();
		$g = new Glob();
		$func = new Funcionario();
		$aux=0;
		$query = "SELECT * FROM horarios WHERE data = '".$data."' && situacao LIKE '%+%' ORDER BY hora ASC";
		 // echo '<script> alert("'.$query.'") </script>';

		// $query_tra = $g->tratar_query($query, $data);
		$query_ex = mysql_query($query);
		
		while($result =  mysql_fetch_array($query_ex) ){
			// echo '<script> alert("'.$query.'") </script>';
			$hora = $result['situacao'];
			$minuto = $hora[3];
			if(preg_match("/^([0-9]+)$/i", $hora[4])){
				$minuto.=$hora[4];
			}
			if($hora[1] > 0 || $minuto > $_SESSION['temp_limit_atraso']){
				$return[$aux][0] = $result['id'];
				$return[$aux][1] = $result['hora'];
				$return[$aux][2] = $result['situacao'];
				$return[$aux][3] = $func->get_nome_by_id($result['id_funcionario']);
				if($result['tipo'] == 1){
					$return[$aux][4] = "Iniciou o expediente";
				}else if($result['tipo'] == 2){
					$return[$aux][4] = "Saiu para almoço";
				}else if($result['tipo'] == 3){
					$return[$aux][4] = "Encerrou o almoço";
				}else{
					$return[$aux][4] = "Encerrou o expediente";
				}
				$return[$aux][5] = $result['id_obs_supervisor'];
				$aux++;
			}
			
		}
		return $return;
	}
	

}

 ?>
