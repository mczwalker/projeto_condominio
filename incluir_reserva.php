<?php
	session_start();
	require 'config.php';

	if(empty($_SESSION['userLogin'])){
	header("Location: login.php");
	exit;
	}

	$user = $_SESSION['userLogin'];

	$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :user");
	$sql->bindValue(":user", $user);
	$sql->execute();

	if($sql->rowCount() > 0){
	$sql = $sql->fetch();
	$nome = $sql['nome'];

	}else{
	header("Location: login.php");
	exit;
	}


	$id=0;

	if(isset($_GET['id']) && empty($_GET['id']) == false){
		$id = addslashes($_GET['id']);
	}

		$sql = "UPDATE reserva SET status='RESERVADO', usuario='$nome', id_usuario='$user' WHERE id='$id'";
		$sql = $pdo->query($sql);

		header("location: inicio.php");

?>
