<?php
	session_start();
	require 'config.php';
	if(empty($_SESSION['userLogin'])){
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
			<?php include "menu_usuario.php"; ?>
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


			 <h3>ITENS PARA RESERVA</h3>

<?php
	$user = $_SESSION['userLogin'];
	$sql = "SELECT * from reserva WHERE status='RESERVADO' AND id_usuario='$user'";
	$sql = $pdo->query($sql);


	if($sql->rowCount() > 0){
		echo '<div class="alert alert-danger" role="alert">';
		echo "Você já tem uma reserva pendente. Por favor, finalize sua reserva para poder selecionar outro item.";
		echo '<a href="inicio.php"><strong> Voltar</strong></a>';
		echo '</div>';
	}
	else{
		$sql = "SELECT * from reserva WHERE status='DISPONIVEL'";
		$sql = $pdo->query($sql);

		if($sql->rowCount() > 0){
			foreach ($sql->fetchAll() as $reserva) {
				echo '<tbody>';
			    echo '<tr>';
			   	echo '<td>'.$reserva['item'].'</td>';
			    echo '<td>'.$reserva['status'].'</td>';
			    echo '<td>'.$reserva['usuario'].'</td>';
				echo '<td><a href="incluir_reserva.php?id='.$reserva['id'].'">Reservar</a></td>';
			}
		}
		else{

			echo '<div class="alert alert-danger" role="alert">';
  			echo "Não há itens disponíveis para reserva";
			echo '</div>';
			
		}		
	}	
?>
		</tr>
		</tbody>
		</table>
	</div>
	</body>
</html>
