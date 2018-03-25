<?php
	session_start();
	$total=0;
	
	if(isset($_SESSION['carrinho']))
		foreach( $_SESSION['carrinho'] as $curso ){ 
			$total += $curso['valor'];
		}
			
	echo "R$".number_format($total, 2, ",", ".");
?>