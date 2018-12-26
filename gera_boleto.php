<?php
session_start();
require 'config.php';


if(empty($_SESSION['userLogin'])){
	header("Location: login.php");
	exit;
}
$id = $_SESSION['userLogin'];

$sql = $pdo->prepare("SELECT nome FROM usuarios WHERE id = :id");
$sql->bindValue(":id", $id);
$sql->execute();

if($sql->rowCount() > 0){
	$sql = $sql->fetch();
	$nome = $sql['nome'];

}else{
	header("Location: login.php");
	exit;
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
	<?php include "menu_usuario.php"; ?>
</br></br>
<h6>Bem Vindo: <?php echo $nome; ?></h6>
<hr/>

<?php

	$user = $_SESSION['userLogin'];

	/*$sql = "SELECT valor_condominio FROM usuarios WHERE id ='$user'";*/
	$sql = "SELECT * FROM usuarios WHERE id ='$user'";
	$sql = $pdo->query($sql);


	if($sql->rowCount() > 0){
		foreach ($sql->fetchAll() as $valor) {

			echo '<form method="POST" name="valor" action="boletos/boleto_itau.php">';
			echo '<input type="hidden" name="nome" value="'. $valor['nome'] .'" />';
			echo '<input type="hidden" name="valor" value="'. $valor['valor_condominio'] .'" />';
			echo '<input type="submit" value="Gerar Boleto" /> ';
			echo '</form>';
		}
	}
	else{
		echo "Não há itens reservados";
	}
?>

</div>
</body>
</html>