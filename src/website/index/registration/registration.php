<?php

    require '../../../connectionDB/connection.php';

    $nomeUtente = $_POST['nome'];
    $cognomeUtente = $_POST['cognome'];
    $emailUtente = $_POST['email'];
    $passwordUtente = $_POST['passwordUtente'];
    $passwordUtente = md5($passwordUtente);
    $dataNascitaUtente = $_POST['dataNascita'];
    $nomeBiblioteca = $_POST['nomeBiblioteca'];
    $tipoUtente = $_POST['tipoUtente'];


    if($_POST['recapito'] != '')
        $recapitoUtente = $_POST['recapito'];
    else
        $recapitoUtente = null;

    if($_POST['qualifica'] != '')
        $qualifica = $_POST['qualifica'];

    if($_POST['mezzoDiTrasporto'] != '')
        $mezzoDiTrasporto = $_POST['mezzoDiTrasporto'];

    if($_POST['professione'] != '')
        $professione = $_POST['professione'];

    $luogoNascitaUtente = $_POST['luogoNascita'];

    try {
        $sql = "INSERT INTO Utente VALUES('$emailUtente', '$nomeUtente', '$cognomeUtente', '$passwordUtente', '$dataNascitaUtente', '$luogoNascitaUtente', '$recapitoUtente', '$tipoUtente')";
        $res=$pdo->exec($sql);
    }catch(PDOException $e) {
        echo("Query SQL Failed: ".$e->getMessage());
        exit();
    }

    if($res != 0){
        switch($tipoUtente){
            case 'amministratore':
                try {
                    $sql = "INSERT INTO Amministratore VALUES('$emailUtente', '$qualifica')";
                    $res=$pdo->exec($sql);
                }catch(PDOException $e) {
                    echo("Query SQL Failed: ".$e->getMessage());
                    exit();
                }
                break;
                
            case 'utilizzatore':
                $currentData = date("Y/m/d");
                try {
                    $sql = "INSERT INTO Utilizzatore VALUES('$emailUtente', '$professione', 'In attesa', '$currentData')";
                    $res=$pdo->exec($sql);
                }catch(PDOException $e) {
                    echo("Query SQL Failed: ".$e->getMessage());
                    exit();
                }
                break;
                
            case 'volontario':
                try {
                    $sql = "INSERT INTO Volontario VALUES('$emailUtente', '$mezzoDiTrasporto')";
                    $res=$pdo->exec($sql);
                }catch(PDOException $e) {
                    echo("Query SQL Failed: ".$e->getMessage());
                    exit();
                }
                break;
        }
        
        //da inserire homepage
        if($res != 0)
            echo "<script> alert('Richiesta processata correttamente!'); window.location.href='profilo.php'; </script>";
        
    }else{
        echo "<script> alert('La richiesta NON è stata processata correttamente!'); window.location.href='loginPage.html'; </script>";
    }



?>