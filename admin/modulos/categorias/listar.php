<?php 

	if(isset($_GET['pesquisa'])){
		$pesquisa = $_GET['pesquisa'];
		$sql = "SELECT 
					id, nome 
				FROM 
					categorias 
				WHERE 
					nome LIKE '$pesquisa%'
				AND
					status = 1
				ORDER BY 
					nome ASC";
	} else {
		//Criar sql para seleção e todos os dados
		$sql = "SELECT id, nome FROM categorias WHERE status=1 ORDER BY id ASC";
	}


	
	//Executar o sql na conexão $con
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );

?>

<div class="panel panel-warning">
	<div class="panel-heading">
		<h3>Listando Categorias</h3>
	</div>
	
	<div class="panel-body">
	
		<a href="index.php?pagina=categorias_cadastrar" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"> </span> Nova Categoria</a>
		<br><br>
	
	
		
		<!-- FORMULÁRIO PARA PESQUISA -->
		<form action="" method="get">
			<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<div class="input-group">
				<input type="text" value="<?php echo @$_GET['pesquisa']; ?>" name="pesquisa" class="form-control" placeholder="Pesquise por nome da categoria" autofocus>
				<span class="input-group-btn">
					<input class="btn btn-success" type="submit" value="Pesquisar">
				</span>
			</div>
			
		</form>
		<!-- FORMULÁRIO PARA PESQUISA -->
		
		
		
		<table class="listagem table table-bordered table-striped table-responsive">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nome</th>
					<th width="90px">Editar</th>
					<th width="90px">Excluir</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while($linha=mysqli_fetch_array($res)){ ?>
					<tr>
						<td><b> <?php echo $linha['id']; ?> </b></td>
						<td><?php echo $linha['nome']; ?></td>
						<td><a href="index.php?pagina=categorias_editar&id=<?php echo $linha['id']; ?>">Editar</a></td>
						<td><a href="index.php?pagina=categorias_excluir&id=<?php echo $linha['id']; ?>">Excluir</a></td>
					</tr>
				<?php } ?>
				
			</tbody>
			
			<tfoot>
				<tr>
					<th colspan="4" class="text-center"><?php echo date('d/m/Y h:i:s'); ?></th>
				</tr>
			</tfoot>
			
		</table>
	</div>
</div>