<?php 

	if(isset($_GET['pesquisa'])){
		
		$pesquisa = $_GET['pesquisa'];		
		$sql = "SELECT
					p.id,
					p.nome AS produto,
					p.valor,
					p.imagem,
					c.nome AS categoria
				FROM
					categorias c, produtos p
				WHERE
					p.categoria_id = c.id
				AND
					p.status = 1
				AND
					(p.nome LIKE '%$pesquisa%' OR c.nome LIKE '$pesquisa%')
				ORDER BY
					categoria ASC, produto ASC";
		
	}else{
		
		$sql = "SELECT
					p.id,
					p.nome AS produto,
					p.valor,
					p.imagem,
					c.nome AS categoria
				FROM
					categorias c, produtos p
				WHERE
					p.categoria_id = c.id
				AND
					p.status = 1
				ORDER BY
					categoria ASC, produto ASC";
	
	}
	//Executar o sql na conexão $con
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );

?>
<div class="panel panel-warning">
	<div class="panel-heading">
		<h3>Listando Produtos</h3>
	</div>

	<div class="panel-body">
		<a href="index.php?pagina=produtos_cadastrar" class="btn btn-primary"> <span class="glyphicon glyphicon-plus"> </span> Novo Produto</a>
		<br><br>
		
		
		
		
		<!-- FORMULÁRIO PARA PESQUISA -->
		<form action="" method="get">
			<input type="hidden" name="pagina" value="<?php echo $_GET['pagina']; ?>" >
			<div class="input-group">
				<input type="text" value="<?php echo @$_GET['pesquisa']; ?>" name="pesquisa" class="form-control" placeholder="Pesquise pelo nome do produto ou da categoria" autofocus>
				<span class="input-group-btn">
					<input class="btn btn-success" type="submit" value="Pesquisar">
				</span>
			</div>
			
		</form>
		<!-- FORMULÁRIO PARA PESQUISA -->
		
		
		
		
		
		
		<table class="listagem table table-bordered table-striped table-responsive">
			<thead>
				<tr>
					<th width="200">Imagem</th>
					<th>Categoria</th>
					<th>Produto</th>
					<th>Valor</th>
					<th width="90px">Editar</th>
					<th width="90px">Excluir</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while($linha=mysqli_fetch_assoc($res)){ ?>
					<tr>
						<td align="center"><img style="width:150px" class="thumbnail" src="<?php echo (($linha['imagem']!="") ? $linha['imagem'] : 'imagens/sem-imagem.jpg'); ?>" ></td>
						<td><?php echo $linha['categoria']; ?></td>
						<td><?php echo $linha['produto']; ?></td>
						<td><?php echo number_format($linha['valor'], 2, ",", "."); ?></td>
						<td><a href="index.php?pagina=produtos_editar&id=<?php echo $linha['id']; ?>">Editar</a></td>
						<td><a href="index.php?pagina=produtos_excluir&id=<?php echo $linha['id']; ?>">Excluir</a></td>
					</tr>
				<?php } ?>
				
			</tbody>
			
			<tfoot>
				<tr>
					<th colspan="6" class="text-center"><?php echo date('d/m/Y h:i:s'); ?></th>
				</tr>
			</tfoot>
			
		</table>
	</div>
</div>