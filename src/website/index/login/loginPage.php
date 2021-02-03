<?php
    
    require '../../../connectionDB/connection.php';

    
    $emailUtente = $_POST['email'];
    $passwordUtente = $_POST['password'];
    $passwordUtente = md5($passwordUtente);

    try{
        $sql = "SELECT * FROM utente WHERE Email='$emailUtente' AND PasswordUtente='$passwordUtente'";
        $res = $pdo->query($sql); 
    }catch(PDOException $e){echo $e->getMessage();}	

    //da inserire homepage
    if($res>0){
        $_SESSION['email-accesso'] = $emailUtente;
        header("location: ../profilo/profilo.php");
    }else
        echo "<script> alert('I dati non risultano corretti, sicuro di esserti registrato?'); window.location.href='loginPage.html'; </script>";


?>