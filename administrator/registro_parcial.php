 <?php
include_once("../global.php");
include_once("../model/class_sql.php");
include_once("../model/class_funcionario_bd.php");
include_once("../model/class_empresa_bd.php");

    echo '<br>'.$nome = $_POST['nome'];
    echo '<br>'.$email = $_POST['email'];
    echo '<br>'.$cpf = $_POST['cpf'];
    echo '<br>'.$telefone = $_POST['telefone'];
    echo '<br>'.$senha = $_POST['senha'];
    			$senha = md5($senha);

    echo '<br>'.'<br>'.$nome_fantasia = $_POST['nome_fantasia'];
    echo '<br>'.$razao_soc = $_POST['razao_soc'];
    echo '<br>'.$cnpj = $_POST['cnpj'];

    
    $funcionario = new Funcionario();
	$empresa = new Empresa();
    
    echo "id_empresa".$id_empresa = $empresa->busca_ultimo_id_empresa(); /*resgata o ultimo id para cirar novo id de empresa*/

    $funcionario->add_func_parcial($nome, $email, $cpf, $telefone, $senha, $id_empresa);
    $funcionario->add_func_parcial_bd();
    


    
    echo "id responsavel".$id_responsavel = $funcionario->busca_ultimo_id_funcionario();	/*resgata o ultimo id para cirar novo id de funcionario*/

    $empresa->add_empresa_parcial($nome_fantasia, $razao_soc, $cnpj, $id_responsavel);
    $empresa->add_empresa_parcial_bd();

?>  
			
	 
