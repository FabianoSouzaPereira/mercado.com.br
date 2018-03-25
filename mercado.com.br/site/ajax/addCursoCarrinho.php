<?php
	include "config_ajax.php";
	
	include 'cursosModel.php';
	$id = (int) $_GET['id_curso'];
	
	$modelProduto = new cursosModel();
	
	$curso = $modelProduto->ler($id);
	$i = count(@$_SESSION['carrinho']);
	
	//Adiciona um novo produto no carrinho
	$_SESSION['carrinho'][] = array(
		"id" => $curso['id'],
		"nome" => $curso['nome'],
		"valor" => $curso['valor'],
		"imagem" => $curso['caminho_imagem']
	);

	
	
?>

<tr id="linha-<?php echo $i; ?>">
	<td><img width='80' src="../admin/<?php echo $curso['caminho_imagem']; ?>" /></td>
	<td><?php echo $curso['nome']; ?></td>
	<td><?php echo $curso['valor'] ?></td>
	<td align="center" valign="middle"><a href="javascriot:void(0)" onclick="removerLinha(<?php echo $i; ?>)"><span class="glyphicon glyphicon-trash"> </span></a></td>		
</tr>