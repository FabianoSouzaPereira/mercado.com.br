<?php
	session_start();
	
	if(isset($_SESSION['carrinho'])){
		foreach($_SESSION['carrinho'] AS $i=>$curso){ ?>
			
			<tr id="linha-<?php echo $i; ?>">
				<td><img width='100' src="../admin/<?php echo $curso['imagem']; ?>" /></td>
				<td><?php echo $curso['nome']; ?></td>
				<td><?php echo $curso['valor'] ?></td>
				<td align="center" valign="middle"><a href="javascriot:void(0)" onclick="removerLinha(<?php echo $i; ?>)"><span class="glyphicon glyphicon-trash"> </span></a></td>		
			</tr>
		
	<?php 	
		}
		
	}
	
	?>

