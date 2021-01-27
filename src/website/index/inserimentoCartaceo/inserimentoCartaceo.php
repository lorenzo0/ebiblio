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

    
    $codiceCartaceo = $_POST['codiceCartaceo'];
    $titoloCartaceo= $_POST['titoloCartaceo'];
    $genereCartaceo = $_POST['genereCartaceo'];
    $edizioneCartaceo = $_POST['edizioneCartaceo'];
    $annoEdizioneCartaceo = $_POST['annoEdizioneCartaceo'];
    $numeroPagine = $_POST['numeroPagine'];
    $numeroScaffale = $_POST['numeroScaffale'];
    $statoConservazione= $_POST['statoConservazione'];
    $statoPrestito= $_POST['statoPrestito'];

    
    //NON FUNZIONA INSERIMENTO IN CARTACEO
    $sql = "INSERT INTO Cartaceo (CodiceISBN, StatoDiConservazione, StatoPrestito,NumeroPagine,NumeroScaffale) VALUES ('$codiceCartaceo', '$statoConservazione', '$statoPrestito','$numeroPagine ', '$numeroScaffale')";   

    //WORKING INSERIMENTO LIBRO
    $sql2 = "INSERT INTO Libro (CodiceISBN, Titolo, Anno, Genere, NomeEdizione) VALUES ('$codiceCartaceo', '$titoloCartaceo', '$annoEdizioneCartaceo', '$genereCartaceo','$edizioneCartaceo')";

    $pdo->exec($sql);
    $pdo->exec($sql2);

?>