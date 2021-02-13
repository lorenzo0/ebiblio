<?php

    require '../../../connectionDB/connection.php';

    $nomeUtente = $_POST['nome'];
    $cognomeUtente = $_POST['cognome'];
    $emailUtente = $_POST['email'];
    $passwordUtente = $_POST['passwordUtente'];
    $passwordUtente = md5($passwordUtente);
    $dataNascitaUtente = $_POST['dataNascita'];
    $tipoUtente = $_POST['tipoUtente'];
    $luogoNascitaUtente = $_POST['luogoNascita'];
    $recapitoUtente = $_POST['recapito'];
    $professione = $_POST['professione'];

    

    try {
        $sql = "INSERT INTO Utente VALUES('$emailUtente', '$nomeUtente', '$cognomeUtente', '$passwordUtente', '$dataNascitaUtente', '$luogoNascitaUtente', '$recapitoUtente', '$tipoUtente')";
        $res=$pdo->exec($sql);
    }catch(PDOException $e) {
        echo("Query SQL Failed: ".$e->getMessage());
        exit();
    }

    if($res != 0){
            $currentData = date("Y/m/d");
            try {
                $sql = "INSERT INTO Utilizzatore VALUES('$emailUtente', '$professione', 'Attivo', '$currentData')";
                $res=$pdo->exec($sql);
            }catch(PDOException $e) {
                echo("Query SQL Failed: ".$e->getMessage());
                exit();
            }
        }
        
    
    if($res != 0)
        echo "<script> alert('Richiesta processata correttamente!'); window.location.href='../login/loginPage.html'; </script>";
    else
        echo "<script> alert('La richiesta NON è stata processata correttamente!'); window.location.href='registrationPage.php'; </script>";

?>