<?php
	session_start();
	
	//Verificar se o usuário não está logado
	if( !(isset($_SESSION['logado']) && $_SESSION['logado']==true) ){
		header('location:login.php');
	}
	
	//Incluir a conexão com banco de dados
	include 'conexao.php';
	include 'biblioteca/Conversor.php';
	include 'biblioteca/Validador.php';
	date_default_timezone_set("Etc/GMT+3");
	
	
	
	
	//Resgatar página da URL
	//Verificar se existe o parametro na URL
	if( isset($_GET['pagina']) ){
		
		//Resgata a página que deverá ser exibida.
		//nomePasta_acao Ex.: estados_listar. estados é o nome da pasta e listar é a ação a ser realizada
		$pagina = $_GET['pagina'];
		
		
		//Verifica se existe UNDRLINE(_) no caminho do arquivo		
		if(strpos($pagina, "_")!=0){
			$vetor = explode("_", $pagina);
			$pasta = $vetor[0];
			$acao = $vetor[1];
		}else{
			$pasta = "";
			$acao = "";
		}

		//Montagem do caminho completo do arquivo a ser incluido
		$caminhoCompleto = "modulos/$pasta/$acao.php";
		
		//Verificar se o arquivo não existe
		if(file_exists($caminhoCompleto) == false)
			$caminhoCompleto = "inicio.php";
		
	} else {
		//Se não existir o parametro pagina na URL
		$caminhoCompleto = "inicio.php";
	}
?>

<!Doctype html>
<html lang="pt-br">
	<head>
		<title>Mercado PW</title>
		<meta charset="utf8">
		<!-- Chamada do CSS -->
		<link rel="stylesheet" href="css/estilo.css" >
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		
		<!-- Framework JQuery -->
		<script src="bootstrap/js/jquery-1.12.4.min.js"></script>
		
		<!--  Plugin para mascara monetária -->
		<script src="bootstrap/js/jquery.maskMoney.js"></script>
  		<script src="bootstrap/js/bootstrap.min.js"></script>
  		
  		<!-- Plugin para mascara para data -->
		<script src="bootstrap/js/maskedinput.min.js"></script>
  		
  		<!-- Configuração para máscara monetária -->
  		<script type="text/javascript">
			$(function(){
				 $(".mascaraReal").maskMoney({	symbol:'R$ ', 
												showSymbol:true, 
												thousands:'.', 
												decimal:',', 
												symbolStay: false});

				 $(".mascaraReal2").maskMoney({	symbol:'$ ', 
						showSymbol:true, 
						thousands:'.', 
						decimal:',', 
						symbolStay: false});

				 $(".mascaraInteiro").maskMoney({	
					 	symbol:'', 
					 	precision:0,
						showSymbol:false, 
						thousands:'.', 
						decimal:',', 
						symbolStay: false});
					
			 });

			$(document).ready(function(){
				<!-- Configuração da máscara para data e telefone -->
				$(".mascaraData").mask("99/99/9999");
				$(".mascaraTelefone").mask("(99) 9999-9999");
			});
			
			
		</script>
		
	</head>
	
	<body>
		<?php include "topo.php"; ?>
		<!-- INICIO DO CONTEÚDO DO SITE -->
		<div id="conteudo-principal">
			<?php include $caminhoCompleto; ?>
		</div>
		<!-- FIM DO CONTEÚDO DO SITE -->
		<?php include "rodape.php"; ?>
	</body>

</html>