<?php

require '../../../../connectionDB/connection.php';

$idPL = $_GET['Id'];
$oraInizio = $_GET['Inizio'] . ':00:00';
$oraFine = $_GET['Fine'] . ':00:00';
$data = $_GET['Data'];
$email = $_SESSION['EmailUtente'];


try{
  

    $sql = $pdo->prepare("INSERT INTO PrenotazionePostoLettura VALUES(?, ?, ?, ?, ?)");
    
    $sql->bindParam(1, $idPL, PDO::PARAM_INT);
    $sql->bindParam(2, $email, PDO::PARAM_STR);
    $sql->bindParam(3, $oraInizio, PDO::PARAM_STR);
    $sql->bindParam(4, $oraFine, PDO::PARAM_STR);
    $sql->bindParam(5, $data, PDO::PARAM_STR);
    
    $res = $sql->execute();
    
}catch(PDOException $e){echo $e->getMessage();}	

if($res > 0)
    echo "<script> alert('Prenotazione effettuata correttamente!'); window.location.href='../../home/home.php'; </script>";
else
    echo "<script> alert('La prenotazione NON è stato effettuata, riprova!'); window.location.href='controllaDisponibilita.php'; </script>";


?>