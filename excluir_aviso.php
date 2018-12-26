<?php
	session_start();
	require 'config.php';

	if(empty($_SESSION['condLogin'])){
	header("Location: index.php");
	exit;
	}

	$user = $_SESSION['condLogin'];

	/*$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :user");
	$sql->bindValue(":user", $user);
	$sql->execute();

	if($sql->rowCount() > 0){
	$sql = $sql->fetch();
	$nome = $sql['nome'];

	}else{
	header("Location: login.php");
	exit;
	}*/


	$id=0;

	if(isset($_GET['id']) && empty($_GET['id']) == false){
		$id = addslashes($_GET['id']);
	}
		
		$sql = "DELETE FROM mural WHERE id='$id'";
		$sql = $pdo->query($sql);

		header("location: mural.php");

?>
