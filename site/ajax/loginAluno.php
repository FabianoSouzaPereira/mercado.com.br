<?php
	include "config_ajax.php";
	
	include 'alunosModel.php';
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	
	
	if($email=="" || $senha==""){
		die("Existem campos vazios");
	}
		
		
	$mdados['femail'] = strip_tags($email);
	$mdados['fsenha'] = strip_tags($senha);
	
	$modelVendas = new alunosModel();
	$dadosLogin = $modelVendas->autenticar($mdados);
	
	if(!empty($dadosLogin)){
		$_SESSION['aluno']['login'] = true;
		$_SESSION['aluno']['id'] = $dadosLogin['id'];
		$_SESSION['aluno']['nome'] = $dadosLogin['nome'];
	} else {
		unset($_SESSION['aluno']);
		echo 0;
		die;
	}
	
?>


<div id="painel-aluno">
		<div style="background: #003366; float: right; padding: 2%; border-radius: 5px;">
			  <h4 class="media-heading" style="color: #FFF; font-size: 15px;">Bem Vindo, <?php echo $_SESSION['aluno']['nome']; ?></h4>
			  <div class="col-sm-7">
			  		<a title="Clique aqui para realizar o acesso" class="label label-success" style="font-size: 10px;" href="../aluno/"><span class="glyphicon glyphicon-user"> </span> Acessar</a>
			  </div>
			  <div class="col-sm-5">
			  		<a title="Clique aqui para sair do sistema de aluno" class="label label-danger" style="font-size: 10px;" href="javascript:void(0)" onclick="logout()" ><span class="glyphicon glyphicon-road"> </span> Sair</a>	
			  </div>
		</div>
</div>
