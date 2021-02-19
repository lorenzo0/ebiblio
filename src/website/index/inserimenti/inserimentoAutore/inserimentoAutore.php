<?php

    require '../../../../connectionDB/connection.php';
    session_start();

    /*$dsn = 'mysql:dbname=ebiblio;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $pdo = new PDO($dsn, $user, $password);  

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }*/

    $nomeAutore = $_POST['nomeAutore'];
 
    $sql = "INSERT INTO Autore (Id, NomeAutore) VALUES (0,'$nomeAutore')";
    $pdo->exec($sql);

    //Controllo presenza autore su DB
    $sql1='SELECT COUNT(*) AS Conteggio FROM Autore WHERE (NomeAutore="'.$nomeAutore.'")';
    $res1=$pdo->query($sql1);
    $row=$res1->fetch();

     if ($row['Conteggio']>0) {
       echo 'Autore già presente nel DB';
     } else {
       echo "Autore inserito con successo" ;
     }


?>