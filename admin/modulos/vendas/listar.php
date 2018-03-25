<?php 

	$sql = "SELECT
				v.id,
				v.data_venda,
				v.hora_venda,
				v.valor_total,
				c.nome AS cliente,
				f.nome AS funcionario
			FROM
				vendas v, clientes c, funcionarios f
			WHERE
				v.funcionario_id = f.id
			AND
				v.cliente_id = c.id
			AND
				v.status=1";

	if(isset($_GET['pesquisa'])){
		$pesquisa = $_GET['pesquisa'];
		
		$sql .= " AND (c.nome LIKE '$pesquisa%' OR f.nome LIKE '$pesquisa%')";
	}


	
	//Executar o sql na conexão $con
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );

?>

<div class="panel panel-warning">
	<div class="panel-heading">
		<h3>Listando Vendas</h3>
	</div>
	
	<div class="panel-body">
	
		<a href="index.php?pagina=vendas_cadastrar" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"> </span> Nova Venda</a>
		<br><br>
	
	
		
		<!-- FORMULÁRIO PARA PESQUISA -->
		<form action="" method="get">
			<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<div class="input-group">
				<input type="text" value="<?php echo @$_GET['pesquisa']; ?>" name="pesquisa" class="form-control" placeholder="Pesquise por nome do cliente ou funcionário" autofocus>
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
					<th>Funcionário</th>
					<th>Data - Hora</th>
					<th>Total (R$)</th>
					<th width="90px">Produtos</th>
					<th width="90px">Editar</th>
					<th width="90px">Excluir</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while($linha=mysqli_fetch_array($res)){ ?>
					<tr>
						<td><b> <?php echo $linha['id']; ?> </b></td>
						<td><?php echo $linha['cliente']; ?></td>
						<td><?php echo $linha['funcionario']; ?></td>
						<td><?php echo Conversor::dataBancoParaUsuario($linha['data_venda'])." - ".$linha['hora_venda']; ?></td>
						<td><?php echo number_format($linha['valor_total'], 2, ",", "."); ?></td>
						<td><a href="index.php?pagina=vendas_produtos&venda_id=<?php echo $linha['id']; ?>">Produtos</a></td>
						<td><a href="index.php?pagina=vendas_editar&id=<?php echo $linha['id']; ?>">Editar</a></td>
						<td><a href="index.php?pagina=vendas_excluir&id=<?php echo $linha['id']; ?>">Excluir</a></td>
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