<?php

    require '../../../../connectionDB/connection.php';

    $IsbnLibro = $_GET['Isbn'];
    $nomeBibliotecaEncode = $_GET['Nome'];
    $nomeBiblioteca = urldecode($nomeBibliotecaEncode);
    $email = $_SESSION['EmailUtente'];

    $inizio = date("Y-m-d");
    $fine =  date('Y-m-d', strtotime("+15 days"));

    $id = 0; 

    try{
       
        $sql = $pdo->prepare("INSERT INTO PrenotazioneCartaceo VALUES(?, ?, ?, ?, ?, ?)");
        
        $sql->bindParam(1, $id, PDO::PARAM_INT);
        $sql->bindParam(2, $IsbnLibro, PDO::PARAM_INT);
        $sql->bindParam(3, $inizio, PDO::PARAM_STR);
        $sql->bindParam(4, $fine, PDO::PARAM_STR);
        $sql->bindParam(5, $email, PDO::PARAM_STR);
        $sql->bindParam(6, $nomeBiblioteca, PDO::PARAM_STR);
        
        $res = $sql->execute();

    }catch(PDOException $e){echo $e->getMessage();}	

    if($res > 0)
        echo "<script> alert('Prenotazione effettuata correttamente!'); window.location.href='../../home/myHome.php'; </script>";
    else
        echo "<script> alert('La prenotazione NON è stato effettuata, riprova!'); window.location.href='controllaDisponibilitaCartaceo.php'; </script>";


?>
