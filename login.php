<?php
session_start();
require 'config.php';

if(!empty($_POST['email'])){
	$email = addslashes($_POST['email']);
	$senha = addslashes($_POST['senha']);

	$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
	$sql->bindValue(":email", $email);
	$sql->bindValue(":senha", md5($senha));
	$sql->execute();

	if($sql->rowCount() > 0){
		$sql = $sql->fetch();
		$_SESSION['userLogin'] = $sql['id'];
		header("Location: inicio.php");
		exit;
	}else{
		echo "Usuário e/ou Senha errados!";
	}
}

?>

<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Random Login Form</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/style.css"/>

</head>

<body>

  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>Orga<span>Niza</span></div><br>
		</div>
		<br>
		<div class="login">
			<form method="POST">
				<input type="text" placeholder="E-mail" name="email"><br>
				<input type="password" placeholder="Senha" name="senha"><br>
				<input type="submit" value="Login">
			</form>
		</div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

</body>

</html>
