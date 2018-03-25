<?php

	$host = "localhost";
	$usuario = "root";
	$senha = "";
	$bd = "mercado";
	
	//Realizar a conexão com banco de dados
	$con = mysqli_connect($host, $usuario, $senha, $bd) or die("Erro na conexão com BD");

	//Executar query no banco para ajuste de codificação
	mysqli_query($con, 'SET NAMES utf8');
	
?>