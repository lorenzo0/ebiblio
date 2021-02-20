<?php

require '../../../../connectionDB/connection.php';

$idPL = $_GET['Id'];
$oraInizio = $_GET['Inizio'] . ':00:00';
$oraFine = $_GET['Fine'] . ':00:00';
$data = $_GET['Data'];
$email = $_SESSION['email-accesso'];



try{
    $sql = "INSERT INTO PrenotazionePostoLettura VALUES($idPL, '$email', '$oraInizio', '$oraFine', '$data')";
    $res = $pdo -> query($sql);
    
}catch(PDOException $e){echo $e->getMessage();}	

if($res->rowCount() > 0)
    echo "<script> alert('Prenotazione effettuata correttamente!'); window.location.href='../../home/home.php'; </script>";
else
    echo "<script> alert('La prenotazione NON è stato effettuata, riprova!'); window.location.href='controllaDisponibilita.php'; </script>";


?>