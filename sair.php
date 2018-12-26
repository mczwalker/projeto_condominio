<?php
	session_start();
	unset($_SESSION['userLogin']);
	unset($_SESSION['condLogin']);
	header("Location: index.php");
	exit;
?>