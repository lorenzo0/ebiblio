<?php

    $dsn = 'mysql:dbname=sql7381971;host=sql7.freesqldatabase.com';
    $user = 'sql7381971';
    $password = '5mDynVUEzp';

    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $nomeUtente = $_POST['nomeUtente'];
    $cognomeUtente = $_POST['cognomeUtente'];
    $emailUtente = $_POST['emailUtente'];
    $passwordUtente = $_POST['passwordUtente'];
    $dataDiNascitaUtente = $_POST['dataDiNascitaUtente'];
    $luogoDiNascitaUtente = $_POST['luogoDiNascitaUtente'];
    if($_POST['recapitoUtente'] != '')
        $recapitoUtente = $_POST['recapitoUtente'];
    

    
?>

