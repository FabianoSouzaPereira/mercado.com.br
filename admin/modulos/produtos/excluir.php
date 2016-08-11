<?php 

	//Resgatar o id da cidade a ser excluida
	$id = intval($_GET['id']);
	
	
	//Script para Selecionar o nome da cidade que será excluída
	$sql = "SELECT nome, imagem FROM produtos WHERE id=$id";
	
	//Executar o script sql na conexão e armazenar a resposta
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	
	//Extrair a linha da variavel $res
	$produto = mysqli_fetch_array($res);
	
	
	//Verificar se o parametro confirmar está na URL
	if(isset($_GET['confirmar'])){
		//Se o parametro existir, deletar do banco de dados
		$sql = "UPDATE produtos SET status=0 WHERE id=$id";
		
		//Executar o sql na conexao e armazenar a resposta
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		
		//Verificar se deu certa a exclusao
		if($res==1){
			
			//Deleta da pasta a imagem do produto
			//if(file_exists($produto['imagem'])==true)
				//unlink($produto['imagem']);
			
			//Redirecionar para listagem de cidades
			header('location: index.php?pagina=produtos_listar');
		}
	}
	
?>

<div class="formulario">
	<div class="panel panel-danger">
	<div class="panel-heading"><h4>Excluindo produto <?php echo $produto['nome']; ?></h4></div>
		<div class="panel-body">
			Deseja realmente excluir o produto <b><?php echo $produto['nome']; ?></b>?
			<br><br>
			<img class="thumbnail" style="width: 240px;" src="<?php echo (($produto['imagem']!="") ? $produto['imagem'] : 'imagens/sem-imagem.jpg'); ?>" >
			<div>
				<a href="index.php?pagina=produtos_excluir&id=<?php echo $id; ?>&confirmar" class="btn btn-success">Confirmar Exclusão</a>
				<a href="index.php?pagina=produtos_listar" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
	
</div>