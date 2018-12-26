<?php
require 'config.php';
session_start();


if(empty($_SESSION['userLogin'])){
	if(empty($_SESSION['condLogin'])){
		header("Location: index.php");
		exit;
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
	 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	 <link rel="stylesheet" type="text/css" href="css/estilo.css"/>
</head>
<body>

<div class="container-fluid">
	<?php 

	if(isset ($_SESSION['condLogin'])){
		include "menu.php"; 
	}else{
		include "menu_usuario.php";
	}


	?>
	<div class="div_flex">

		<?php
		$sql = "SELECT * from mural";
			$sql = $pdo->query($sql);

			while($row = $sql->fetch(PDO::FETCH_OBJ)){
			echo "<div class='titulo_aviso'><h4>$row->titulo</h4></div>";
			echo "<div class='corpo_aviso'><img src='getImagem.php?PicNum=$row->id' \></div>";

			if(!empty($_SESSION['condLogin'])){
				echo '<a href="excluir_aviso.php?id='.$row->id.'">Excluir</a>';
			}
			echo "</br></br>";	
			}

		?>
	</div>
</div>

</body>
</html>