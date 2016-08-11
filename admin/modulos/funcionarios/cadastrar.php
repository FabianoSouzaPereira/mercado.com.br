<?php 

	//Verificar se o POST não está vazio
	//Verificar se o usuário clicou em enviar
	if(!empty($_POST)){
		
		//Resgatar dados do formulário
		$nome = $_POST['fnome'];
		$data_admissao = $_POST['fdata_admissao'];
		$telefone = $_POST['ftelefone'];
		$email = $_POST['femail'];
		$cidade_id = $_POST['fcidade_id'];
		$senha = $_POST['fsenha'];
		$senha_confirmar = $_POST['fsenha_confirmar'];
		
		//Realizar as devidas validações
		$valida = true;
		$mensagemErro="";
		
		//Verificar se o nome foi digitado
		if(Validador::ehNulo($nome)==true){
			$valida = false;
			$mensagemErro .= "<li>Nome é <b>obrigatório</b></li>";
		}
		
		//Verificar se a data de admissão foi preechida
		if(Validador::ehNulo($data_admissao)==true){
			$valida = false;
			$mensagemErro .= "<li>Data de Admissão é <b>obrigatório</b></li>";
		} elseif( Validador::ehDataUsuario($data_admissao)==false ){
			//Verifica se adata foi inserida corretamento
			$valida = false;
			$mensagemErro .= "<li>Data de Admissão <b>inválida</b></li>";
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
		
		
		//Verificar se foi selecionado uma cidade da lista
		if(Validador::ehNulo($senha)==true){
			$valida = false;
			$mensagemErro .= "<li>Senha é <b>obrigatório</b></li>";
		}
		
		
		//Verificar as senhas são iguais
		if($senha != $senha_confirmar){
			$valida = false;
			$mensagemErro .= "<li>Senhas <b>não conferem</b></li>";
		}
		
		
		
		if($valida==true){
			
			$data_admissao = Conversor::dataUsuarioParaBanco($data_admissao);
			
			//Montar o sql de insert
			$sql = "INSERT INTO
						funcionarios (nome, data_admissao, telefone, email, cidade_id, senha) 
					VALUES ('$nome', '$data_admissao', '$telefone', '$email', $cidade_id, md5('$senha'))";
			
			//Executar o sql na conexão
			$res = mysqli_query($con, $sql) or die( mysqli_error($con) );
			
			//Verificar a resposta do insert
			if($res==1){
				//Redirecionar para listagem
				header('location: index.php?pagina=funcionarios_listar');
			} else {
				echo "<h1>Erro ao cadastrar funcionário</h1>";
			}
			
		}
		
	}
?>
<script type="text/javascript">

	function verificarSenha(){

		//Resgatar valor dos campos com JQuery
		var senha = $("#senha").val();
		var senha_confirmar = $("#senha_confirmar").val();

		if(senha!=senha_confirmar){
			$("#nao_conferem").fadeIn(300);
			$("#conferem").fadeOut(0);
		}else{
			$("#nao_conferem").fadeOut(0);
			$("#conferem").fadeIn(300);
		}
		
	}	

</script>
<form action="" method="post"  class="panel panel-warning">
		
	<div class="panel-heading">
		<h3>Cadastro de Funcionário</h3>
	</div>
	
	<div class="panel-body">
		<a href="index.php?pagina=funcionarios_listar"> <span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
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
								AND
									c.status=1
								ORDER BY 
									e.nome, c.nome";
				
				$resCidades = mysqli_query($con, $sqlCidades) or die( mysqli_error($con) );
			?>
			
			<select class="form-control" name="fcidade_id"  autofocus>
				<option value="">Selecione uma cidade...</option>
				<?php while($cidade=mysqli_fetch_assoc($resCidades)){ ?>
					<option <?php if(@$_POST['fcidade_id']==$cidade['id']) echo "selected"; ?> value="<?php echo $cidade['id']; ?>"><?php echo $cidade['nome']." | ".$cidade['sigla']; ?></option>
				<?php } ?>
			</select>	
			
		</div>
		
		<div class="form-group">
			<label for="nome">Nome</label>
			<input type="text" value="<?php echo @$_POST['fnome']; ?>" class="form-control" name="fnome" id="nome" placeholder="Digite o nome do funcionário"  >
		</div>
		
		<div class="form-group">
			<label for="data_nascimento">Data Admissão</label>
			<input type="text" value="<?php echo isset($_POST['fdata_admissao']) ? $_POST['fdata_admissao'] : date('d/m/Y'); ?>" class="form-control mascaraData" name="fdata_admissao" id="data_nascimento" placeholder="Digite a data de nascimento"  >
		</div>
		
		<div class="form-group">
			<label for="telefone">Telefone</label>
			<input type="text" value="<?php echo @$_POST['ftelefone']; ?>" class="form-control mascaraTelefone" name="ftelefone" id="telefone" placeholder="Digite o telefone do funcionário"  >
		</div>
		
		<div class="form-group">
			<label for="email">E-mail</label>
			<input type="text" value="<?php echo @$_POST['femail']; ?>" class="form-control" name="femail" id="email" placeholder="Digite o e-mail do funcionário"  >
		</div>
		
		<div class="form-group">
			<label for="senha">Senha</label>
			<input type="password" onkeyup="verificarSenha()" class="form-control" name="fsenha" id="senha" placeholder="Digite sua senha"  >
		</div>
		
		<div class="form-group">
			<label for="senha">Confirmar Senha</label>
			<input type="password" onkeyup="verificarSenha()" class="form-control" name="fsenha_confirmar" id="senha_confirmar" placeholder="Digite sua senha"  >
			<label id="nao_conferem" class="label label-danger" style="display:none;">As senhas não conferem!</label>
			<label id="conferem" class="label label-success" style="display:none;">As senhas conferem!</label>
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar" >
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
		
	</div>
</form>