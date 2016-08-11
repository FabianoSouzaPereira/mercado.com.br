<?php 

	$venda_id = $_GET['venda_id'];

	if(!empty($_POST)){
		
		$produto_id = intval($_POST['fproduto_id']);
		$quantidade = intval($_POST['fquantidade']);
		
		//Validacao
		$valida = true;
		$mensagemErro = "";
		
		if(Validador::ehNulo($produto_id)==true){
			$valida = false;
			$mensagemErro .= "<li>O produto é <b>obrigatório</b></li>";
		}
		
		//sql para insert
		$sql = "INSERT INTO 
					itens_venda(venda_id, produto_id, quantidade, valor)
				VALUES
					($venda_id, $produto_id, $quantidade, 
						(SELECT valor FROM produtos WHERE id=$produto_id))";
		$res = mysqli_query($con, $sql) or die("Erro");
		if($res==1){
			//Redirecionar para a mesma página
			
			//Atualizar o total da venda
			$sql = "UPDATE
						vendas
					SET
						valor_total=valor_total+$quantidade*(SELECT valor FROM produtos WHERE id=$produto_id)
					WHERE
						id=$venda_id";
			mysqli_query($con, $sql);
			
			header("location: index.php?pagina=vendas_produtos&venda_id=$venda_id");
		}
	}

?>


<form action="" method="post" class="panel panel-warning">

	<div class="panel-heading">
		<h3>Adicionando Produtos</h3>
	</div>
	
	<div class="panel-body">
		
		<div class="form-group">
			<label>Produto</label>
			<select name="fproduto_id" class="form-control">
				<option value="">Selecione...</option>
				<?php 
					$sql = "SELECT
								p.id,
								p.nome As produto,
								c.nome As categoria
							FROM
								categorias c, produtos p
							WHERE
								p.categoria_id = c.id
							ORDER BY
								p.nome ASC";
					$res = mysqli_query($con, $sql) or die('Erro');
					while($linha=mysqli_fetch_assoc($res)){
						echo "<option value='{$linha['id']}'>
						{$linha['produto']} - {$linha['categoria']}</option>";
					}
				
				?>
			</select>
		</div>
		
		<div class="form-group">
			<label class="label label-danger">Quantidade</label>
			<input type="text" name="fquantidade" class="form-control mascaraInteiro" value="1" >
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Ok" >
			<a href="index.php?pagina=vendas_listar" class="btn btn-default">Voltar</a>
		</div>
		
	</div>

</form>


<div class="panel panel-primary">
	<div class="panel-heading">
		<h3>Produtos desta venda</h3>
	</div>
	
	<div class="panel-body">
		<table class="listagem table table-bordered table-striped table-responsive">
			<thead>
				<tr>
					<th>#</th>
					<th>Produto</th>
					<th>Valor</th>
					<th>Qtd</th>
					<th>Subtotal</th>
					<th>Remover</th>
				</tr>
			</thead>
			
			<tbody>
				<?php
					$sql = "SELECT
								iv.id,
								iv.valor,
								iv.quantidade,
								(iv.valor*iv.quantidade) AS subtotal,
								p.nome AS produto,
								p.imagem
							FROM
								itens_venda iv, produtos p
							WHERE
								iv.produto_id = p.id
							AND
								iv.venda_id=$venda_id
							ORDER BY
								iv.id DESC";
					$res = mysqli_query($con, $sql) or die("Erro");
					
					$total = 0;
					while($linha = mysqli_fetch_assoc($res)){
						$total = $total + $linha['subtotal'];
						//$total += $linha['subtotal'];
				?>	
				
				<tr>
					<td><img src="<?php echo $linha['imagem']; ?>" width="100"></td>
					<td><?php echo $linha['produto']; ?></td>
					<td><?php echo Conversor::realBancoParaUsuario($linha['valor']); ?></td>
					<td><?php echo $linha['quantidade']; ?></td>
					<td><?php echo Conversor::realBancoParaUsuario($linha['subtotal']); ?></td>
					<td><a href="index.php?pagina=vendas_removerProduto&item_venda_id=<?php echo $linha['id']; ?>" class="btn btn-danger">-</a></td>
				</tr>
				
				<?php } ?>
				
				<tfoot>
					<tr>
						<td colspan="4" class="text-right"><b>Total:</b></td>
						<td colspan="2">R$ <?php echo Conversor::realBancoParaUsuario($total); ?></td>
					</tr>
				</tfoot>
			</tbody>
			
		</table>
	</div>
</div>



