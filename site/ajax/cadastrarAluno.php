<?php
	include "config_ajax.php";
	
	include 'alunosModel.php';
	$nome = $_GET['nome'];
	$telefone = $_GET['telefone'];
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	
	
	if($nome=="" || $email=="" || $senha==""){
		die("Existem campos vazios");
	}
		
		
	$mdados['fnome'] = strip_tags($nome);
	$mdados['ftelefone'] = strip_tags($telefone);
	$mdados['femail'] = strip_tags($email);
	$mdados['fsenha'] = strip_tags($senha);
	
	$modelVendas = new alunosModel();
	echo $modelVendas->cadastrar($mdados);		
	
?>
