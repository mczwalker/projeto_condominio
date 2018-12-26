<?php
	session_start();
	require 'config.php';

	if(empty($_SESSION['condLogin'])){
	header("Location: index.php");
	exit;
	}

	$bloco = $_GET['bl'];
	$ap = $_GET['ap'];

	$sql = $pdo->prepare("SELECT * FROM usuarios WHERE apartamento = :apartamento AND bloco = :bloco");
	$sql->bindValue(":bloco", $bloco);
	$sql->bindValue(":apartamento", $ap);
	$sql->execute();

	if($sql->rowCount() > 0){
	$sql = $sql->fetch();
	$nome = $sql['nome'];
	$user = $sql['id'];


	}else{
	header("Location: reserva_condominioview.php");

	exit;
	}


	$id=0;

	if(isset($_GET['id']) && empty($_GET['id']) == false){
		$id = addslashes($_GET['id']);
	}

		$sql = "UPDATE reserva SET status='RESERVADO', usuario='$nome', id_usuario='$user' WHERE id='$id'";
		$sql = $pdo->query($sql);

		header("Location: reserva_condominioview.php");

?>
