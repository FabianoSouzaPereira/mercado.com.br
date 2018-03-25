<?php

use dao\Connection;

session_start();
//Incluir a conexão com banco de dados
include 'application/dao/Connection.php';
date_default_timezone_set("Etc/GMT+3");

function login($email,$password){
    
    $sql = "SELECT idlog, logname FROM login
        WHERE logemail= ? AND logpassword=md5(?)
        AND logBlocked = 'no' AND logstatus = 1;";
    $res = Connection::getInstance();
    $stmt = $res->prepare($sql);
    if(!$stmt->execute(array($email, $password))){
        echo '<pre> erro: ';
        print_r($stmt->errorInfo());
        exit;
    }
    $select = $stmt->fetch();
    return $select;
}

if(!empty($_POST)){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $dados= $self.login($email, $password);
    
    if(empty($dados)){
        echo "<script>alert('Seu login falhou. LOGIN: admin@admin.com SENHA: 1234');</script>";
    } else {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $dados['id'];
        $_SESSION['name'] = $dados['name'];
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
					<input type="text" class="form-control" name="email" id="email" placeholder="Digite seu e-mail de acesso" required autofocus >
				</div>
				<div class="form-group">
					<label for="password">Senha</label>
					<input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha" required autofocus >
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-success" value="Acessar" >
					<a href="" class="label label-warning" style="float:right;">Esqueci a senha!</a>
				</div>
			</div>
		</form>
	</body>
</html>