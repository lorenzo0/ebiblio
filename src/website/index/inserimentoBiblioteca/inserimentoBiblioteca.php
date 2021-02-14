<?php
                
    require '../../../connectionDB/connection.php';

    $nomeBiblioteca= $_POST['nomeBiblioteca'];
    $indirizzo = $_POST['indirizzo'];
    $email = $_POST['email'];
    $sito = $_POST['sito'];
    $latitudine = $_POST['latitudine'];
    $longitudine = $_POST['longitudine'];
    $recapito = $_POST['recapito'];
    $note = $_POST['note'];

 
    $sql = "INSERT INTO Biblioteca (Nome, Indirizzo, Email, URLSito, Latitudine, Longitudine, Recapito, Note) VALUES ('$nomeBiblioteca','$indirizzo','$email','$sito','$latitudine', '$longitudine','$recapito','$note' )";

    $res=$pdo->query($sql);

     if ($res>0) {
       echo "<script> alert('Record inserito nel DB!'); window.location.href='../visualizzazione/visualizzazioneBiblioteca.php'; </script>";
     } else {
       echo "<script> alert('Il record NON è stato inserito!'); window.location.href='inserimentoBiblioteca.html'; </script>";
     }

?>