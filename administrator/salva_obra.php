<?php 
session_start();
include_once("../model/class_obra.php");
include_once("../model/class_obra_produtos.php");
	 
	echo 'Dados Obra<hr>';
     $obra_dados = new Obra();
     $obra_dados->add_dados_obra();
     print_r($obra_dados);

     //adiciona obra no banco e pega id_obra

     $id_obra = 1;
     echo '<hr>';
     echo '<br />';
     echo 'Produtos Obra<hr>';
     $lista_produtos = Obra_produtos::add_obra_produtos($id_obra);
     print_r($lista_produtos);
     echo '<hr>';
     echo '<br />';

     $obra_dados->printObra();
 	