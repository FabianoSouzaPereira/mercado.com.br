<?php 

	$id = $_GET['id'];

	//Verificar se o POST não está vazio
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		
		//Resgatar dados do formulário
		$nome = $_POST['fnome'];
		$data_nascimento = $_POST['fdata_nascimento'];
		$telefone = $_POST['ftelefone'];
		$email = $_POST['femail'];
		$cidade_id = $_POST['fcidade_id'];
		
		
		//Realizar as devidas validações
		$valida = true;
		$mensagemErro="";
		
		//Verificar se o nome foi digitado
		if(Validador::ehNulo($nome)==true){
			$valida = false;
			$mensagemErro .= "<li>Nome é <b>obrigatório</b></li>";
		}
		
		//Verificar se a data de nascimento foi preechida
		if(Validador::ehNulo($data_nascimento)==true){
			$valida = false;
			$mensagemErro .= "<li>Data Nascimento é <b>obrigatório</b></li>";
		} elseif( Validador::ehDataUsuario($data_nascimento)==false ){
			//Verifica se adata foi inserida corretamento
			$valida = false;
			$mensagemErro .= "<li>Data Nascimento <b>inválida</b></li>";
		}
		
		//Verificar se o telefoen foi preechido
		if(Validador::ehNulo($telefone)==true){
			$valida = false;
			$mensagemErro .= "<li>Telefone é <b>obrigatório</b></li>";
		}
		
		
		//Verificar se a data de nascimento foi preechida
		if(Validador::ehNulo($email)==true){
			$valida = false;
			$mensagemErro .= "<li>E-mail é <b>obrigatório</b></li>";
		} elseif( Validador::ehEmail($email)==false ){
			//Verifica se adata foi inserida corretamento
			$valida = false;
			$mensagemErro .= "<li>E-mail <b>inválido</b></li>";
		}
		
		
		//Verificar se foi selecionado uma cidade da lista
		if(Validador::ehNulo($cidade_id)==true){
			$valida = false;
			$mensagemErro .= "<li>Cidade é <b>obrigatório</b></li>";
		}
		
		
		
		if($valida==true){
			//Montar o sql de insert
			$data_nascimento = Conversor::dataUsuarioParaBanco($data_nascimento);
			$sql = "UPDATE
						clientes 
					SET
						nome = '$nome', 
						data_nascimento = '$data_nascimento', 
						telefone = '$telefone', 
						email = '$email', 
						cidade_id = $cidade_id
					WHERE	
						id = $id";
			
			//Executar o sql na conexão
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			
			//Verificar a resposta do insert
			if($res==1){
				//Redirecionar para listagem de cidades
				header('location: index.php?pagina=clientes_listar');
			} else {
				echo "<h1>Erro ao atualizar cliente</h1>";
			}
			
		}
		
	}
	
	
	//Sql para selecionar os dados do cliente que será editado
	$sqlCliente = "SELECT 
				id, nome, data_nascimento, telefone, email, cidade_id 
			FROM 
				clientes 
			WHERE 
				id=$id";
	
	$resCliente = mysqli_query($con, $sqlCliente);
	$funcionario = mysqli_fetch_assoc($resCliente);
	
?>
<form action="" method="post"  class="panel panel-warning">
		
	<div class="panel-heading">
		<h3>Editando Cliente</h3>
	</div>
	
	<div class="panel-body">
		<a href="index.php?pagina=clientes_listar"> <span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
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
			<label>Cidade</label>
			
			<?php 
				//Criar sql para seleção de todas os estados
				$sqlCidades = "SELECT 
									c.id, 
									c.nome, 
									e.sigla 
								FROM 
									estados e, cidades c
								WHERE
									c.estado_id=e.id
								ORDER BY 
									e.nome, c.nome";
				
				$resCidades = mysqli_query($con, $sqlCidades) or die( mysqli_error($con) );
			?>
			
			<select class="form-control" name="fcidade_id" autofocus>
				<option value="">Selecione uma cidade...</option>
				<?php while($cidade=mysqli_fetch_assoc($resCidades)){ ?>
					<option <?php if($funcionario['cidade_id']==$cidade['id']) echo "selected"; ?> value="<?php echo $cidade['id']; ?>"><?php echo $cidade['nome']." | ".$cidade['sigla']; ?></option>
				<?php } ?>
			</select>	
			
		</div>
		
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" value="<?php echo $funcionario['nome']; ?>" class="form-control" name="fnome" id="nome" placeholder="Digite o nome do cliente" >
		</div>
		
		<div class="form-group">
			<label for="data_nascimento">Data Nascimento</label>
			<input type="text"  value="<?php echo Conversor::dataBancoParaUsuario($funcionario['data_nascimento']); ?>" class="form-control mascaraData" name="fdata_nascimento" id="data_nascimento" placeholder="Digite a data de nascimento" >
		</div>
		
		<div class="form-group">
			<label for="telefone">Telefone</label>
			<input type="text" value="<?php echo $funcionario['telefone']; ?>" class="form-control mascaraTelefone" name="ftelefone" id="telefone" placeholder="Digite o telefone do cliente" >
		</div>
		
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="text" value="<?php echo $funcionario['email']; ?>" class="form-control" name="femail" id="email" placeholder="Digite o e-mail do cliente" >
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
		
	</div>
</form>