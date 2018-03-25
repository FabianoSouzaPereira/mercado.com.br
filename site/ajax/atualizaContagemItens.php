<?php
	session_start();
	echo (int) count(@$_SESSION['carrinho']);
?>