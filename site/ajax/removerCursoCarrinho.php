<?php
	session_start();
			
	$i = $_GET['i'];

	if( isset($_SESSION['carrinho'][$i]) )
		unset($_SESSION['carrinho'][$i]);
	
?>