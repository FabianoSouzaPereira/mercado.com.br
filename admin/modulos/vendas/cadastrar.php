<?php 

	//Verificar se o POST não está vazio
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		
		//Resgatar dados do formulário
		$funcionario_id = $_SESSION['id'];
		$cliente_id = $_POST['fcliente_id'];
		
		//Iniciar a validação de dados
		$valida = true;
		$mensagemErro = "";
		
		//Verificar se o nome foi inserido
		if(Validador::ehNulo($funcionario_id)==true){
			$valida = false;
			$mensagemErro .= "<li>Funcionário é <b>obrigatório</b></li>";
		}
		
		
		//Verificar se o nome foi inserido
		if(Validador::ehNulo($cliente_id)==true){
			$valida = false;
			$mensagemErro .= "<li>Cliente é <b>obrigatório</b></li>";
		}
		
		if($valida==true){
			//Montar o sql de insert
			$sql = "INSERT INTO
						vendas(data_venda, hora_venda, valor_total, cliente_id, funcionario_id)
					VALUES(curdate(), curtime(), 0, $cliente_id, $funcionario_id)";
			
			//Executar o sql na conexão
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			
			//Verificar a resposta do insert
			if($res==1){
				
				//sql para resgatar a ultima venda cadastrada
				$sql = "SELECT max(id) AS id FROM vendas";
				$res = mysqli_query($con, $sql);
				$dado = mysqli_fetch_assoc($res);
				$venda_id = $dado['id'];
				
				//Redirecionar para listagem
				header("location: index.php?pagina=vendas_produtos&venda_id=$venda_id");
			} else {
				echo "<h1>Erro ao cadastrar venda</h1>";
			}
			
		}
		
	}
?>
<form action="" method="post"  class="panel panel-warning">
		
	<div class="panel-heading">
		<h3>Cadastro de Venda</h3>
	</div>
	
	<div class="panel-body">
		<a href="index.php?pagina=vendas_listar"> <span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
		<br><br>
	
		<?php if(isset($valida) && $valida==false){ ?>
			<div class="alert alert-danger">	
				<h3>Foram encontrados os seguinte erros!</h3>
				<ul>
					<?php echo $mensagemErro; ?>
				</ul>
			</div>
		<?php } ?>
	
		<div class="form-group">
			<label>Funcionário</label>
			
			<?php 
				//Criar sql para seleção de todas os estados
				$sqlFuncionarios = "SELECT id, nome FROM funcionarios WHERE status=1 ORDER BY nome";
				$resFuncionarios = mysqli_query($con, $sqlFuncionarios) or die( mysqli_error($con) );
			?>
			
			<select class="form-control" name="ffuncionario_id" disabled autofocus>
				<option value="">Selecione um funcionário...</option>
				<?php while($funcionario=mysqli_fetch_assoc($resFuncionarios)){ ?>
					<option <?php if($_SESSION['id']==$funcionario['id']) echo "selected"; ?> value="<?php echo $funcionario['id']; ?>"><?php echo $funcionario['nome']; ?></option>
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
			
			<select class="form-control" name="fcliente_id" >
				<option value="">Selecione um cliente...</option>
				<?php while($cliente=mysqli_fetch_assoc($resClientes)){ ?>
					<option value="<?php echo $cliente['id']; ?>"><?php echo $cliente['nome'] . " - " . $cliente['telefone']; ?></option>
				<?php } ?>
			</select>	
			
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
		
	</div>
</form>