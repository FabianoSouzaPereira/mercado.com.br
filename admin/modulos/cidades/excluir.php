<?php 

	//Resgatar o id da cidade a ser excluida
	$id = intval($_GET['id']);
	
	
	//Verificar se o parametro confirmar está na URL
	if(isset($_GET['confirmar'])){
		//Se o parametro existir, deletar do banco de dados
		$sql = "UPDATE cidades SET status=0 WHERE id=$id";
		
		//Executar o sql na conexao e armazenar a resposta
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		
		//Verificar se deu certa a exclusao
		if($res==1){
			//Redirecionar para listagem de cidades
			header('location: index.php?pagina=cidades_listar');
		}
	}
	
	//Script para Selecionar o nome da cidade que será excluída
	$sql = "SELECT nome FROM cidades WHERE id=$id";
	
	//Executar o script sql na conexão e armazenar a resposta
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	
	//Extrair a linha da variavel $res
	$estado = mysqli_fetch_array($res);
	
?>

<div class="formulario">
	<div class="panel panel-danger">
	<div class="panel-heading"><h4>Excluindo cidade <?php echo $estado['nome']; ?></h4></div>
		<div class="panel-body">
			Deseja realmente excluir a cidade <b><?php echo $estado['nome']; ?></b>?
			<br><br>
			<div>
				<a href="index.php?pagina=cidades_excluir&id=<?php echo $id; ?>&confirmar" class="btn btn-success">Confirmar Exclusão</a>
				<a href="index.php?pagina=cidades_listar" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
	
</div>