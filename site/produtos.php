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


<!DOCTYPE html>
<html lang="en">
<head>

  <title>Mundo do futuro</title>
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
			      <a class="navbar-brand" href="javascript:void(0)" onclick="window.location='index.php#myPage';"> <span class="glyphicon glyphicon-globe"> </span> Mundo do Futuro</a>
			    </div>
			    
			    
			    
			    <div class="collapse navbar-collapse" id="myNavbar">
			      <ul class="nav navbar-nav navbar-right">
			      	<li><a onclick="window.location='index.php#myPage'" href="javascript:void(0)">INICIO</a></li>
			        <li><a onclick="window.location='index.php#about'" href="javascript:void(0)">SOBRE</a></li>
			        <li><a onclick="window.location='index.php#services'" href="#services">PRODUTOS</a></li>
			         <li><a onclick="window.location='index.php#portfolio'" href="#portfolio">DESTAQUES</a></li>
			        <li><a href="#contato">CONTATO</a></li>
			        <li><a href="" data-toggle="modal" data-target="#modal-pesquisa" ><span class="glyphicon glyphicon-search"> </span></a></li>
			      </ul>
			    </div>
			  </div>
			</nav>



			<!-- Modal -->
					<div style="margin-top: 2%;" id="modal-pesquisa" class="modal fade" role="dialog">
					  <div class="modal-dialog">
					
					    <!-- Modal content-->
					    <div class="modal-content">
					      <div class="modal-header">
					        <button type="button" class="close" data-dismiss="modal">&times;</button>
					        <h4 class="modal-title">Pesquisa</h4>
					      </div>
					      <div class="modal-body">
							<form class="form-inline">
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
					
					
	<!-- Container (Portfolio Section) -->
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
							p.categoria_id=c.id ";
				
				if(isset($_GET['categoria_id'])){
					$categoria_id = intval($_GET['categoria_id']);
					$sql .= " AND p.categoria_id = $categoria_id";
				}
				
				if(isset($_GET['p'])){
					$pesquisa = $_GET['p'];
					$sql .= " AND (p.nome LIKE '$pesquisa%' OR c.nome LIKE '$pesquisa%')";
				}
				
				$sql .= " ORDER BY
							p.id DESC";
				$resProdutos = mysqli_query($con, $sql) or die(mysqli_error($con));
			?>
	<div id="services" style="padding: 50px;" class="container-fluid text-center bg-grey">
	
	<div style="text-align: left;">
			<a href="index.php?pagina=index.php" class="text-left">
				<span class="glyphicon glyphicon-chevron-left"> </span> Voltar</a>
	  	</div>
	
	  <h2 style="text-align: left; margin-bottom:0px; text-shadow:0px 3px 1px #CCC;">Listagem dos produtos</h2>
		<br><br>
	
	  <div class="row text-center">
	  
	  
	    	<?php 
	    	
	    		if(!empty(mysqli_affected_rows($con)) > 0){
	    		$i=0;
	    		while($linha = mysqli_fetch_assoc($resProdutos)){
	    			$i++;
	    	?>
	  
					<div class="col-sm-4 <?php if($i>2) echo "slideanim"; ?>">
				      <div class="thumbnail" style="padding: 2%; min-height: 567px;">
				      	<div style="height: 300px; overflow: hidden;">
				        	<img src="../admin/<?php echo $linha['imagem']; ?>" style="width: 100%; height:auto;" >
				        </div>
				        <h4><strong><?php echo $linha['produto'] ?> <br /> <?php echo $linha['categoria']; ?></strong></h4>
				       	<p style="text-align: left;">
				        	<label class="label label-default"><strong>Valor: </strong><?php echo Conversor::realBancoParaUsuario($linha['valor']); ?></label>
				        </p>
				        <p style="text-align:left;">
				        	<a href="javascript:void(0)" class="btn btn-default ">
				        	 	<span class="glyphicon glyphicon-plus"> </span> Adicionar ao carrinho</a>
				        </p>
				       
				      </div>
				    </div>
				    
	    	<?php } } else { ?>
	  
	  			<div style="margin-left:15px; text-align:left; margin-top: 30px;">
	  				<label class="label label-info" style="font-size: 17px;">Nenhum produto encontrado para <?php echo @$_GET['p']; ?></label>
	  				
	  				<a href="" style="display:block; margin-top:8px;" data-toggle="modal" data-target="#modal-pesquisa" ><span class="glyphicon glyphicon-search"> </span> Faça uma nova pesquisa</a>
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






<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-success" id="alerta-sucesso" role="alert">
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>
<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-info" id="alerta-info" role="alert">
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>
<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-warning" id="alerta-aviso" role="alert">
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>
<div style="position: fixed; top: 0; left:0; width: 100%; z-index: 9999; display: none;" class="alert alert-danger" role="alert"  id="alerta-erro">
  <strong class="titulo-alert"></strong> <label class="label-alert"></label>
</div>




</body>
</html>