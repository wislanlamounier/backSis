<?php
include_once("class_sql.php");
include_once("../global.php");
    
    class Contas{
        public $id;
	public $codigo;
        public $descricao;
	public $fornecedor_cliente;
	public $id_obra;
	public $banco;
	public $valor;
	public $multa;
	public $data_vencimento;
	public $parcelas;
	public $juros;
        public $tipo;
	public $oculto;
	
        public function add_contas($codigo, $desc, $fornecedor_cliente, $id_obra, $banco, $valor, $multa, $data_vencimento, $parcelas, $juros, $tipo){
            
            $this->codigo = $codigo;
            $this->descricao = $desc;
            $this->fornecedor_cliente = $fornecedor_cliente;
            $this->id_obra = $id_obra;
            $this->banco = $banco;
            $this->valor = $valor;
            $this->multa = $multa;
            $this->data_vencimento = $data_vencimento;
            $this->parcelas = $parcelas;
            $this->juros = $juros;
            $this->tipo = $tipo;            
        }
        
        public function add_contas_bd(){            
                $sql= new Sql();
		$sql->conn_bd();

		$g = new Glob();

		$query = "INSERT INTO contas (codigo, descricao, fornecedor_cliente, obra, banco, valor, multa, data_vencimento, parcelas, juros, tipo) 
		                     VALUES ( '%s',   '%s',     '%s',     '%s',     '%s',  '%s',  '%s',      '%s',        '%s',    '%s', '%s')";
		
		if($g->tratar_query($query,  $this->codigo, $this->descricao, $this->fornecedor_cliente, $this->id_obra, $this->banco, $this->valor, $this->multa, $this->data_vencimento, $this->parcelas, $this->juros, $this->tipo)){
			return true; 
		}else{
			return false;
		} 
        }
        
    public function ver_contas_apagar(){
            $sql= new Sql();
            $sql->conn_bd();
            $g = new Glob();
            
            $query = "SELECT * FROM contas WHERE tipo = 1";
            
            $result = $g->tratar_query($query);
            
            $lista = array();
            
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
                $conta = new Contas();
                $conta->codigo = $row['codigo'];
                $conta->valor = $row['valor'];
                $conta->fornecedor_cliente = $row['fornecedor_cliente'];
                $conta->data_vencimento = $row['data_vencimento'];
                $conta->descricao = $row['descricao'];
                $conta->banco = $row['banco'];  
                $lista[] = $conta; 
            }
            return $lista;
        }
    
        
    }

?>