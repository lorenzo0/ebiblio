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
    $pagine = $_POST['pagine'];
    $numeroScaffale = $_POST['numeroScaffale'];
    $statoConservazione = $_POST['statoConservazione'];
    $statoPrestito = $_POST['statoPrestito'];
    

    //inserimento cartaceo not working
    $sql = "INSERT INTO Cartaceo (CodiceISBN, StatoDiConservazione, StatoPrestito, NumeroPagine,NumeroScaffale) VALUES ('$codice', '$statoConservazione', '$statoPrestito','$pagine ', '$numeroScaffale' )";  

    $pdo->exec($sql);
    
    //Inserimento in libro working
    $sql2 = "INSERT INTO Libro (CodiceISBN, Titolo, Anno, Genere, NomeEdizione) VALUES ('$codice', '$titolo', '$anno', '$genere','$nomeEdizione')";

    $pdo->exec($sql2);

?>