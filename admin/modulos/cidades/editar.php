<?php 

	//Resgatar o id da cidade a ser editada
	$id = intval($_GET['id']);
	
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		//Resgatar os novos dados do formulário
		$novo_nome = $_POST['fnome'];
		$novo_estado_id = $_POST['festado_id'];
		
		//Iniciar a validação de dados
		$valida = true;
		$mensagemErro = "";
		
		//Verificar se o nome foi inserido
		if(Validador::ehNulo($novo_nome)==true){
			$valida = false;
			$mensagemErro .= "<li>Nome é <b>obrigatório</b></li>";
		}
		
		
		//Verificar se o nome foi inserido
		if(Validador::ehNulo($novo_estado_id)==true){
			$valida = false;
			$mensagemErro .= "<li>Estado é <b>obrigatório</b></li>";
		}
		
		if($valida==true){
			//Montar o script de update
			$sql = "UPDATE
						cidades
					SET
						nome='$novo_nome',
						estado_id=$novo_estado_id
					WHERE
						id=$id";
			
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			if($res==1){
				header('location: index.php?pagina=cidades_listar');
			}
		}
		
	}
	
	//Script para selecionar o nome e o uf da cidade
	$sql = "SELECT nome, estado_id FROM cidades WHERE id=$id";
	
	//Executar o script na conexao e armazenar o resultado
	$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
	
	//Extrair uma linha do resultado
	$linha = mysqli_fetch_array($res);
	
	//Extrair para variáveis normais
	$nome = $linha['nome'];
	$estado_id = $linha['estado_id'];

?>
	
<form action="" method="post"  class="panel panel-warning">
		
	<div class="panel-heading">
		<h3>Editando cidade</h3>
	</div>
	
	<div class="panel-body">
		<a href="index.php?pagina=cidades_listar"> <span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
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
			<label>Estado</label>
			
			<?php 
				//Criar sql para seleção de todas os estados
				$sqlEstados = "SELECT id, nome, sigla FROM estados ORDER BY nome";
				$resEstados = mysqli_query($con, $sqlEstados) or die( mysqli_error($con) );
			?>
			
			<select class="form-control" name="festado_id" autofocus>
				<option value="">Selecione um estado</option>
				<?php while($estado=mysqli_fetch_assoc($resEstados)){ ?>
					<option <?php if($estado_id==$estado['id'])echo "selected"; ?> value="<?php echo $estado['id']; ?>"><?php echo $estado['nome']; ?></option>
				<?php } ?>
			</select>	
			
		</div>
		
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" value="<?php echo $nome; ?>" class="form-control" name="fnome" id="nome" placeholder="Digite o nome da cidade" >
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
		
	</div>
</form>