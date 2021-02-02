<?php

require '../../../connectionDB/connection.php';

$isbn = $_POST['codiceIsbn'];

$sql = "SELECT *
        FROM libro
        WHERE CodiceISBN = '$isbn'";
  
//Da sostituire quando (se) inseriamo il campo tipo
$res = $pdo -> exec($sql);

if($res != 0){
    while($row = $result->fetch_assoc()) {
        $_SESSION["tipoLibro"] = $row["TipoLibro"];
    }
    header("location: libroPresente.php?isbn='$isbn'");
}else
    header("location: inserimentoLibro.php?isbn='$isbn'");

    

?>