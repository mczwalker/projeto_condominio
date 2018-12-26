<?php
session_start();
require 'config.php';

if(empty($_SESSION['condLogin'])){
	header("Location: index.php");
	exit;
}

if(!empty($_POST['nome']) && !empty($_POST['cpf'])){
	$nome =addslashes($_POST['nome']);
	$cpf =addslashes($_POST['cpf']);
	$email =addslashes($_POST['email']);
	$telefone =addslashes($_POST['telefone']);
	$apartamento =addslashes($_POST['apartamento']);
	$bloco =addslashes($_POST['bloco']);
	$valor =addslashes($_POST['valor_condominio']);
	$senha = md5(addslashes($_POST['senha']));


	$sql = $pdo->prepare("SELECT * FROM usuarios WHERE cpf = :cpf");
	$sql->bindValue(":cpf", $cpf);
	$sql->execute();

	if($sql->rowCount()==0){
		$sql = $pdo->prepare("INSERT INTO usuarios (nome, cpf, telefone, apartamento, bloco, email, senha, valor_condominio) VALUES (:nome, :cpf, :telefone, :apartamento, :bloco, :email, :senha, :valor_condominio)");
		$sql->bindValue(":nome", $nome);
		$sql->bindValue(":cpf", $cpf);
		$sql->bindValue(":telefone", $telefone);
		$sql->bindValue(":apartamento", $apartamento);
		$sql->bindValue(":bloco", $bloco);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":senha", $senha);
		$sql->bindValue(":valor_condominio", $valor);
		$sql->execute();

		header("Location: inicio_condominio.php");
		exit;
	}else{
		echo "Já existe este usuário cadastrado!";
	}
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>ORGANIZA - GESTÃO DE CONDOMÍNIOS - PAGINA INICIAL</title>
	 <link rel="stylesheet" type="text/css" href="css/estilo2.css"/>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
</head>
</body>
<div class="container-fluid">
<?php include "menu.php"; ?>
</br></br>
<div class="div_center">
	<div class="form-group">
		<form method="POST">
			Nome:</br>
			<input type="text" class="form-control" name="nome" /></br></br>
			CPF:</br>
			<input type="text" class="form-control" name="cpf" /></br></br>
			Telefone:</br>
			<input type="text" class="form-control" name="telefone" /></br></br>
			Apartamento:</br>
			<input type="text" class="form-control" name="apartamento" /></br></br>
			Bloco:</br>
			<input type="text" class="form-control" name="bloco" /></br></br>
			E-mail:</br>
			<input type="email" class="form-control" id="exampleInputEmail1" name="email" /></br></br>
			Valor do Condominio:</br>
			<input type="number" class="form-control" name="valor_condominio" /></br></br>
			Senha:</br>
			<input type="password" class="form-control" name="senha" /></br></br>
			<input type="submit" class="btn btn-dark" value="cadastrar"/>
		</form>
	</div>
</div>
<hr/>
</div>
</body>
</html>