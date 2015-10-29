<script type="text/javascript">
	



</script>
<?php 
/**
* Scripts
*
*/
Class Functions{

	function getScriptFuncionario(){
			?>
			<script type="text/javascript">
				    function exibe(){
				        // document.getElementById("popup").style.display = "block";
				        var windowWidth = window.innerWidth;
				        var windowHeight = window.innerHeight;
				      
				        var screenWidth = screen.width;
				        var screenHeight = screen.height;
				        // alert(windowWidth+" x "+windowHeight)
				        if(windowWidth > 1200){
				          document.getElementById("popup").style.marginLeft = "35%";
				        }else if(windowWidth > 1000){
				          document.getElementById("popup").style.marginLeft = "30%";
				        }else if(windowWidth > 500){
				          document.getElementById("popup").style.marginLeft = "20%";
				        }else{
				          document.getElementById("popup").style.marginLeft = "0%";
				        }
				    }
				    function fechar(){
				        document.getElementById("popup").style.marginLeft = "-500px";
				    }
				    function confirma(id,nome){
				       if(confirm("Excluir funcionario "+nome+" , tem certeza?")){
				          var url = '../ajax/ajax_excluir_funcionario.php?id='+id+'&nome='+nome;
				          $.get(url, function(dataReturn) {
				            $('#result').html(dataReturn);
				            window.location.href='add_func.php';
				          });
				       }
				    }
				      function valida(f){
				        var erros = 0;
				        var msg = "";
				          for (var i = 0; i < f.length; i++) {
				              if(f[i].name == "codigo"){
				                  if(f[i].value == ""){
				                     msg += "Insira um Codigo!\n";
				                     f[i].style.border = "1px solid #FF0000";
				                     erros++;
				                  }else{
				                      f[i].style.border = "1px solid #898989";
				                  }
				              }
				              if(f[i].name == "nome" && f[i].value == ""){
				                msg += "Insira um Nome!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "nome" && f[i].value != ""){
				                f[i].style.border = "1px solid #898989";
				              }
				              if(f[i].name == "valor_custo" && f[i].value == ""){
				                msg += "Insira o valor de custo do funcionario!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "valor_custo" && f[i].value != ""){
				                f[i].style.border = "1px solid #898989";
				              }
				              
				              if(f[i].name == "tipo_custo" && f[i].value == "no_sel"){
				                msg += "Insira tip de custo!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "tipo_custo" && f[i].value != "no_sel"){
				                f[i].style.border = "1px solid #898989";
				              }
				              
				              if(f[i].name == "cpf"){
				                if(f[i].value == ""){
				                  msg += "Insira um CPF!\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                  if(!validarCPF(f[i].value)){
				                    msg += "Insira um CPF válido!\n";
				                    f[i].style.border = "1px solid #FF0000";
				                    erros++;
				                  }
				                }
				                if(f[i].value != "" && validarCPF(f[i].value)){
				                  f[i].style.border = "1px solid #898989";
				                }
				               
				              }

				              if(f[i].name == "email_emp"){
				                if(f[i].value == ""){
				                  msg += "Preencha o campo Email empresarial!\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                  f[i].style.border = "1px solid #898989"; 
				                }
				              }
				              if(f[i].name == "data_admissao"){
				                if(f[i].value == ""){
				                  msg += "Preencha o campo Data de Admissão!\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                  f[i].style.border = "1px solid #898989"; 
				                }
				              }
				              if(f[i].name == "sal_base"){
				                if(f[i].value == ""){
				                  msg += "Preencha corretamente o campo Salário Base!\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                    var salario = f[i].value;
				                    var realAnCent = salario.replace(/[\R\$\,\.\ ]/g , "");
				                    if(realAnCent <= 0){
				                        msg += "Preencha corretamente o campo Salário Base!\n";
				                        f[i].style.border = "1px solid #FF0000";
				                        erros++;
				                    }else{
				                        f[i].style.border = "1px solid #898989"; 
				                    }
				                }
				              }
				              
				              if(f[i].name == "qtd_horas_sem"){
				                if(f[i].value == ""){
				                  msg += "Preencha o campo Quant. de Horas Semanais!\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                  if(f[i].value <= 0){
				                      msg += "Insira um valor acima de 0 em Quant. de Horas Semanais!\n";
				                      f[i].style.border = "1px solid #FF0000";
				                      erros++;
				                  }else{
				                      f[i].style.border = "1px solid #898989"; 
				                  }
				                }
				                
				              }


				              if(f[i].name == "data_nasc" && f[i].value == ""){
				                msg += "Insira uma Data de Nascimento!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "data_nasc" && f[i].value != ""){
				                f[i].style.border = "1px solid #898989";
				              }

				              if(f[i].name == "telefone" && f[i].value == ""){
				                msg += "Insíra um Telefone!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "telefone" && f[i].value != ""){
				                f[i].style.border = "1px solid #898989";
				              }

				              if(f[i].name == "email" && f[i].value == ""){
				                msg += "Insira um Email!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "email" && f[i].value != ""){
				                f[i].style.border = "1px solid #898989";
				              }

				              if(f[i].name == "senha"){
				                  if(f[i].value == "" && document.getElementById('tipo').value == "cadastrar"){
				                    msg += "Insira uma Senha!\n";
				                    f[i].style.border = "1px solid #FF0000";
				                    erros++;
				                  }
				              }
				              if(f[i].name == "senha" && f[i].value != ""){
				                f[i].style.border = "1px solid #898989";
				              }
				              if(f[i].name == "empresa"){
				                if(f[i].value == "no_sel"){
				                  msg += "Selecione uma empresa!\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                  f[i].style.border = "1px solid #898989";
				                }
				              }
				              

				              if(f[i].name == "turno" && f[i].value == "Selecione um turno"){
				                msg += "Selecione um Turno!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "turno" && f[i].value != "Selecione um turno"){
				                f[i].style.border = "1px solid #898989";
				              }

				              if(f[i].name == "cbo" && f[i].value == "Selecione um cbo"){
				                msg += "Selecione um CBO!\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "cbo" && f[i].value != "Selecione um cbo"){
				                f[i].style.border = "1px solid #898989";
				              }

				              if(f[i].name == "rua" && f[i].value == ""){
				                msg += "Preencha o campo Rua\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "rua" && f[i].value != ""){
				                f[i].style.border = "1px solid #898989";
				              }

				              if(f[i].name == "num"){
				                if(f[i].value == ""){
				                  msg += "Preencha o campo Número!\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                    if(f[i].value <= 0){
				                        msg += "Insira um valor acima de 0 no campo Número!\n";
				                        f[i].style.border = "1px solid #FF0000";
				                        erros++;
				                    }else{
				                        f[i].style.border = "1px solid #898989";
				                    }
				                }
				                
				              }

				              if(f[i].name == "estado" && f[i].value == "no_sel"){
				                msg += "Selecione um Estado\n";
				                f[i].style.border = "1px solid #FF0000";
				                erros++;
				              }
				              if(f[i].name == "estado" && f[i].value != "no_sel"){
				                f[i].style.border = "1px solid #898989";
				              }
				              if(f[i].name == "superv"){
				                
				                if(!document.getElementById("is_admin").checked && f[i].value == "Selecione um supervisor"){
				                  msg += "Selecione um Supervisor\n";
				                  f[i].style.border = "1px solid #FF0000";
				                  erros++;
				                }else{
				                  f[i].style.border = "1px solid #898989";  
				                }

				              }
				              if(f[i].name == "bairro"){
				                  if(f[i].value == ""){
				                     f[i].style.border = "1px solid #FF0000";
				                     msg += "Selecione um bairro\n";
				                     erros++;
				                  }else{
				                     f[i].style.border = "1px solid #898989";
				                  }
				               }

				          }
				          if(erros>0){            
				              alert(msg);
				            return false;
				          }
				      }
				    
				    function carrega_postos(){
				      var empresa = document.getElementById("empresa").value;
				      if(empresa){
				          var url = '../ajax/ajax_buscar_postos.php?empresa='+empresa;
				          $.get(url, function(dateReturn){
				            $('#load_postos').html(dateReturn);
				          });
				      }
				    }
				    
				    function carregaTipo_custo(tc){
				          
				     var combo = document.getElementById("tipo_custo");
				     for (var i = 0; i < combo.options.length; i++)
				     {
				       if (combo.options[i].value == tc)
				       {
				         combo.options[i].selected = true;
				         
				         break;
				       }
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
				    function mnum(v){
				              v=v.replace(/\D/g,"");                                      //Remove tudo o que não é dígito
				              return v;
				    }
				    function mvalor(v){
				              v=v.replace(/\D/g,"");//Remove tudo o que não é dígito
				              v=v.replace(/(\d)(\d{8})$/,"$1.$2");//coloca o ponto dos milhões
				              v=v.replace(/(\d)(\d{5})$/,"$1.$2");//coloca o ponto dos milhares

				              v=v.replace(/(\d)(\d{2})$/,"$1,$2");//coloca a virgula antes dos 2 últimos dígitos
				           return v;
				     }

				   function mtel(v){
				       if(v.length >=16){
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
				    function dnasc(v){
				       if(v.length >=10){      
				         v = v.substring(0,(v.length - 1));
				         return v;
				       }
				       v=v.replace(/\D/g,""); 
				       v=v.replace(/^(\d{2})(\d{2})(\d{4})/,"$1/$2/$3");  
				       return v;
				   }
				    function mrg(v){
				       if(v.length >=13){
				         v = v.substring(0,(v.length - 1));
				         return v;
				       }
				       v=v.replace(/^(\d{2})(\d{3})(\d{3})(\d{1})/,"$1.$2.$3-$4");
				       return v;
				   }
				   function id( el ){
				     return document.getElementById( el );
				   }
				   window.onload = function(){
				// <<<<<<< HEAD
				//       // mascara( id('sal_base'), mmoney );
				      
				//       id('sal_base').onkeypress = function(){ 
				//           mascara( this, mmoney );
				//       }
				//       // id('custo').onkeypress = function(){ 
				//       //     mascara( this, mmoney );
				//       // }
				// =======
				    

				// >>>>>>> 5fe2ad9570909c5428db36337cb7e025a465b412
				      id('cpf').onkeypress = function(){ 
				          mascara( this, mcpf );
				      };      
				      id('telefone').onkeypress = function(){
				          mascara( this, mtel );
				      };
				      
				      
				   }
				   // fim Mask
				   function validarCPF(cpf) {  
				    cpf = cpf.replace(/[^\d]+/g,'');    
				    if(cpf == '') return false; 
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
				    add = 0;    
				    for (i=0; i < 9; i ++)       
				        add += parseInt(cpf.charAt(i)) * (10 - i);  
				        rev = 11 - (add % 11);  
				        if (rev == 10 || rev == 11)     
				            rev = 0;    
				        if (rev != parseInt(cpf.charAt(9)))     
				            return false;       
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
				function buscar_cid(id_est){
				      var estado = id_est;
				      
				      if(estado){
				        var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;
				        $.get(url, function(dataReturn) {
				          $('#load_cidades').html(dataReturn);
				        });
				      }
				    }
				function buscar_postos(id_empresa){
				      
				      if(id_empresa){
				        var url = '../ajax/ajax_buscar_postos.php?empresa='+id_empresa;
				        $.get(url, function(dataReturn) {
				          $('#load_postos').html(dataReturn);
				        });
				      }
				    }
				function carregaUf_CartTrab(uf){
				      var combo = document.getElementById("uf_cart_trab");
				      for (var i = 0; i < combo.options.length; i++)
				      {
				        if (combo.options[i].value == uf)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				  function carregaUf(uf){
				      var combo = document.getElementById("estado");
				      for (var i = 0; i < combo.options.length; i++)
				      {
				        if (combo.options[i].value == uf)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				    function carregaSuperv(sup){
				      var combo = document.getElementById("superv");
				      for (var i = 0; i < combo.options.length; i++)
				      {
				        if (combo.options[i].value == sup)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				  function carregaEmpresa(empresa){
				      
				      var combo = document.getElementById("empresa");
				      for (var i = 0; i < combo.options.length; i++)
				      {
				        if (combo.options[i].value == empresa)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				    function carregaSuperv(sup){
				      var combo = document.getElementById("superv");
				      for (var i = 0; i < combo.options.length; i++)
				      {
				        if (combo.options[i].value == sup)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				  function carregaPostosTrabalho(){
				      var combo = document.getElementById("empresa_filial");
				      var posto = document.getElementById("id_posto").value;

				      for (var i = 0; i < combo.length; i++)
				      {

				        if (combo.options[i].value == posto)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				    function carregaTurno(turno){
				      var combo = document.getElementById("turno");
				      for (var i = 0; i < combo.options.length; i++)
				      {
				        if (combo.options[i].value == turno)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				    function carregaCBO(cbo){
				      var combo = document.getElementById("cbo");
				      for (var i = 0; i < combo.options.length; i++)
				      {
				        if (combo.options[i].value == cbo)
				        {
				          combo.options[i].selected = true;
				          break;
				        }
				      }
				    }
				     function carregaCidade(){
				        var combo = document.getElementById("cidade");
				        var cidade = document.getElementById("id_cidade").value;
				  
				        for (var i = 0; i < 1000; i++)
				         {
				           if (combo.options[i].value == cidade)
				               {
				               combo.options[i].selected = true;
				               break;
				             }
				           } 
				      }
				  function disparaLoadCidade(){
				      carrega_postos();
				      setTimeout(function() {
				         carregaCidade();
				        }, 500);
				      }

				  function mudaValor(){
				        if(document.getElementById("estagiario").value == 0){
				          $('#salario').html("Bolsa: ");
				          document.getElementById("estagiario").value = 1;
				          document.getElementById("cpf").required = false;
				        }else{
				          $('#salario').html("Salário Base: ");
				          document.getElementById("estagiario").value = 0;
				          document.getElementById("cpf").required = true;
				        }
				    }
		</script>
		<?php
	}// fim getScriptFuncionario()

	function getScriptCBO(){
		?>
		<script type="text/javascript">
			   function selectAll(){
			      var select = document.getElementById("selecionados");
			      for(i=0; i<select.length; i++){
			         select[i].selected = true;
			      }
			   }
			   function validate(f){ 
			      var erros=0;   
			      for(i=0; i<f.length; i++){
			         if(f[i].name == "codigo"){
			            if(f[i].value == ""){
			               f[i].style.border = "1px solid #f00";
			               erros++;
			            }else{
			              f[i].style.border = "1px solid #898989";
			            }
			         }
			         if(f[i].name == "descricao"){
			            if(f[i].value == ""){
			               f[i].style.border = "1px solid #f00";
			               erros++;
			            }else{
			              f[i].style.border = "1px solid #898989";
			            }
			         }
			      }
			      if(erros>0){
			         return false;
			      }else{
			         return true;
			      }

			   }
			</script>

		<?php
	}// fim getScriptCBO()

	function getScriptCliente(){
		?>
		<script type="text/javascript">

				function confirma(id,nome, tipopess){
			       if(confirm("Excluir cliente "+nome+" , tem certeza?") ){
			          var url = '../ajax/ajax_excluir_cliente.php?id='+id+'&nome='+nome+'&tipopess='+tipopess;  //caminho do arquivo php que irá buscar as cidades no BD
			          
			          $.get(url, function(dataReturn) {
			            $('#result').html(dataReturn);  //coloco na div o retorno da requisicao
			            window.location.href='add_cliente.php';
			          });
			       }
			    }
				
				function tipo_form(){
					
					// if(document.getElementById("fornecedor").checked){
					// 	document.getElementById("fornecedor").value=0;
					// }else{
					// 	document.getElementById("fornecedor").value=1;
					// }

					if(document.getElementById("pessoa_fisica").checked == true){
						document.getElementById("razao_nome").innerHTML = "<span>Nome:</span>";
						document.getElementById("data_nasc").value = "0000-00-00";
						document.getElementById("data_fun_data_nasc").innerHTML = "<span>Data de Nascimento:</span>";
						document.getElementById("cnpj_cpf").innerHTML = "<span>CPF:</span>";
						document.getElementById("data_nasc").disabled = false;
						document.getElementById("cnpj").type = "hidden";
						document.getElementById("cnpj").value ="";
						document.getElementById("cpf").type="text";
						document.getElementById("inscricao_estadual_rg").innerHTML = "<span>RG:</span>";			
						document.getElementById("inscricao_estadual").type="hidden";
						document.getElementById("inscricao_estadual").value="";
						document.getElementById("rg").type="text";			
						document.getElementById("inscricao_municipal").type="hidden";
						document.getElementById("inscricao_municipal").value="";
						document.getElementById("inscricao_municipal_nulo").innerHTML = "";
					}

					if(document.getElementById("pessoa_juridica").checked == true){
						document.getElementById("razao_nome").innerHTML = "<span>Razao Social:</span>";
						document.getElementById("data_fun_data_nasc").innerHTML = "<span>Data registro:</span>";
						document.getElementById("data_nasc").value = document.getElementById('today').value;
						document.getElementById("data_nasc").disabled = true;
						document.getElementById("cnpj_cpf").innerHTML = "<span>CNPJ:</span>";
						document.getElementById("cnpj").type = "text";
						document.getElementById("cpf").value ="";
						document.getElementById("cpf").type="hidden";	
						document.getElementById("inscricao_estadual_rg").innerHTML = "<span>Inscrição Estadual:</span>";
						document.getElementById("inscricao_estadual").name= "inscricao_estadual";
						document.getElementById("inscricao_estadual").type="text";
						document.getElementById("rg").type = "hidden";
						document.getElementById("rg").value = "";
						document.getElementById("inscricao_municipal").type="number";
						document.getElementById("inscricao_municipal_nulo").innerHTML="<span>Inscrição Municipal:</span>";
						document.getElementById("inscricao_municipal").name="inscricao_municipal";		
					}
				}

					

				 	function valida(f){
				        var erros = 0;
				        var msg = "";
				          for (var i = 0; i < f.length; i++) {

				          	//Dados Empresa ou dados Pessoais
				      

				         	if(document.getElementById("pessoa_fisica").checked == true) //
				         	{
				         		
				         	}else{
				         		      if(f[i].name == "nome"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "data_nasc"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "cpf" && document.getElementById("pessoa_juridica").checked != true){
					            if(f[i].value == ""){
					               alert("Digite um cpf");
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
					            if(!validarCPF(f[i].value)){
					               alert("Digite um cpf valido");
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	
				         	if(f[i].name == "com"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					            	      if(f[i].name == "nome"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "data_nasc"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "cpf" && document.getElementById("pessoa_juridica").checked != true){
					            if(f[i].value == ""){
					               alert("Digite um cpf");
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
					            if(!validarCPF(f[i].value)){
					               alert("Digite um cpf valido");
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "cel"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "com"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

					               f[i].style.border = "1px solid #898989";
			                                }
			                            }
				        	}

				         	//Dados de endereço 

				         	if(f[i].name == "bairro"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "rua"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "numero"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "cidade"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
				         	}

				         	if(f[i].name == "cep"){
					            if(f[i].value == ""){
					               f[i].style.border = "1px solid #FF0000";
					               erros++;
					            }else{
					               f[i].style.border = "1px solid #898989";
					            }
			                            }
						}
						if(erros>0){
							return false;
						}else{
							return true;
						}
				 }

				 	    // inicio mascaras
			    function mascara(o,f){
			          v_obj=o
			          v_fun=f
			          setTimeout("execmascara()",1)
			      }
			      function execmascara(){
			          v_obj.value=v_fun(v_obj.value)
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
			   function mtel(v){
			       if(v.length >=15){                                          // alert("mtel")
			         v = v.substring(0,(v.length - 1));
			         return v;
			       }
			       v=v.replace(/\D/g,"");             //Remove tudo o que não é dígito
			       v=v.replace(/^(\d{2})(\d)/g,"($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
			       v=v.replace(/(\d)(\d{4})$/,"$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos
			       
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
			    function dnasc(v){
			       if(v.length >=10){      
			         v = v.substring(0,(v.length - 1));
			         return v;
			       }
			       v=v.replace(/\D/g,""); 
			       v=v.replace(/^(\d{2})(\d{2})(\d{4})/,"$1/$2/$3");  
			       return v;
			   }
			    function mrg(v){
			       if(v.length >=13){
			         v = v.substring(0,(v.length - 1));
			         return v;
			       }
			       v=v.replace(/^(\d{2})(\d{3})(\d{3})(\d{1})/,"$1.$2.$3-$4");
			       return v;
			   }
			   function id( el ){
			     // alert("id")
			     return document.getElementById( el );
			   }

			   function validarCPF(cpf) {
			   
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

			   window.onload = function(){ 

			   	     		
			   	  id('cnpj').onkeypress = function(){
			              mascara( this, mcnpj );
			      }
			      id('cpf').onkeypress = function(){
			           mascara( this, mcpf );
			      }
			      id('cpf_resp').onkeypress = function(){
			          mascara( this, mcpf );
			      }
			      id('com').onkeypress = function(){
			          mascara( this, mtel );
			      }
			      id('cel').onkeypress = function(){
			          mascara( this, mtel );
			      }      
			     
			   }
			   
				function carregaCidade(){
			      var combo = document.getElementById("cidade");
			      var cidade = document.getElementById("id_cidade").value;
			      
			      for (var i = 0; i < combo.length; i++)
			      {
			         
			        if (combo.options[i].value == cidade)
			        {
			          combo.options[i].selected = true;
			          break;
			        }
			      }
			      
			    }
			    function buscar_cid(id_est){
			      var estado = id_est;  //codigo do estado escolhido
			      //se encontrou o estado
			      if(estado){
			        var url = '../ajax/ajax_buscar_cidades.php?estado='+estado;  //caminho do arquivo php que irá buscar as cidades no BD
			        $.get(url, function(dataReturn) {
			          $('#load_cidades').html(dataReturn);  //coloco na div o retorno da requisicao
			        });
			      }
			    }

				function disparaLoadCidade(){
			      setTimeout(function() {
			         carregaCidade();
			         carregaPostosTrabalho();
			        }, 500);
			    }

				function carregaUf(uf){
			      var combo = document.getElementById("estado");
			      for (var i = 0; i < combo.options.length; i++)
			      {
			        if (combo.options[i].value == uf)
			        {
			          combo.options[i].selected = true;
			          
			          break;
			        }
			      }
			    }  

			</script>

		<?php

	}// fim getScriptCliente()
}
?>