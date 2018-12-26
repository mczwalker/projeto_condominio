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

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Item</th>
      <th scope="col">Status</th>
      <th scope="col">Reservante</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>

<!--<table border="1" width="100%">
	<tr>
		<th>Item</th>
		<th>Status</th>
		<th>Reservante</th>
		<th>Ação:</th>
	</tr>
	</br>
	</br>
	</br>-->
<h3>SUAS RESERVAS</h3>



<?php

	$user = $_SESSION['userLogin'];


	$sql = "SELECT * from reserva WHERE status='RESERVADO' AND id_usuario ='$user'";
	$sql = $pdo->query($sql);

	if($sql->rowCount() > 0){
		foreach ($sql->fetchAll() as $reserva) {
		echo '<tbody>';
	    echo '<tr>';
	   	echo '<td>'.$reserva['item'].'</td>';
	    echo '<td>'.$reserva['status'].'</td>';
	    echo '<td>'.$reserva['usuario'].'</td>';
	    echo '<td><a href="excluir_reserva.php?id='.$reserva['id'].'">Cancelar Reserva</a></td>';
	    echo '</tr>';
	  	echo '</tbody>';
		echo '</table>';
		}
	}
	else{
		echo '<div class="alert alert-info" role="alert">';
  		echo "Não há itens reservados";
		echo '</div>';		
	}
?>

</div>
</body>
</html>


