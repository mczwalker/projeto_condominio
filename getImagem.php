<?php
    require 'config.php';
    $PicNum = $_GET["PicNum"];
 

    /*$result=mysql_query("SELECT * FROM PESSOA WHERE PES_ID=$PicNum") or die("Impossível executar a query "); */


    $sql = "SELECT * from mural WHERE id=$PicNum";
    $sql = $pdo->query($sql);
    $row = $sql->fetch(PDO::FETCH_OBJ);
    Header( "Content-type: image/gif");

     
    echo $row->img; 




  




?>
