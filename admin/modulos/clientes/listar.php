<?php 

	if(isset($_GET['pesquisa'])){
		
		$pesquisa = $_GET['pesquisa'];		
		$sql = "SELECT
					cli.id,
					cli.nome As cliente,
					cli.data_nascimento,
					cli.telefone,
					cli.email,
					c.nome AS cidade,
					e.sigla AS uf
				FROM
					estados e, cidades c, clientes cli
				WHERE
					cli.cidade_id = c.id
				AND
					c.estado_id = e.id
				AND
					(cli.nome LIKE '$pesquisa%' OR cli.telefone LIKE '$pesquisa%' OR c.nome LIKE '$pesquisa%')
				AND
					cli.status=1";
		
	}else{
		
		$sql = "SELECT
					cli.id,
					cli.nome As cliente,
					cli.data_nascimento,
					cli.telefone,
					cli.email,
					c.nome AS cidade,
					e.sigla AS uf
				FROM
					estados e, cidades c, clientes cli
				WHERE
					cli.cidade_id = c.id
				AND
					c.estado_id = e.id
				AND
					cli.status=1";
	
	}
	//Executar o sql na conexão $con
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );

?>

<div class="panel panel-warning">
	<div class="panel-heading">
		<h3>Listando Clientes</h3>
	</div>

	<div class="panel-body">
		<a href="index.php?pagina=clientes_cadastrar" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"> </span> Novo Cliente</a>
		<br><br>
		
		
		<!-- FORMULÁRIO PARA PESQUISA -->
		<form action="" method="get">
			<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<div class="input-group">
				<input type="text" value="<?php echo @$_GET['pesquisa']; ?>" name="pesquisa" class="form-control" placeholder="Pesquise pelo nome do cliente, telefone ou cidade" autofocus>
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
					<th>Cliente</th>
					<th>Data Nascimento</th>
					<th>Telefone</th>
					<th>E-mail</th>
					<th>Cidade|UF</th>
					<th width="90px">Editar</th>
					<th width="90px">Excluir</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while($linha=mysqli_fetch_assoc($res)){ ?>
					<tr>
						<td><b> <?php echo $linha['id']; ?> </b></td>
						<td><?php echo $linha['cliente']; ?></td>
						<td><?php echo Conversor::dataBancoParaUsuario($linha['data_nascimento']); ?></td>
						<td><?php echo $linha['telefone']; ?></td>
						<td><?php echo $linha['email']; ?></td>
						<td><?php echo $linha['cidade']." | ". strtoupper($linha['uf']); ?></td>
						<td><a href="index.php?pagina=clientes_editar&id=<?php echo $linha['id']; ?>">Editar</a></td>
						<td><a href="index.php?pagina=clientes_excluir&id=<?php echo $linha['id']; ?>">Excluir</a></td>
					</tr>
				<?php } ?>
				
			</tbody>
			
			<tfoot>
				<tr>
					<th colspan="8" class="text-center"><?php echo date('d/m/Y h:i:s'); ?></th>
				</tr>
			</tfoot>
			
		</table>
	</div>
</div>