<?php 

	//Resgatar o id da cidade a ser editada
	$id = intval($_GET['id']);
	
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		//Resgatar os novos dados do formulário
		$novo_nome = $_POST['fnome'];
		
		//Iniciar a validação de dados
		$valida = true;
		$mensagemErro = "";
		
		//Verificar se o nome foi inserido
		if(Validador::ehNulo($novo_nome)==true){
			$valida = false;
			$mensagemErro .= "<li>Nome é <b>obrigatório</b></li>";
		}
		
		if($valida==true){
			//Montar o script de update
			$sql = "UPDATE
						categorias
					SET
						nome='$novo_nome'
					WHERE
						id=$id";
			
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			if($res==1){
				header('location: index.php?pagina=categorias_listar');
			}
		}
		
	}
	
	//Script para selecionar o nome e o uf da cidade
	$sql = "SELECT nome FROM categorias WHERE id=$id";
	
	//Executar o script na conexao e armazenar o resultado
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
	
	//Extrair uma linha do resultado
	$linha = mysqli_fetch_array($res);
	
	//Extrair para variáveis normais
	$nome = $linha['nome'];

?>

<form action="" method="post" class="panel panel-warning">
	
	<div class="panel-heading">
		<h3>Editando Categoria</h3>
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
			<input type="text" value="<?php echo $nome; ?>" class="form-control" name="fnome" id="nome" placeholder="Digite o nome da categoria" autofocus >
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<a href="index.php?pagina=estados_listar" class="btn btn-default">Cancelar</a>
		
		</div>
	</div>
</form>