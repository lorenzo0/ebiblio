<?php

    $dsn = 'mysql:dbname=sql7381971;host=sql7.freesqldatabase.com';
    $user = 'sql7381971';
    $password = '5mDynVUEzp';

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $nomeUtente = $_POST['nome'];
    $cognomeUtente = $_POST['cognome'];
    $emailUtente = $_POST['email'];
    $passwordUtente = $_POST['passwordUtente'];
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

    /*echo $nomeUtente . " - " . $cognomeUtente . " - " . $emailUtente . " - " . $passwordUtente . " - " . $dataNascitaUtente . " - " . $nomeBiblioteca . " - " . $tipoUtente . " - " . $recapitoUtente . " - " . $luogoNascitaUtente;*/

    try {
        $sql = "INSERT INTO Utente VALUES('$emailUtente', '$nomeUtente', '$cognomeUtente', '$passwordUtente', '$dataNascitaUtente', '$luogoNascitaUtente', '$recapitoUtente', '$tipoUtente', 'In attesa')";
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
        
        if($res != 0)
            header("location: ../registration/successfullRequest.html");
        
    }else{
        header("location: ../registration/rejectedRequest.html");
    }



?>