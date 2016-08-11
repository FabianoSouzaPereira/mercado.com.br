<?php
	ob_start();
	//error_reporting(0);
	session_start();

	date_default_timezone_set("Etc/GMT+3");
	//Incluir a conexão com banco de dados
	include '../admin/conexao.php';
	include '../admin/biblioteca/Conversor.php';
	include '../admin/biblioteca/Validador.php';
	
	
?>


<!Doctype html>
<html lang="pt-br">
<head>
  <title>Site de vendas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/estilo.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/funcoes.js"></script>
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
		<nav class="navbar navbar-default navbar-fixed-top">
		  <div class="container">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>                        
		      </button>
		      <a class="navbar-brand" href="#myPage"> <span class="glyphicon glyphicon-globe"> </span> Mundo do Futuro</a>
		    </div>
		    
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		      	<li><a href="#myPage">INICIO</a></li>
		        <li><a href="#about">SOBRE</a></li>
		        <li><a href="#services">PRODUTOS</a></li>
		        <li><a href="#portfolio">DESTAQUES</a></li>
		        <li><a href="#contato">CONTATO</a></li>
				<li>
					<a id="link-user" title="Clique aqui para realizar o acesso" href="" data-toggle="modal" data-target="#modal-login" >
						<span class="glyphicon glyphicon-user"><label class="acessoSmart" style='display:none'> Acessar</label> </span>
						<!-- Acesso -->
					</a>
				</li>
		        <li><a href="" data-toggle="modal" data-target="#modal-pesquisa" ><span class="glyphicon glyphicon-search"><label class="acessoSmart" style='display:none'> Pesquisar</label> </span></a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
        	
		<!-- Modal para pesquisa de produtos -->
			<div style="margin-top: 2%;" id="modal-pesquisa" class="modal fade" role="dialog">
			  <div class="modal-dialog">
			
			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Pesquisa</h4>
			      </div>
			      <div class="modal-body">
					<form action="produtos.php" class="form-inline">
	    				<input value="<?php echo @$_GET['p']; ?>" type="text" name="p" id="fpesquisa" class="form-control" size="50" placeholder="Pesquise por nome descricao ou categoria." >
	    				<button title="Clique para efetuar a pesquisa" type="submit" class="btn btn-success"> <span class="glyphicon glyphicon-search" > </span> </button>
	  					<br />
	  					<!-- 
	  					<label>
	  					<input type="radio" name="dentroCategoria" value="1" /> - Pesquisar dentro da categoria</label>
	  					<br />
	  					<label>
	  					<input type="radio" name="dentroCategoria" value="0" /> - Pesquisar em todo o site</label>
	  					 -->
	  				</form>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"> </span> Fechar</button>
			       
			      </div>
			    </div>
			
			  </div>
			</div>
			<!-- Modal -->
        	
				
			<div class="jumbotron text-center" id="inicio">
			
				<div class="row"  id="aluno">
						  <h1 style="position: relative; top: 50px; font-size: 36px; text-shadow: 1px 1px #333; color: rgba(250,250,250,1);">Você é nossa motivação</h1>
						  <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
						    <!-- Indicators -->
						    <ol class="carousel-indicators">
						      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						      <li data-target="#myCarousel" data-slide-to="1"></li>
						      <li data-target="#myCarousel" data-slide-to="2"></li>
						    </ol>
						
						    <!-- Wrapper for slides -->
						    <div class="carousel-inner" role="listbox">
						      <div class="item active">
						        <h4>"Precisando comprar?"<br><span style="font-style:normal;">Promovemos compras seguroas para nossos usuários.</span></h4>
						      </div>
						      <div class="item">
						        <h4>"Compre conosco"<br><span style="font-style:normal;">Entregamos na sua casa</span></h4>
						      </div>
						      <div class="item">
						        <h4>"Certificados internacionais"<br><span style="font-style:normal;">Produtos nas cateoria de alimentos, bebidas e muito mais.</span></h4>
						      </div>
						    </div>
						
						    <!-- Left and right controls -->
						    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
						      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						      <span class="sr-only">Anterior</span>
						    </a>
						    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
						      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						      <span class="sr-only">Próximo</span>
						    </a>
						  </div>
			  </div>
			  
			</div>

			<!-- Container (About Section) -->
			<div id="about" class="container-fluid">
			  <div class="row">
			    <div class="col-sm-8">
			      <h2>Conheça nosso site</h2><br>
			      <h4>Nossa empresa trabalho oferecendo produtos para sua casa.</h4><br>
			      <p>Venha conhecer nossos produtos. Veja também a área dos destaques e aproveite as promoções e dicas de produtos que disponibilizamos a você.</p>
			     
			    </div>
			    <div class="col-sm-4">
			      <span class="glyphicon glyphicon-signal logo"></span>
			    </div>
			  </div>
			</div>

			<div class="container-fluid bg-grey">
			  <div class="row">
			    <div class="col-sm-4">
			      <span class="glyphicon glyphicon-globe logo slideanim"></span>
			    </div>
			    <div class="col-sm-8">
			      <h2>Nossos Valores</h2><br>
			      <p><strong>MISSAO:</strong> Levar os produtos de forma facilitada a todos os usuários da internet.</p><br>
			      <p><strong>VISÃO:</strong> Nossa visão é estar presente no cotidiano das pessoas, de forma que quando um novo produto for lançado, estaremos aqui para lhe fazer entender melhor sua curiosidade.</p>
			    </div>
			  </div>
			</div>

			<!-- Container (3 primeiras categorias de produtos) -->
			<?php 
				//Selecionar as três ultimas categorias cadastradas
				$sql = "SELECT 
							id, 
							nome, 
							(SELECT imagem FROM produtos p WHERE p.categoria_id=c.id ORDER BY RAND() LIMIT 1) AS imagem 
						FROM 
							categorias c 
						ORDER BY id DESC 
						LIMIT 3";
				$resCategorias = mysqli_query($con, $sql) or die(mysqli_error($con));
			?>
			
			<div id="services" class="container-fluid text-center">
			  <h2>Categorias de Cursos</h2>
			
			  <div class="row slideanim">
			  
			  	<?php while($linha = mysqli_fetch_assoc($resCategorias)){ ?>
			  
				    <div class="col-sm-4" style="background: #F9F9F9; padding: 1%;">
				    <!--  <span class="glyphicon glyphicon-heart logo-small"></span> -->
				      <a href="cursos.php?id=<?php echo $linha['id']; ?>">
				      	
				      	<div id="imagem-categoria">
					      	<img class="img-thumbnail"  src="../admin/<?php echo $linha['imagem']?$linha['imagem']:"../admin/imagens/sem-imagem.jpg"; ?>" />
						</div>      
				      <h4><?php echo $linha['nome']; ?></h4>
				      </a>
				      
				      <a href="produtos.php?categoria_id=<?php echo $linha['id']; ?>" class="btn btn-default">
						        		<span class="glyphicon glyphicon-eye-open"> </span> Ver Produtos da Categoria</a>
				    </div>
				    
			    <?php } ?>
			    
			    
			  </div>
			  <br><br>
			</div>

			<!-- Container (Produtos - Selecionar os 3 produtos marcados como destaque) -->
			<?php 
				$sql = "SELECT 
							p.id,
							p.nome AS produto,
							p.valor,
							p.imagem,
							c.nome AS categoria
						FROM
							produtos p, categorias c
						WHERE
							p.categoria_id=c.id
						LIMIT 3";
				$resProdutos = mysqli_query($con, $sql) or die(mysqli_error($con));
			?>
			
			<div id="portfolio" class="container-fluid text-center bg-grey">
			  <h2 style="margin-bottom:0">Produtos em destaque</h2>
			  <h4 style="margin-bottom:0">Conheça os três produtos em destaque e aproveite</h4>
			  <div class="row text-center slideanim">
			  
			  
			    	<?php while($linha = mysqli_fetch_assoc($resProdutos)){ ?>
			  
							<div class="col-sm-4">
						      <div class="thumbnail" style="padding: 2%;">
						      	<div id="imagem-produto">
						        	<img src="../admin/<?php echo $linha['imagem']; ?>" >
						        </div>
						        <h4><strong><?php echo $linha['produto'] ?> / <?php echo $linha['categoria']; ?></strong></h4>
						        <p style="text-align: justify;">
						        	<label class="label label-default"><strong>Valor: </strong><?php echo Conversor::realBancoParaUsuario($linha['valor']); ?></label>
						        </p>
						        <p style="text-align:left;">
						        	 <a href="javascript:void(0)" class="btn btn-default ">
						        	 	<span class="glyphicon glyphicon-plus"> </span> Adicionar ao Carrinho</a>
						        </p>
						       
						      </div>
						    </div>
				    
			    	<?php } ?>
			  
			  </div>
			
			</div>

<!-- Container (Contact Section) -->
<div id="contato" class="container-fluid">
  <h2 class="text-center">CONTATO</h2>
  <div class="row">
    <div class="col-sm-5">
      <p>Entre em contato conosco e tire suas dúvidas</p>
      <p><span class="glyphicon glyphicon-map-marker"> </span> Passo Fundo, Rio Grande do Sul/Brasil</p>
      <p><span class="glyphicon glyphicon-phone"> </span> +55 54 99635765</p>
      <p><span class="glyphicon glyphicon-envelope"> </span> mdfcursos@gmail.com</p>	   
    </div>
    <div class="col-sm-7 slideanim">
      <div class="row">
        <div class="col-sm-6 form-group">
          <input class="form-control" id="name" name="name" placeholder="Seu nome" type="text" required>
        </div>
        <div class="col-sm-6 form-group">
          <input class="form-control" id="email" name="email" placeholder="Seu email" type="email" required>
        </div>
      </div>
      <textarea class="form-control" id="comments" name="comments" placeholder="Sua mensagem" rows="5"></textarea><br>
      <div class="row">
        <div class="col-sm-12 form-group">
          <button class="btn btn-default pull-right" type="submit">Enviar</button>
        </div>
      </div>	
    </div>
  </div>
</div>


<?php include 'footer.php'; ?>

<script>
		$(document).ready(function(){
		  // Add smooth scrolling to all links in navbar + footer link
		  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
		
		    // Prevent default anchor click behavior
		    event.preventDefault();
		
		    // Store hash
		    var hash = this.hash;
		
		    // Using jQuery's animate() method to add smooth page scroll
		    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
		    $('html, body').animate({
		      scrollTop: $(hash).offset().top
		    }, 900, function(){
		   
		      // Add hash (#) to URL when done scrolling (default click behavior)
		      window.location.hash = hash;
		    });
		  });
		  
		  // Slide in elements on scroll
		  $(window).scroll(function() {
		    $(".slideanim").each(function(){
		      var pos = $(this).offset().top;
		
		      var winTop = $(window).scrollTop();
		        if (pos < winTop + 600) {
		          $(this).addClass("slide");
		        }
		    });
		  });
		})
</script>




<script>
	function fechar(id){
		$("#"+id).css("display", "none")
	}
</script>


<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-success alert-dismissible" id="alerta-sucesso" role="alert">
  <button onclick="fechar('alerta-sucesso')" type="button" class="close" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>
<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-info alert-dismissible" id="alerta-info" role="alert">
  <button onclick="fechar('alerta-info')" type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>
<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-warning alert-dismissible" id="alerta-aviso" role="alert">
  <button onclick="fechar('alerta-aviso')" type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>
<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-danger alert-dismissible" role="alert"  id="alerta-erro">
  <button onclick="fechar('alerta-erro')" type="button" class="close" data-dismiss="alert" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>


</body>
</html>