<?php
	session_start();
	require 'config.php';

	if(empty($_SESSION['condLogin'])){
	header("Location: index.php");
	exit;
	}

	$user = $_GET['id'];

	$sql = $pdo->prepare("SELECT * FROM reserva WHERE id = :user");
	$sql->bindValue(":user", $user);
	$sql->execute();

	if($sql->rowCount() > 0){
	$sql = $sql->fetch();

	}else{
	echo $user;
	header("Location: index.php");
	exit;
	}


	$id=0;

	if(isset($_GET['id']) && empty($_GET['id']) == false){
		$id = addslashes($_GET['id']);
	}

		$sql = "UPDATE reserva SET status='DISPONIVEL', usuario='', id_usuario='0' WHERE id='$id'";
		$sql = $pdo->query($sql);

		header("location: reserva_condominioview.php");

?>



