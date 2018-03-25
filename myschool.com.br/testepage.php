<?php


use modules\studentbody\Student;

trait testepage {
    function getCityes(){
        $dados = array($city);
        $sqlcidade = "SELECT
                        a.id,
                        a.name,
                        a.state,
                        a.country,
                        b.id,
                        b.name,
                        b.state
                      FROM
                        state a
                        Right JOIN city b ON
                        a.id = b.state
                      WHERE a.id = :city;";
        $stmt = $pdo->prepare($sql);
        
               
        $stmt->execute($dados);
    }
}

?>
<form action="" method="post" class="panel panel-warning">
	<div class="panel-heading">
		<h3>Cadastro de Alunos</h3>
	</div>
	<div class="panel-body">
		<a href="index.php?pagina=clientes_listar"> <span
			class="glyphicon glyphicon-chevron-left"> </span> Voltar
		</a> <br>
		<br>
	<?php if(isset($valida) && $valida==false){ ?>  
		<div class="alert alert-danger">
			<h3>Foram encontrados os seguinte erros!</h3>
			<ul>
				<?php echo $mensagemErro; ?> 
			</ul>
		</div>
	 <?php } ?> 
		<div class="form-group">
			<label for="name">Nome</label> 
			<input type="text" value="<?php echo @$_POST['name']; ?>" class="form-control"
				name="name" id="name" placeholder="Digite o nome do cliente">
		</div>
		<div class="form-group">
			<label for="birthdate">Data Nascimento</label> 
			<input type="text" value="<?php echo @$_POST['birthdate']; ?>"
				class="form-control mascaraData" name="birthdate"
				id="birthdate" placeholder="Digite a data de nascimento">
		</div>
		<div class="form-group">
			<label for="telefone">Telefone</label> <input type="text"
				value="<?php echo @$_POST['ftelefone']; ?>"
				class="form-control mascaraTelefone" name="ftelefone" id="telefone"
				placeholder="Digite o telefone do cliente">
		</div>
		<div class="form-group">
			<label for="email">E-mail</label> 
			<input type="text" value="<?php echo @$_POST['femail']; ?>" class="form-control"
				name="femail" id="email" placeholder="Digite o e-mail do cliente">
		</div>
		
		<div class="form-group">
			<label for="address">Endereço</label> 
			<input type="text" value="<?php echo @$_POST['address']; ?>" class="form-control"
				name="address" id="address" placeholder="Digite o endereço do cliente">
		</div>
		<div class="form-group">
			<label for="neighborhood">Bairro</label> 
			<input type="text" value="<?php echo @$_POST['neighborhood']; ?>" class="form-control"
				name="neighborhood" id="neighborhood" placeholder="Digite o bairro do cliente">
		</div>
<!-- //============================================================ -->
		<div class="form-group">
		
		<label>Cidade</label>
  <select name="tipoBeneficiario">
    <option value="0" <?=($city == 'Selecione')?'selected':''?> >Selecione</option>
    <option value="1" <?=($city == 'porto alegre')?'selected':''?> >Conjugue</option>
    <option value="2" <?=($city == 'Filho')?'selected':''?> >Filho</option>
    <option value="3" <?=($city == 'Mãe/Pai')? 'selected':''?> >Mãe/Pai</option>
    <option value="4" <?=($$city == 'Companheira(o)')?'selected':''?> >Compannheira(o)</option>
  </select>
		</div>
<!-- //=============================================================== -->
		<div class="form-group">
			<label for="state">Estado</label> 
			<input type="text" value="<?php echo @$_POST['state']; ?>" class="form-control"
				name="state" id="state" placeholder="Digite o estado do cliente">
		</div>
		<div class="form-group">
			<label for="cowntry">Pais</label> 
			<input type="text" value="<?php echo @$_POST['cowntry']; ?>" class="form-control"
				name="cowntry" id="cowntry" placeholder="Digite o pais do cliente">
		</div>
		<div class="form-group">
			<label for="zipcode">Cep</label> 
			<input type="text" value="<?php echo @$_POST['zipcode']; ?>" class="form-control"
				name="zipcode" id="zipcode" placeholder="Digite o cep do cliente">
		</div>
		<div class="form-group">
			<label for="stusponsor">Responsável</label> 
			<input type="text" value="<?php echo @$_POST['stusponsor']; ?>" class="form-control"
				name="stusponsor" id="stusponsor" placeholder="Digite o Responsável">
		</div>
		
		<div class="form-group">
			<input type="submit" class="btn btn-success" value="Enviar"> 
			<input type="reset" class="btn btn-default" value="Limpar Campos">
		</div>
	</div>
</form>

