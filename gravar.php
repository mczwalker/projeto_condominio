<?php
require 'config.php';
 
$imagem = $_FILES["imagem"];
$titulo = $_POST['titulo'];

 
if($imagem != NULL) { 
    $nomeFinal = time().'.jpg';
    if (move_uploaded_file($imagem['tmp_name'], $nomeFinal)) {
        $tamanhoImg = filesize($nomeFinal); 
 
        $mysqlImg = addslashes(fread(fopen($nomeFinal, "r"), $tamanhoImg));       


        $sql = $pdo->prepare("INSERT INTO mural (titulo, img) VALUES (:titulo, '$mysqlImg')");
        $sql->bindValue(":titulo", $titulo);
        $sql->execute();
        unlink($nomeFinal);
        header("location:mural.php");


         



    }
} 
else { 
    echo"Você não realizou o upload de forma satisfatória."; 
} 
 
?>