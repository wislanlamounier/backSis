<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Viacampos</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        function validarSenha(f){
            var s1;
            var s2;
            for (var i = 0; i < f.length; i++) {
                if (f[i].name == 'senha'){                    
                    var s1=f[i].value;
                    
                }
                if(f[i].name=='senha1'){                    
                    var s2=f[i].value;
                    
                }                
            }
            if (s1 == s2)
                return true;
            else
                alert("SENHAS DIFERENTES")
                 
            }

        function valida(f){
        var erros = 0;
        var msg = "";

       for (var i = 0; i < f.length; i++) { 
        if(f[i].name == "nome" && f[i].value == ""){
                msg += "Insira um Nome!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "nome" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
        if(f[i].name == "nome_fantasia" && f[i].value == ""){
                msg += "Insira o nome fantasia da empresa!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "nome_fantasia" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
        if(f[i].name == "email" && f[i].value == ""){
                msg += "Insira o email!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "email" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
        if(f[i].name == "razao_soc" && f[i].value == ""){
                msg += "Insira a Razão social da empresa!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "razao_soc" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
        if(f[i].name == "cpf" && f[i].value == ""){
                msg += "Preencha o CPF!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "cpf" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

        if(f[i].name == "cnpj" && f[i].value == ""){
                msg += "Preencha o cnpj!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "cnpj" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
        if(f[i].name == "telefone" && f[i].value == ""){
                msg += "Insira o telefone!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "telefone" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }              
        if(f[i].name == "senha" && f[i].value == ""){
                msg += "Preencha o campo senha!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "senha" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }
        if(f[i].name == "senha1" && f[i].value == ""){
                msg += "Preencha senha no campo repetir senha!\n";
                
                f[i].style.border = "1px solid #FF0000";
                erros++;
              }
              if(f[i].name == "senha1" && f[i].value != ""){
                f[i].style.border = "1px solid #898989";
              }

        }
           if(erros>0){            
              alert(msg);
            return false;
          }
        }
            // Mask
        function mascara(o,f){
          v_obj=o
          v_fun=f
          setTimeout("execmascara()",1)
        }
          function execmascara(){
              v_obj.value=v_fun(v_obj.value)
        }
        
        function mtel(v){
       if(v.length >=15){
         v = v.substring(0,(v.length - 1));
         return v;
       }
       v=v.replace(/\D/g,"");
       v=v.replace(/^(\d{2})(\d)/g,"($1) $2");
       v=v.replace(/(\d)(\d{4})$/,"$1-$2");
       return v;
        }
        function mcpf(v){
       if(v.length >=15){  
         v = v.substring(0,(v.length - 1));
         return v;
       }
       v=v.replace(/\D/g,""); 
       v=v.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/,"$1.$2.$3-$4");
       return v;
        }
        function mcnpj(v){
           if(v.length >=19){                                          // alert("mtel")
             v = v.substring(0,(v.length - 1));
             return v;
           }
           v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
           v=v.replace(/^(\d{2})(\d{3})/g,"$1.$2."); 
           v=v.replace(/(\d{3})(\d{4})/,"$1/$2"); 
           v=v.replace(/(\d)(\d{2})$/,"$1-$2"); 
           
           return v;
        }
    
        function id( el ){
         return document.getElementById( el );
        }
         window.onload = function(){
     
        id('cpf').onkeypress = function(){ 
          mascara( this, mcpf );
      }
      
        id('telefone').onkeypress = function(){
          mascara( this, mtel );
      }
        id('cnpj').onkeypress = function(){
              mascara( this, mcnpj );
      }          
        }
   // fim Mask
        function validarCPF(cpf){
          
        cpf = cpf.replace(/[^\d]+/g,'');    
        if(cpf == '') return false; 
        // Elimina CPFs invalidos conhecidos    
        if (cpf.length != 11 || 
            cpf == "00000000000" || 
            cpf == "11111111111" || 
            cpf == "22222222222" || 
            cpf == "33333333333" || 
            cpf == "44444444444" || 
            cpf == "55555555555" || 
            cpf == "66666666666" || 
            cpf == "77777777777" || 
            cpf == "88888888888" || 
            cpf == "99999999999")
                return false;       
        // Valida 1o digito 
        add = 0;    
        for (i=0; i < 9; i ++)       
            add += parseInt(cpf.charAt(i)) * (10 - i);  
            rev = 11 - (add % 11);  
            if (rev == 10 || rev == 11)     
                rev = 0;    
            if (rev != parseInt(cpf.charAt(9)))     
                return false;       
        // Valida 2o digito 
        add = 0;    
        for (i = 0; i < 10; i ++)        
            add += parseInt(cpf.charAt(i)) * (11 - i);  
        rev = 11 - (add % 11);  
        if (rev == 10 || rev == 11) 
            rev = 0;    
        if (rev != parseInt(cpf.charAt(10)))
            return false;

        return true;   
}

    </script>
</head>

<body>

    <!-- Navigation -->
    <?php include_once("view/site/navigation.php") ?>

    <!-- Header -->
    <?php include_once("view/site/header.php") ?>    
    
    <!-- Cadastro -->
     <?php include_once("view/site/cadastro.php") ?>    

    <!-- Page Content -->
	<?php include_once("view/site/services.php") ?>    
    
    <!-- /.content-section-a -->

	<?php include_once("view/site/contact.php") ?>

    <!-- Footer -->
    <?php include_once("view/site/footer.php"); ?>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
