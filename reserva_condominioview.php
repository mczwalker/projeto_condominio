<?php
	session_start();
	require 'config.php';
	if(empty($_SESSION['condLogin'])){
	header("Location: login.php");
	exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>ORGANIZA - GESTÃO DE CONDOMÍNIOS - RESERVAS</title>
		<link rel="stylesheet" type="text/css" href="css/estilo2.css"/>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>
	<body>

		<div class="container-fluid">
			<?php include "menu.php"; ?>
</br></br>	
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
	<h3>ITENS RESERVADOS</h3>

<?php
	$user = $_SESSION['condLogin'];
	$sql = "SELECT * from reserva WHERE status='RESERVADO'";
	$sql = $pdo->query($sql);


	if($sql->rowCount() > 0){
			foreach ($sql->fetchAll() as $reserva) {
			echo '<tr>';
			echo '<td>'.$reserva['item'].'</td>';
			echo '<td>'.$reserva['status'].'</td>';
			echo '<td>'.$reserva['usuario'].'</td>';
			echo '<td><a href="excluir_reserva_condominioview.php?id='.$reserva['id'].'">Excluir</a></td>';
			echo '</tr>';
		}
	}
	else{
		echo "Não há itens reservados.";		
	}
?>
	<hr/>
			<table class="table">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Item</th>
						<th scope="col">Status</th>
						<th scope="col">Bloco Reservante</th>
						<th scope="col">Apartamento Reservante</th>
						<th scope="col">Ação</th>
					</tr>
				</thead>
	</br></br>			
	<h3>ITENS DISPONÍVEIS</h3>

<?php
	$user = $_SESSION['condLogin'];
	$sql = "SELECT * from reserva WHERE status='DISPONIVEL'";
	$sql = $pdo->query($sql);


	if($sql->rowCount() > 0){
			foreach ($sql->fetchAll() as $reserva) {
			echo '<tr>';
			echo '<td>'.$reserva['item'].'</td>';
			echo '<td>'.$reserva['status'].'</td>';
			echo '<form action="incluir_reserva_condominioview.php" method="get">';
			echo '<td><input type="number" name="bl"></input></td>';
			echo '<td><input type="number" name="ap"></input></td>';
			echo '<input type="hidden" name="id" value="'.$reserva['id'].'">';
			echo '<td><input type="submit" value="Reservar"></input></td>';
			echo '</form>';
			echo '</tr>';
		}
	}
	else{
		echo "Não há itens disponíveis para reserva";		
	}
?>


		</tr>
		</tbody>
		</table>
	</div>
	</body>
</html>