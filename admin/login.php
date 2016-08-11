<?php
	session_start();
	//Incluir a conexão com banco de dados
	include 'conexao.php';
	date_default_timezone_set("Etc/GMT+3");
	
	if(!empty($_POST)){
		$email = $_POST['femail'];
		$senha = $_POST['fsenha'];
		
		$sql = "SELECT id, nome FROM funcionarios WHERE email='$email' AND senha=md5('$senha')";
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		$dados = mysqli_fetch_assoc($res);
		
		if(empty($dados)){
			echo "<script>alert('Seu login falhou. LOGIN: admin@admin.com SENHA: 123');</script>";
		} else {
			$_SESSION['logado'] = true;
			$_SESSION['id'] = $dados['id'];
			$_SESSION['nome'] = $dados['nome'];
			header("location: index.php");
		}
		
	}
	
?>

<!Doctype html>
<html lang="pt-br">
	<head>
		<title>Mercado PW</title>
		<meta charset="utf8">
		<!-- Chamada do CSS -->
		<link rel="stylesheet" href="css/estilo.css" >
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		
		<script src="bootstrap/js/jquery-1.12.4.min.js"></script>
  		<script src="bootstrap/js/bootstrap.min.js"></script>
	</head>
	
	<body>
		
		<form id="login" action="" method="post"  class="panel panel-warning">
		
			<div class="panel-heading">
				<h3>Acesso Restrito - Faça seu login</h3>
			</div>
			
			<div class="panel-body">
			
				<div class="form-group">
					<label for="email">E-mail</label>
					<input type="text" class="form-control" name="femail" id="email" placeholder="Digite seu e-mail de acesso" required autofocus >
				</div>
				
			
				<div class="form-group">
					<label for="senha">Senha</label>
					<input type="password" class="form-control" name="fsenha" id="senha" placeholder="Digite sua senha" required autofocus >
				</div>
				
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Acessar" >
					<a href="" class="label label-warning" style="float:right;">Esqueci a senha!</a>
				</div>
				
			</div>
		</form>
		
	</body>

</html>