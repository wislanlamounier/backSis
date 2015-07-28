<?php

include_once("class_sql.php");
include_once("../global.php");

class Cliente { 

	public $id;
	public $data_nasc_data_fund;
	public $cpf_cnpj;
	public $nome_razao_soc;
	public $telefone_cel;
	public $telefone_com;
	public $id_endereco;
	public $tipo;
	public $rg;
	public $inscricao_estadual;
	public $inscricao_municipal;
	public $responsavel;
	public $cpf_responsavel;
	public $data_nasc_resp;
	public $email_resp;
	public $site;
	public $observacao;

	public function add_cliente($nome_razao_soc, $data_nasc_data_fund, $cpf_cnpj, $telefone_cel, $telefone_com, $id_endereco, $tipo, $rg, $inscricao_estadual, $inscricao_municipal, $responsavel, $cpf_responsavel, $data_nasc_resp, $email_resp, $site, $observacao){

		$this->nome_razao_soc = $nome_razao_soc;
		$this->data_nasc_data_fund = $data_nasc_data_fund;
		$this->cpf_cnpj = $cpf_cnpj;
		$this->telefone_cel = $telefone_cel;
		$this->telefone_com = $telefone_com;
		$this->id_endereco = $id_endereco;
		$this->tipo = $tipo;
		$this->rg = $rg;
		$this->inscricao_estadual = $inscricao_estadual;
		$this->inscricao_municipal = $inscricao_municipal;
		$this->responsavel = $responsavel;
		$this->cpf_responsavel =$cpf_responsavel;
		$this->data_nasc_resp = $data_nasc_resp;
		$this->email_resp = $email_resp;
		$this->site = $site;
		$this->observacao = $observacao;

	}

	public function add_cliente_bd(){
		$sql= new Sql();
		$sql->conn_bd();

		$g = new Glob();

		$query = "INSERT INTO clientes (nome_razao_soc, data_nasc_data_fund, cpf_cnpj, telefone_cel, telefone_com, id_endereco, tipo, rg, inscricao_estadual, inscricao_municipal, responsavel, cpf_responsavel, data_nasc_responsavel, email_responsavel, site, observacao) 
		                        VALUES (    '%s',           '%s',                '%s',      '%s',         '%s',         '%s',    '%s','%s',       '%s',               '%s',             '%s',           '%s',               '%s',                 '%s',     '%s',    '%s')";
		
		if($g->tratar_query($query, $this->nome_razao_soc, $this->data_nasc_data_fund, $this->cpf_cnpj, $this->telefone_cel,$this->telefone_com, $this->id_endereco, $this->tipo, $this->rg, $this->inscricao_estadual, $this->inscricao_municipal, $this->responsavel, $this->cpf_responsavel, $this->data_nasc_resp, $this->email_resp, $this->site, $this->observacao)){
			return true; 
		}else{
			return false;
		} 
		
	}
}


?>