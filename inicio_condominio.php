<?php
session_start();
require 'config.php';


if(empty($_SESSION['condLogin'])){
  header("Location: index.php");
  exit;
}
$id = $_SESSION['condLogin'];

$sql = $pdo->prepare("SELECT nome_cond FROM condominios WHERE id_cond = :id");
$sql->bindValue(":id", $id);
$sql->execute();

if($sql->rowCount() > 0){
  $sql = $sql->fetch();
  $nome = $sql['nome_cond'];

}else{
  header("Location: erro.php");
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
</br></br>
<h6>Bem Vindo: <?php echo $nome; ?></h6>
<hr/>
</div>
</body>
</html>