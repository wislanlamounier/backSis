
<?php
include_once("../global.php");
include_once("../model/class_sql.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_empresa_bd.php");

function validate(){
  if(!isset($_POST['nome']) || $_POST['nome'] == ""){
        return false;
    }  
   if(!isset($_POST['email']) || $_POST['email'] == ""){
       return false;
   }
   if(!isset($_POST['cpf']) || $_POST['cpf'] == ""){
       return false;
   }
   if(!isset($_POST['telefone']) || $_POST['telefone'] == ""){
       return false;
   }
   if(!isset($_POST['senha']) || $_POST['senha'] == ""){
       return false;
   }
   if(!isset($_POST['senha1']) || $_POST['senha1'] == ""){
       return false;
   }
   if ($_POST['senha'] != $_POST['senha1']) {
     	return false;
     }  
   if(!isset($_POST['nome_fantasia']) || $_POST['nome_fantasia'] == ""){
       return false;
   }
   if(!isset($_POST['razao_soc']) || $_POST['razao_soc'] == ""){
       return false;
   }
   if(!isset($_POST['cnpj']) || $_POST['cnpj'] == ""){
       return false;
   }
   return true;
}

if (validate()){
	

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $senhaoriginal = $senha; // CODIGO SERA RETIRADO APENAS PARA TESTE !!!!!!!!
    $senha = md5($senha);

    '<br>'.$nome_fantasia = $_POST['nome_fantasia'];
    $razao_soc = $_POST['razao_soc'];
    $cnpj = $_POST['cnpj'];

    
    $funcionario = new Funcionario();
	$empresa = new Empresa();
    
    $id_empresa = $empresa->busca_ultimo_id_empresa(); /*resgata o ultimo id para cirar novo id de empresa*/

    $funcionario->add_func_parcial($nome, $email, $cpf, $telefone, $senha, $id_empresa);
    $funcionario->add_func_parcial_bd();
    


    
    $id_responsavel = $funcionario->busca_ultimo_id_funcionario();	/*resgata o ultimo id para cirar novo id de funcionario*/

    $empresa->add_empresa_parcial($nome_fantasia, $razao_soc, $cnpj, $id_responsavel);
    $empresa->add_empresa_parcial_bd();

    $redirect = "../index.php?cadastro=ok&nome=".$nome."&email=".$email."&id=".$id_responsavel."&senha=".$senhaoriginal."&#cadastro";
	header("location:$redirect");

}else{

	
	$redirect = "../index.php?#cadastro";
	header("location:$redirect");
}

?>  
			
	 
