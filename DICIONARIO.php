<?
/**
* @author Andre Matos
* @access public
*
*/
OBSERVA��ES TABELA BANCO{
	
	TABELA(VEICULO, MAQUINARIO, PATRIMONIO_GERAL){
		CAMPO: CONTROLE{
			0 -> PATRIMONIO GERAL
			1 -> MAQUINARIO
			2 -> VEICULO 
		}
		
	}

	TABELA (EMPRESA){
		CAMPO: NIVEL_ACESSO{
			0 -> ACESSO TOTAL
			1 -> ACESSO ENGENHARIA
			2 -> ACESSO CONTROLPONTO	
		}
		
	}

	TABLE (CLIENTES){
		CAMPO: TIPO{
			0 -> CLIENTE
			1 -> EMPRESA	
		}
		
	}

	TABLE (EPI){
		CAMPO: EPI{
			0-> NAO � EPI
			1-> � EPI	
		}
		
	}

	TABLE (OBRAS){
		CAMPO: STATUS{
			0 -> OR�AMENTO
			1 -> OBRA
			2 -> FINALIZADA
		}
		
	}
}


SIGLAS{
	EPI: EQUIPAMENTO DE PROTE��O INDIVIDUAL
	CBO: CADASTRO BRASILEIRO DE OCUPA��ES
}
?>