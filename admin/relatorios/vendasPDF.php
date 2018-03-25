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
				v.id,
				v.data_venda,
				v.hora_venda,
				v.valor_total,
				c.nome AS cliente,
				f.nome AS funcionario
			FROM
				vendas v, clientes c, funcionarios f
			WHERE
				v.funcionario_id = f.id
			AND
				v.cliente_id = c.id
			AND
				v.status=1";
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
					<th>Funcionário</th>
					<th>Data/Hora</th>
					<th>Total (R$)</th>
				</tr>
			</thead>
			
			<tbody>
				<?php while($linha=mysqli_fetch_array($res)){ ?>
					<tr>
						<td><b> <?php echo $linha['id']; ?> </b></td>
						<td><?php echo $linha['cliente']; ?></td>
						<td><?php echo $linha['funcionario']; ?></td>
						<td><?php echo $linha['data_venda']."/".$linha['hora_venda']; ?></td>
						<td><?php echo number_format($linha['valor_total'], 2, ",", "."); ?></td>
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


