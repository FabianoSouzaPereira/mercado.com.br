<?php
	include "config_ajax.php";
	
	include 'vendasModel.php';
	
	$total=0;
	foreach($_SESSION['carrinho'] AS $i=>$curso)
		$total += $curso['valor'];
	
	$dados['valor_total'] = $total;
	
	if($dados['valor_total']==0){
		$dados['status'] = 1;
	} else {
		$dados['status'] = 0;
	}
	
	$modelVendas = new vendasModel();
	$vendas_id = $modelVendas->cadastrar($dados);	
	$dados['vendas_id'] = $vendas_id;
	
	if(isset($_SESSION['carrinho']) && isset($_SESSION['aluno']) && $_SESSION['aluno']['login']===true){
		foreach($_SESSION['carrinho'] AS $i=>$curso){
			$dados['cursos_id'] = $curso['id'];
			$dados['valor'] = $curso['valor'];
			$modelVendas->cadastrarCurso($dados);
		}
		unset($_SESSION['carrinho']);
		if($dados['status']==1)
			echo "sucesso";
		else 
			echo $vendas_id;
		
	} else {
		echo -1;
	}
		
?>
