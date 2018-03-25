<?php 

	//Verificar se o POST não está vazio
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		
		//Resgatar dados do formulário
		$nome = $_POST['fnome'];
		$valor = $_POST['fvalor'];
		$categoria_id = $_POST['fcategoria_id'];
		
		
		//Iniciar a validação de dados
		$valida = true;
		$mensagemErro = "";
		
		
		//Verificar se a categoria foi inserida
		if(Validador::ehNulo($categoria_id)==true){
			$valida = false;
			$mensagemErro .= "<li>Categoria é <b>obrigatório</b></li>";
		}
		
		
		//Verificar se o nome foi inserido
		if(Validador::ehNulo($nome)==true){
			$valida = false;
			$mensagemErro .= "<li>Nome é <b>obrigatório</b></li>";
		}
		
		//Verificar se a categoria foi inserida
		if(Validador::ehNulo($valor)==true){
			$valida = false;
			$mensagemErro .= "<li>Valor é <b>obrigatório</b></li>";
		}
		
		
		if($valida==true){
			
			//Converter a valor real do usuário para banco
			$valor = Conversor::realUsuarioParaBanco($valor);
			
			#Lógica para realização do upload de imagem
			
			//Resgatar arquivo enviado pelo formulário
			$arquivo = $_FILES['fimagem'];
			
			//Extrair dados do arquivo
			$nomeOriginal = $arquivo['name'];
			$imagem = $arquivo['tmp_name'];
			
			if($nomeOriginal!=""){
				//Montagem de um nome dinâmico para não repetir
				$nomeNovo = mktime(0,0,0).$nomeOriginal;
				
				//Montagem do caminho onde a imagem será salva
				$caminhoImagem = "imagens/$nomeNovo";
				
				//Realizar o upload da imagem para o caminho definido
				move_uploaded_file($imagem, $caminhoImagem);
			}
			
			#Lógica para realização do upload de imagem
			
			
			//Montar o sql de insert
			$sql = "INSERT INTO produtos(nome, valor, imagem, categoria_id) VALUES('$nome', $valor, '$caminhoImagem', $categoria_id)";

			//Executar o sql na conexão
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			
			//Verificar a resposta do insert
			if($res==1){
				//Redirecionar para listagem de cidades
				header('location: index.php?pagina=produtos_listar');
			} else {
				echo "<h1>Erro ao cadastrar produto</h1>";
			}
			
		}
		
	}
?>
<form action="" method="post"  class="panel panel-warning" enctype="multipart/form-data">
		
	<div class="panel-heading">
		<h3>Cadastro de Produtos</h3>
	</div>
	
	<div class="panel-body">
		<a href="index.php?pagina=produtos_listar"> <span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
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
			<label>Categoria do produto</label>
			
			<?php 
				//Criar sql para seleção de todas os estados
				$sqlCategorias = "SELECT id, nome FROM categorias WHERE status=1 ORDER BY nome";
				$resCategorias = mysqli_query($con, $sqlCategorias) or die( mysqli_error($con) );
			?>
			
			<select class="form-control" name="fcategoria_id">
				<option value="">Selecione uma categoria...</option>
				<?php while($categoria=mysqli_fetch_assoc($resCategorias)){ ?>
					<option <?php if(@$_POST['fcategoria_id']==$categoria['id']) echo "selected"; ?> value="<?php echo $categoria['id']; ?>"><?php echo $categoria['nome']; ?></option>
				<?php } ?>
			</select>	
			
		</div>
		
		<div class="form-group">
			<label for="imagem">Imagem</label>
			<input type="file" class="form-control" name="fimagem" id="imagem">
		</div>
		
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" value="<?php echo @$_POST['fnome']; ?>" class="form-control" name="fnome" id="nome" placeholder="Digite o nome do produto" >
		</div>
		
		<div class="form-group">
			<label for="valor">Valor</label>
			<input type="text" value="<?php echo @$_POST['fvalor']; ?>" class="form-control mascaraReal" name="fvalor" id="valor" placeholder="Digite o valor do produto" >
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
		
	</div>
</form>