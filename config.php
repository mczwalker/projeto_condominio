<?php

	try{
		global $pdo;
		$pdo = new PDO("mysql:dbname=projeto_condominio;host:localhost", "root", "");
	}catch(PDOException $e){
		echo "ERRO: ".$e->getMessage();
		exit;
	}

	$limite = 3;
?>
