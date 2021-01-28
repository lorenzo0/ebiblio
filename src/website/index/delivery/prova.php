<!DOCTYPE html>
<?php
    
    session_start();

    $dsn = 'mysql:dbname=ebiblio;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $pdo = new PDO($dsn, $user, $password);  

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

     $note = $_POST['note'];
     $data = $_POST['data'];
     $tipologiaConsenga = $_POST['tipologiaConsegna']; 
     $emailUtilizzatore = $_POST['emailUtilizzatore'];
     $emailVolontario = $_POST['emailVolontario'];

    

    $sql = "SELECT Nome,Cognome FROM Utente WHERE TipoUtente = 'Utilizzatore'"; 
    $res = $pdo->query($sql);

     while($row = $res->fetch()) {
          echo "<option>" . $row['Nome'] ." ". $row['Cognome'] . "</option>";
     }    

    //aggiungo un id fittizio a prenotazione per testing, l'id della prenotazione non è ancora stato gestito.
   
    $sql = "INSERT INTO Consegna(IdConsegna, IdPrenotazioneCartaceo, EmailVolontario, EmailUtilizzatore, Note, Tipo, DataConsegna) VALUES ('0', '1', '$emailVolontario', '$emailUtilizzatore', '$note', '$tipologiaConsenga', '$data')";
    $pdo->exec($sql);

?>

