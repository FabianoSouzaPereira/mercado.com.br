<?php

	$mincludes = array( "../biblioteca", "../" );
	
	//monta string com os diretrios par o include path
	$vincludes = implode( PATH_SEPARATOR, $mincludes );
	
	//seta os novos diretorios que os arquivos de include farão uma busca
	set_include_path( $vincludes );

	include "Conversor.php";
	include "Validador.php";
	include "conexao.php";
	
	$sql = "SELECT
					cli.id,
					cli.nome As cliente,
					cli.data_nascimento,
					cli.telefone,
					cli.email,
					c.nome AS cidade,
					e.sigla AS uf
				FROM
					estados e, cidades c, clientes cli
				WHERE
					cli.cidade_id = c.id
				AND
					c.estado_id = e.id
				AND
					cli.status=1
				ORDER BY
					cli.nome";
	$res = mysqli_query($con, $sql) or die(mysqli_error($con));
	
	ob_start();
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>

	<body>
		<table border="1" style="width: 100%;">
			<thead>
				<tr>
					<th>Id</th>
					<th>Cliente</th>
					<th>Data Nascimento</th>
					<th>Telefone</th>
					<th>E-mail</th>
					<th>Cidade|UF</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while($linha=mysqli_fetch_assoc($res)){ ?>
					<tr>
						<td><b> <?php echo $linha['id']; ?> </b></td>
						<td><?php echo $linha['cliente']; ?></td>
						<td><?php echo Conversor::dataBancoParaUsuario($linha['data_nascimento']); ?></td>
						<td><?php echo $linha['telefone']; ?></td>
						<td><?php echo $linha['email']; ?></td>
						<td><?php echo $linha['cidade']." | ". strtoupper($linha['uf']); ?></td>
					</tr>
				<?php } ?>
				
			</tbody>
			
			<tfoot>
				<tr>
					<th colspan="8" class="text-center"><?php echo date('d/m/Y h:i:s'); ?></th>
				</tr>
			</tfoot>
			
		</table>
	</body>
</html>

<?php 
	$html = ob_get_contents();
	ob_end_clean();
	//echo $html; die;

	include_once("dompdf/dompdf_config.inc.php");
	$dompdf = new DOMPDF();
	$dompdf->set_paper('letter', 'landscape'); // Altera o papel para modo paisagem.
	$dompdf->load_html($html, 'UTF-8'); // Carrega o HTML para a classe.
	$dompdf->render();
	
	$dompdf->stream(
    "RelatorioClientes-".date("Y-m-d").".pdf", /* Nome do arquivo de saída */
    array(
        "Attachment" => false /* Para download, altere para true */
    )
);



?>


