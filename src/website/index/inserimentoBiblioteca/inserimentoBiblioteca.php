<?php
    
    /*istanzia una sessione che crea come se fosse un file di cookie, questo non viene gestito sul pc dell'utente ma viene gestito dalla sessione di php, è una variabile di ambiente che mi tiene molti attributi, inserisco una corrispondenza chiave-valore all'interno della sessione, 
    ogni volta che faccio session start, recupero tutti chiave-valore inseriti all'intenro della sessione*/
    session_start();

    $dsn = 'mysql:dbname=ebiblio;host=127.0.0.1';
    $user = 'root';
    $password = 'root';

    try {
        $pdo = new PDO($dsn, $user, $password);  

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $nomeBiblioteca= $_POST['nomeBiblioteca'];
    $indirizzo = $_POST['indirizzo'];
    $email = $_POST['email'];
    $sito = $_POST['sito'];
    $latitudine = $_POST['latitudine'];
    $longitudine = $_POST['longitudine'];
    $recapito = $_POST['recapito'];
    $note = $_POST['note'];

 
    $sql = "INSERT INTO Biblioteca (Nome, Indirizzo, Email, URLSito, Latitudine, Longitudine, Recapito, Note) VALUES ('$nomeBiblioteca','$indirizzo','$email','$sito','$latitudine', '$longitudine','$recapito','$note' )";

    $pdo->exec($sql);
    echo "New record created successfully" ;

?>