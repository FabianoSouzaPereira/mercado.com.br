<?php 

	//Resgatar o id da cidade a ser excluida
	$id = intval($_GET['id']);
	
	
	//Verificar se o parametro confirmar está na URL
	if(isset($_GET['confirmar'])){
		//Se o parametro existir, deletar do banco de dados
		$sql = "UPDATE vendas SET status=0 WHERE id=$id";
		
		//Executar o sql na conexao e armazenar a resposta
		$res = mysqli_query($con, $sql) or die(mysqli_error($con));
		
		//Verificar se deu certa a exclusao
		if($res==1){
			//Redirecionar para listagem de cidades
			header('location: index.php?pagina=vendas_listar');
		}
	}
	
	//Script para Selecionar o nome da cidade que será excluída
	$sql = "SELECT
				v.valor_total,
				c.nome AS cliente,
				f.nome AS funcionario
			FROM 
				vendas v, funcionarios f, clientes c
			WHERE 
				v.funcionario_id = f.id
			AND
				v.cliente_id = c.id
			AND
				v.id=$id";
	
	//Executar o script sql na conexão e armazenar a resposta
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	
	//Extrair a linha da variavel $res
	$venda = mysqli_fetch_array($res);
	
?>

<div class="formulario">
	<div class="panel panel-danger">
	<div class="panel-heading"><h4>Excluindo venda do cliente <?php echo $venda['cliente']; ?></h4></div>
		<div class="panel-body">
			Deseja realmente excluir a venda do cliente <b><?php echo $venda['cliente']; ?></b>?
			<br>
			Funcionário responsável: <b><?php echo $venda['funcionario']; ?></b>
			<br><br>
			<div>
				<a href="index.php?pagina=vendas_excluir&id=<?php echo $id; ?>&confirmar" class="btn btn-success">Confirmar Exclusão</a>
				<a href="index.php?pagina=vendas_listar" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
	
</div>