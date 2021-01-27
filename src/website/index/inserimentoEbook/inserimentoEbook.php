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
    
    $codiceEbook = $_POST['codiceEbook'];
    $titoloEbook = $_POST['titoloEbook'];
    $genereEbook = $_POST['genereEbook'];
    $edizioneEbook = $_POST['edizioneEbook'];
    $annoEdizioneEbook = $_POST['annoEdizioneEbook'];
    $upload = $_POST['upload'];
    $dimensione = $_POST['dimensione'];
    
    //Inserimento Ebook not working
    $sql = "INSERT INTO Ebook (CodiceISBN, PDF, Dimensione) VALUES ('$codiceEbook', '$upload', '$dimensione')";   
    
    //INSERIMENTO LIBRO WORKING
     $sql2 = "INSERT INTO Libro (CodiceISBN, Titolo, Anno, Genere, NomeEdizione) VALUES ('$codiceEbook', '$titoloEbook', '$annoEdizioneEbook', '$genereEbook','$edizioneEbook')";

    $pdo->exec($sql);
    $pdo->exec($sql2);


 


?>