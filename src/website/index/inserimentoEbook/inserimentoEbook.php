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
    
    $codice = $_POST['codice'];
    $titolo = $_POST['titolo'];
    $anno= $_POST['anno'];
    $genere= $_POST['genere'];
    $nomeEdizione= $_POST['nomeEdizione'];
    $pdf= $_POST['pdf'];
    $dimensione = $_POST['dimensione'];
    
    $sql = "INSERT INTO Libro (CodiceISBN, Titolo, Anno, Genere, NomeEdizione) VALUES ('$codice','$titolo','$anno','$genere','$nomeEdizione')";
    
    $pdo->exec($sql);

    //il numero accessi deve ancora essere gestito
    $sql1 = "INSERT INTO Ebook (CodiceISBN, PDF, Dimensione) VALUES ('$codice', '$pdf', '$dimensione')";
    
    $pdo->exec($sql1);


?>