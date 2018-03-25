<?php
	session_start();
			
	$id_produto = $_POST['id_produto'];
	$quantidade_atual = $_POST['quantidadeAtual'];

	if( isset($_SESSION['carrinho'][$id_produto]) ){
		//Adiciona a nova quantidade ao total
		$_SESSION['carrinho'][$id_produto]['quantidade'] = $quantidade_atual;
		$_SESSION['carrinho'][$id_produto]['subtotal'] = $quantidade_atual*$_SESSION['carrinho'][$id_produto]['valor'];
	}
	
	echo $_SESSION['carrinho'][$id_produto]['subtotal'];
	
?>