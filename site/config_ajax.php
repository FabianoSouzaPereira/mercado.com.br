<?php
	ob_start();
	//error_reporting(0);
	session_start();

	date_default_timezone_set("Etc/GMT+3");
	
	//diretorios a serem definidos no include patch
	$mincludes = array( "../../configuracoes", "../../bibliotecas", "../../admin/modulos", "../../admin/modulos/control", "../../admin/modulos/model", "../../admin/modulos/view",  get_include_path() );

	//monta string com os diretrios par o include path
	$vincludes = implode( PATH_SEPARATOR, $mincludes );
	
	//seta os novos diretorios que os arquivos de include farão uma busca
	set_include_path( $vincludes );
	
	
	//includes
	include "Zend/Db.php";
	include "conexao.php";
	include "contador/contador.php";	
	include 'main/main2.php';
?>