<?php 
    session_start();

    $dsn = 'mysql:host=127.0.0.1;dbname=ebiblio;port=3306';
    $user = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>