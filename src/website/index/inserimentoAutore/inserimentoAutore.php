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

    $nomeBiblioteca = $_POST['nomeBiblioteca'];
 
    $sql = "INSERT INTO Autore (Id, NomeAutore) VALUES (0,'$nomeAutore')";
    $pdo->exec($sql);
    echo "New record created successfully" ;

?>