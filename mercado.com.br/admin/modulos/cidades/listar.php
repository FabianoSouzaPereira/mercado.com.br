<?php 

	if(isset($_GET['pesquisa'])){
		
		$pesquisa = $_GET['pesquisa'];		
		$sql = "SELECT 
					c.id, 
					c.nome AS cidade, 
					e.nome AS estado,
					e.sigla 
				FROM 
					estados e, cidades c 
				WHERE
					c.estado_id = e.id
				AND
					c.status=1
				AND
					(c.nome LIKE '$pesquisa%' OR e.nome LIKE '$pesquisa%' OR e.sigla LIKE '$pesquisa%')
				ORDER BY 
					estado ASC, cidade ASC";
		
	}else{
		
		$sql = "SELECT
					c.id,
					c.nome AS cidade,
					e.nome AS estado,
					e.sigla
				FROM
					estados e, cidades c
				WHERE
					c.estado_id = e.id
				AND
					c.status=1
				ORDER BY
					estado ASC, cidade ASC";
	
	}
	//Executar o sql na conexão $con
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );

?>
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3>Listando Cidades</h3>
	</div>

	<div class="panel-body">
		<a href="index.php?pagina=cidades_cadastrar" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"> </span> Nova Cidade</a>
		<br><br>
		
		
		
		
		<!-- FORMULÁRIO PARA PESQUISA -->
		<form action="" method="get">
			<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<div class="input-group">
				<input type="text" value="<?php echo @$_GET['pesquisa']; ?>" name="pesquisa" class="form-control" placeholder="Pesquise pelo nome da cidade, nome do estado ou sigla do estado" autofocus>
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
					<th>Estado/Sigla</th>
					<th width="90px">Editar</th>
					<th width="90px">Excluir</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while($linha=mysqli_fetch_assoc($res)){ ?>
					<tr>
						<td><b> <?php echo $linha['id']; ?> </b></td>
						<td><?php echo $linha['cidade']; ?></td>
						<td><?php echo $linha['estado']." / ".$linha['sigla']; ?></td>
						<td><a href="index.php?pagina=cidades_editar&id=<?php echo $linha['id']; ?>">Editar</a></td>
						<td><a href="index.php?pagina=cidades_excluir&id=<?php echo $linha['id']; ?>">Excluir</a></td>
					</tr>
				<?php } ?>
				
			</tbody>
			
			<tfoot>
				<tr>
					<th colspan="5" class="text-center"><?php echo date('d/m/Y h:i:s'); ?></th>
				</tr>
			</tfoot>
			
		</table>
	</div>
</div>