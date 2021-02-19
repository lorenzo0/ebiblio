<?php

require '../../../../connectionDB/connection.php';

$isbn = $_POST['codiceIsbn'];

try{
    $sql = "SELECT *
        FROM libro
        WHERE CodiceISBN = '$isbn'";
    $res = $pdo -> query($sql);
}catch(PDOException $e){echo $e->getMessage();}	

while ($row = $res->fetch()) {
    $tipoLibro = $row['TipoLibro'];
}

if($tipoLibro != ''){
    header("location: libroPresente.php?isbn='$isbn'&tipo=$tipoLibro");
}else
    header("location: inserimentoLibro.php?isbn='$isbn'");

    

?>