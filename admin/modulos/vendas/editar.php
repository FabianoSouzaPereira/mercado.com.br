<?php 

	$id = intval($_GET['id']);

	//Verificar se o POST não está vazio
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		
		//Resgatar dados do formulário
		$funcionario_id = $_POST['ffuncionario_id'];
		$cliente_id = $_POST['fcliente_id'];
		
		if($funcionario_id!="" && $cliente_id!=""){
			//Montar o sql de insert
			$sql = "UPDATE
						vendas
					SET
						cliente_id = $cliente_id, 
						funcionario_id = $funcionario_id
					WHERE
						id=$id";
			
			//Executar o sql na conexão
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			
			//Verificar a resposta do insert
			if($res==1){
				//Redirecionar para listagem
				header('location: index.php?pagina=vendas_listar');
			} else {
				echo "<h1>Erro ao cadastrar venda</h1>";
			}
			
		} else {
			echo "<script>alert('Preencha todos os campos!');</script>";
		}
		
	}
	
	$sql = "SELECT cliente_id, funcionario_id FROM vendas WHERE id=$id";
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	$venda = mysqli_fetch_assoc($res) or die(mysqli_error($con));
	
?>
<form action="" method="post"  class="panel panel-warning">
		
	<div class="panel-heading">
		<h3>Cadastro de Venda</h3>
	</div>
	
	<div class="panel-body">
		<a href="index.php?pagina=vendas_listar"> <span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
		<br><br>
	
	
		<div class="form-group">
			<label>Funcionário</label>
			
			<?php 
				//Criar sql para seleção de todas os estados
				$sqlFuncionarios = "SELECT id, nome FROM funcionarios WHERE status=1 ORDER BY nome";
				$resFuncionarios = mysqli_query($con, $sqlFuncionarios) or die( mysqli_error($con) );
			?>
			
			<select class="form-control" name="ffuncionario_id" required autofocus>
				<option value="">Selecione um funcionário...</option>
				<?php while($funcionario=mysqli_fetch_assoc($resFuncionarios)){ ?>
					<option <?php if($venda['funcionario_id']==$funcionario['id']) echo "selected"; ?> value="<?php echo $funcionario['id']; ?>"><?php echo $funcionario['nome']; ?></option>
				<?php } ?>
			</select>	
			
		</div>
	
	
		<div class="form-group">
			<label>Cliente</label>
			
			<?php 
				//Criar sql para seleção de todas os estados
				$sqlClientes = "SELECT id, nome, telefone FROM clientes WHERE status=1 ORDER BY nome";
				$resClientes = mysqli_query($con, $sqlClientes) or die( mysqli_error($con) );
			?>
			
			<select class="form-control" name="fcliente_id" required autofocus>
				<option value="">Selecione um cliente...</option>
				<?php while($cliente=mysqli_fetch_assoc($resClientes)){ ?>
					<option <?php if($venda['cliente_id']==$cliente['id']) echo "selected"; ?> value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome'] . " - " . $cliente['telefone']; ?></option>
				<?php } ?>
			</select>	
			
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
		
	</div>
</form>