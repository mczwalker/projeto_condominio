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




<table class="table">
	<thead class="thead-dark">
	<tr>
		<th scope="col">Nome Visitante</th>
		<th scope="col">RG</th>
		<th scope="col">Apartamento do Responsavel</th>
		<th scope="col">Bloco do Responsavel</th>
		<th scope="col">Data Entrada:</th>
	</tr>
	</thead>


<?php
session_start();
require 'config.php';

if(empty($_SESSION['condLogin'])){
	header("Location: login.php");
	exit;
}

if(!empty($_POST['nome']) && !empty($_POST['bloco']) && !empty($_POST['apartamento'])){
	$nome =addslashes($_POST['nome']);
	$rg =addslashes($_POST['rg']);
	$apartamento =addslashes($_POST['apartamento']);
	$bloco =addslashes($_POST['bloco']);
	$data = date('Y-m-d H:i:s');


	$sql = $pdo->prepare("INSERT INTO visitantes (nome, rg, ap_responsavel, bl_responsavel, data) VALUES (:nome, :rg, :apartamento, :bloco, :data)");
	$sql->bindValue(":nome", $nome);
	$sql->bindValue(":rg", $rg);
	$sql->bindValue(":apartamento", $apartamento);
	$sql->bindValue(":bloco", $bloco);
	$sql->bindValue(":data", $data);
	$sql->execute();

	header("Location: cadastro_visitantes.php");
	exit;
}



	$sql = "SELECT * from visitantes";
	$sql = $pdo->query($sql);


	if($sql->rowCount() > 0){
		foreach ($sql->fetchAll() as $visitantes) {
			echo '<tr>';
			echo '<td>'.$visitantes['nome'].'</td>';
			echo '<td>'.$visitantes['rg'].'</td>';
			echo '<td>'.$visitantes['bl_responsavel'].'</td>';
			echo '<td>'.$visitantes['ap_responsavel'].'</td>';
			echo '<td>'.$visitantes['data'].'</td>';
			echo '</tr>';
		}	
	}else{
		echo "Não há visitantes!";
	}	

	echo '</br></br>';
?>

<form method="POST">
	Nome:</br>
	<input type="text" name="nome" /></br></br>
	RG:</br>
	<input type="text" name="rg" /></br></br>
	Apartamento do Responsavel:</br>
	<input type="text" name="apartamento" /></br></br>
	Bloco do Responsavel:</br>
	<input type="text" name="bloco" /></br></br>
	<input type="submit" value="cadastrar"/>
</form>

<br><br>
<hr/>
</div>
</body>
</html>





