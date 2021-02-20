<?php

require '../../../../connectionDB/connection.php';

$IsbnLibro = $_GET['Id'];
$nomeBiblioteca = $_GET['Nome'];
$email = $_SESSION['email-accesso'];

$inizio = date("y-m-d");
$fine =  date('y-m-d', strtotime("+15 days"));


try{
    $sql = "INSERT INTO PrenotazioneCartaceo VALUES(0, $IsbnLibro, '$inizio', '$fine', '$email', '$nomeBiblioteca')";
    $res = $pdo -> query($sql);
    
}catch(PDOException $e){echo $e->getMessage();}	


if($res->rowCount() > 0)
    echo "<script> alert('Prenotazione effettuata correttamente!'); window.location.href='../../home/home.php'; </script>";
else
    echo "<script> alert('La prenotazione NON è stato effettuata, riprova!'); window.location.href='controllaDisponibilita.php'; </script>";


?>

<!--IdPrenotazioneCartaceo, CodiceISBNCartaceo, AvvioPrenotazione, FinePrenotazione, EmailUtilizzatore, NomeBiblioteca-->