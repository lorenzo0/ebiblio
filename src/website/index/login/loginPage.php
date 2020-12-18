<?php
    session_start();

    $dsn = 'mysql:dbname=sql7381971;host=sql7.freesqldatabase.com';
    $user = 'sql7381971';
    $password = '5mDynVUEzp';

    try {
        $pdo = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    //non usiamo $REQUEST perchè conosciamo il tipo di richiesta (Post)
    $emailUtente = $_POST['emailUtente'];
    $passwordUtente = $_POST['passwordUtente'];

    $sql = "SELECT * FROM registeredUserEaer WHERE Email = '$emailUtente' and Password = '$passwordUtente'";
    $result = $pdo->exec($sql);

    if($result->num_rows > 0)
    {
        header("location: ../home/home.html");
    }
    else
    {                  
        header("Refresh: 3; url= loginPage.html");
        echo "<script type='text/javascript'>alert(\"I dati non risultano corretti, sicuro di esserti registrato?\")</script>";
    }
?>