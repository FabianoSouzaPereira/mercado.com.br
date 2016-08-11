<?php 

	//Verificar se o POST não está vazio
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		
		//Resgatar dados do formulário
		$nome = $_POST['fnome'];
		
		//Iniciar a validação de dados
		$valida = true;
		$mensagemErro = "";
		
		//Verificar se o nome foi inserido
		if(Validador::ehNulo($nome)==true){
			$valida = false;
			$mensagemErro .= "<li>Nome é <b>obrigatório</b></li>";
		}
		
		
		if($valida==true){
			//Montar o sql de insert
			$sql = "INSERT INTO categorias(nome) VALUES('$nome')";
			
			//Executar o sql na conexão
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			
			//Verificar a resposta do insert
			if($res==1){
				//Redirecionar para listagem de cidades
				header('location: index.php?pagina=categorias_listar');
			} else {
				echo "<h1>Erro ao cadastrar categoria</h1>";
			}
			
		}
		
	}
?>

<form action="" method="post" class="panel panel-warning">
	<div class="panel-heading">
		<h3>Cadastro de Categoria de Produtos</h3>
	</div>
	
	<div class="panel-body">
		<a href="index.php?pagina=categorias_listar"> <span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
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
			<label for="nome">Nome</label>
			<input type="text" value="<?php echo @$_POST['fnome']; ?>" class="form-control" name="fnome" id="nome" placeholder="Digite o nome da categoria" autofocus >
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
		
	</div>
</form>