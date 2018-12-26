<?php
session_start();
require 'config.php';


if(empty($_SESSION['condLogin'])){
  header("Location: index.php");
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
	<?php include "menu.php"; ?>
 	<form action="gravar.php" method="POST" enctype="multipart/form-data">
        <label for="imagem">Imagem:</label><br>
        <input type="file" name="imagem"/><br><br>
        <label for="titulo">Titulo:</label><br>
        <input type="text" name="titulo"/>
        <br><br><br>
        <input type="submit" value="Enviar"/>
    </form>
</div>
</body>
</html>