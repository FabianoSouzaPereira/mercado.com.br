<ul id="menu" class="nav nav-pills nav-justified navbar-fixed-top"> 
	<li role="presentation" class="active"><a href="index.php?pagina=inicio">Inicio</a></li> 
	<li role="presentation"><a href="index.php?pagina=categorias_listar">Categorias</a></li>
	<li role="presentation"><a href="index.php?pagina=produtos_listar">Produtos</a></li>  
	<li role="presentation"><a href="index.php?pagina=clientes_listar">Clientes</a></li>  
	<li role="presentation"><a href="index.php?pagina=funcionarios_listar">Funcionários</a></li> 
	<li role="presentation"><a href="index.php?pagina=vendas_listar">Vendas</a></li>
	
	<li role="presentation" class="dropdown">
		<a href="#" data-toggle="dropdown">Localidades <span class="caret"> </span></a>
		<ul class="dropdown-menu"> 
			<li><a href="index.php?pagina=estados_cadastrar">Novo Estado</a></li> 
			<li><a href="index.php?pagina=cidades_cadastrar">Nova Cidade</a></li> 
			<li role="separator" class="divider"></li> 
			<li><a href="index.php?pagina=estados_listar">Listar Estados</a></li> 
			<li><a href="index.php?pagina=cidades_listar">Listar Cidades</a></li> 
		</ul> 
	</li> 
	
	<li role="presentation" class="dropdown"> 
		<a class="dropdown-toggle" data-toggle="dropdown" href="#"> Relatórios <span class="caret"> </span> </a> 
		<ul class="dropdown-menu"> 
			<li><a target="new" href="relatorios/vendasPDF.php">Vendas</a></li> 
			<li><a target="new" href="relatorios/clientesPDF.php">Clientes</a></li> 
			<li><a target="new" href="relatorios/funcionariosPDF.php">Funcionários</a></li> 
		</ul> 
	</li> 
	<li role="presentation"><a href="logout.php">Logout</a></li>
</ul>